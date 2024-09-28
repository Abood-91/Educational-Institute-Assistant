<?php

namespace Modules\CourseManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\CourseManagement\Models\Exam;
use Modules\CourseManagement\Models\ExamSubmission;

class ExamSubmissionController extends Controller
{
    public function submit(Request $request, $exam_id)
    {
        $exam = Exam::with('questions')->findOrFail($exam_id);

        // Validate the answers input
        $validated = $request->validate([
            'answers' => 'required|array',
        ]);

        // Score calculated by Comparing the submitted answers with the correct answers
        $score = 0;
        foreach ($exam->questions as $question) {
            if (isset($validated['answers'][$question->id]) &&
                $validated['answers'][$question->id] === $question->correct_answer) {
                $score += 1; // For each correct answer increase the score
            }
        }

        $submission = ExamSubmission::create([
            'student_id' => Auth::id(),
            'exam_id' => $exam_id,
            'score' => $score,
        ]);

        return response()->json([
            'score' => $score,
            'submission' => $submission,
        ], 201);
    }



    /**
     * Display a specific exam submission.
     */
    public function show($id)
    {
        // Retrieving specific submission with its related exam and student data
        $submission = ExamSubmission::with(['exam', 'student'])->findOrFail($id);
        return response()->json($submission);
    }

    /**
     * Store a newly created exam submission. (Admin protected)
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'student_id' => 'required|exists:students,id',
            'answers' => 'required|array',
        ]);

        // Storing the exam submission
        $examSubmission = ExamSubmission::create([
            'exam_id' => $validated['exam_id'],
            'student_id' => $validated['student_id'],
            'answers' => json_encode($validated['answers']),
            'submitted_at' => now(),
        ]);

        return response()->json($examSubmission, 201);
    }

    /**
     */
    public function update(Request $request, $id)
    {
        $submission = ExamSubmission::findOrFail($id);

        $validated = $request->validate([
            'answers' => 'required|array',
            'score' => 'required|integer',
        ]);

        $submission->update([
            'answers' => json_encode($validated['answers']),
            'score' => $validated['score'],
        ]);

        return response()->json($submission);
    }

    /**
     */
    public function destroy($id)
    {
        $submission = ExamSubmission::findOrFail($id);
        $submission->delete();

        return response()->json(['message' => 'Submission deleted successfully']);
    }
}
