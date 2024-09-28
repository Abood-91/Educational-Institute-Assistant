<?php

namespace Modules\StudentManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\StudentManagement\Models\Evaluation;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evaluations = Evaluation::all();
        return response()->json($evaluations);    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('studentmanagement::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'assignment_id' => 'sometimes|nullable|exists:assignments,id',
            'exam_id' => 'sometimes|nullable|exists:exams,id',
            'marks_obtained' => 'required|integer|min:0',
            'evaluation_date' => 'required|date',
        ]);

        $evaluation = Evaluation::create($validatedData);
        return response()->json($evaluation, 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        return response()->json($evaluation);    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('studentmanagement::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $evaluation = Evaluation::findOrFail($id);
        $validatedData = $request->validate([
            'marks_obtained' => 'required|integer|min:0',
            'evaluation_date' => 'required|date',
        ]);

        $evaluation->update($validatedData);
        return response()->json($evaluation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        $evaluation->delete();
        return response()->json(null, 204);
    }
}
