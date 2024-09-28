<?php

namespace Modules\CourseManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\CourseManagement\Models\Course;
use Modules\CourseManagement\Services\CourseService;


class CourseController extends Controller
{

    protected $courseService;

    // Inject CourseService in the constructor
    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Course::with('teacher', 'subjects', 'exams', 'assignments')->get();
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
            'teacher_id' => 'required|exists:teachers,id',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'grade_level' => 'required|string',
            'subject' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'course_link' => 'nullable|url',
        ]);

        $course = Course::create($validated);
        return response()->json($course, 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {

        $course = $this->courseService->getCourseWithDetails($id);
        return response()->json($course);
    }

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
            'teacher_id' => 'exists:teachers,id',
            'name' => 'string',
            'description' => 'nullable|string',
            'grade_level' => 'string',
            'subject' => 'string',
            'start_date' => 'date',
            'end_date' => 'date',
            'course_link' => 'nullable|url',
        ]);

        $course = Course::findOrFail($id);
        $course->update($validated);
        return response()->json($course);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return response()->json(['message' => 'Course deleted successfully']);
    }
}
