<?php

namespace Modules\CourseManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\CourseManagement\Models\Teacher;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Teacher::with('courses')->get();
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:teachers',
            'phone_number' => 'required|string|max:15',
            'subject_expertised' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'password' => 'required|string|min:8',
        ]);

        $teacher = Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'subject_expertised' => $request->subject_expertised,
            'hire_date' => $request->hire_date,
            'password' => bcrypt($request->password),
        ]);

        return response()->json($teacher, 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $teacher = Teacher::with('courses')->findOrFail($id);
        return response()->json($teacher);    }

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
            'name' => 'string',
            'email' => 'email|unique:teachers,email,' . $id,
            'phone_number' => 'string',
            'subject_expertised' => 'string',
            'hire_date' => 'date',
        ]);

        $teacher = Teacher::findOrFail($id);
        $teacher->update($validated);
        return response()->json($teacher);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();
        return response()->json(['message' => 'Teacher deleted successfully']);
    }
}
