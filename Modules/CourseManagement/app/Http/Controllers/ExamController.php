<?php

namespace Modules\CourseManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\CourseManagement\Models\Exam;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Exam::with('course')->get();
    }

    /**



     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'exam_date' => 'required|date',
            'total_marks' => 'required|integer',
        ]);

        $exam = Exam::create($validated);
        return response()->json($exam, 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {

        $exam = Exam::with('course', 'questions')->findOrFail($id);
        return response()->json($exam);

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'course_id' => 'exists:courses,id',
            'exam_date' => 'date',
            'total_marks' => 'integer',
        ]);

        $exam = Exam::findOrFail($id);
        $exam->update($validated);
        return response()->json($exam);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();
        return response()->json(['message' => 'Exam deleted successfully']);
    }
}
