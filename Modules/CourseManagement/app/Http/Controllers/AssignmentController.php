<?php

namespace Modules\CourseManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\CourseManagement\Models\Assignment;
use Illuminate\Support\Facades\Storage;
use App\Notifications\NewAssignmentNotification;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Assignment::with('course')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'assignment_title' => 'required|string',
            'due_date' => 'required|date',
            'total_marks' => 'required|integer',
            'assignment_file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        // If there is a file, handle file upload
        if ($request->hasFile('assignment_file')) {
            $filePath = $request->file('assignment_file')->store('assignments');
            $validated['assignment_file'] = $filePath;
        }

        $assignment = Assignment::create($validated);

        // Notifying students enrolled in the course
        $students = $assignment->course->students;
        foreach ($students as $student) {
            $student->notify(new NewAssignmentNotification($assignment, $student));
        }

        return response()->json($assignment, 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $assignment = Assignment::with('course')->findOrFail($id);
        return response()->json($assignment);
    }

    /**
     * Download the specified assignment file.
     */
    public function download($id)
    {
        $assignment = Assignment::findOrFail($id);

        if ($assignment->assignment_file && Storage::exists($assignment->assignment_file)) {
            return Storage::download($assignment->assignment_file);
        }

        return response()->json(['message' => 'File not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'course_id' => 'exists:courses,id',
            'assignment_title' => 'string',
            'due_date' => 'date',
            'total_marks' => 'integer',
            'assignment_file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $assignment = Assignment::findOrFail($id);

        if ($request->hasFile('assignment_file')) {
            if ($assignment->assignment_file && Storage::exists($assignment->assignment_file)) {
                Storage::delete($assignment->assignment_file);
            }

            $filePath = $request->file('assignment_file')->store('assignments');
            $validated['assignment_file'] = $filePath;
        }

        $assignment->update($validated);
        return response()->json($assignment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $assignment = Assignment::findOrFail($id);

        if ($assignment->assignment_file && Storage::exists($assignment->assignment_file)) {
            Storage::delete($assignment->assignment_file);
        }

        $assignment->delete();
        return response()->json(['message' => 'Assignment deleted successfully']);
    }
}
