<?php

namespace Modules\CourseManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\CourseManagement\Models\Subject;


class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Subject::with('course')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('coursemanagement::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|string',
            'teacher_name' => 'required|string',
        ]);

        $subject = Subject::create($validated);
        return response()->json($subject, 201);
    }


    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $subject = Subject::with('course')->findOrFail($id);
        return response()->json($subject);    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('coursemanagement::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'course_id' => 'exists:courses,id',
            'name' => 'string',
            'teacher_name' => 'string',
        ]);

        $subject = Subject::findOrFail($id);
        $subject->update($validated);
        return response()->json($subject);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
        return response()->json(['message' => 'Subject deleted successfully']);
    }
}
