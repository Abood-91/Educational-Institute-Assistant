<?php

namespace Modules\CourseManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\CourseManagement\Models\Question;

class QuestionController extends Controller
{
    public function index($exam_id)
    {
        return Question::where('exam_id', $exam_id)->get();
    }

    public function store(Request $request, $exam_id)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'options' => 'required|array',
            'correct_answer' => 'required|string',
        ]);

        $validated['exam_id'] = $exam_id;

        $question = Question::create($validated);
        return response()->json($question, 201);
    }

    public function show($id)
    {
        $question = Question::findOrFail($id);
        return response()->json($question);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'question_text' => 'string',
            'options' => 'array',
            'correct_answer' => 'string',
        ]);

        $question = Question::findOrFail($id);
        $question->update($validated);
        return response()->json($question);
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        return response()->json(['message' => 'Question deleted successfully']);
    }
}
