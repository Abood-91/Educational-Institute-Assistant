<?php

namespace Modules\StudentManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\StudentManagement\Models\Attendance;
use Modules\StudentManagement\Services\StudentService;


class AttendanceController extends Controller
{

    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = Attendance::all();
        return response()->json($attendances);    }

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
            'date' => 'required|date',
            'status' => 'required|string|in:Present,Absent',
        ]);

        $attendance = Attendance::create($validatedData);
        return response()->json($attendance, 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $attendance = Attendance::findOrFail($id);
        return response()->json($attendance);
    }

    public function getAttendance($studentId)
    {
        // Using the StudentService to get attendance percentage
        $attendancePercentage = $this->studentService->getAttendancePercentage($studentId);

        return response()->json([
            'student_id' => $studentId,
            'attendance_percentage' => $attendancePercentage
        ]);
    }

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
        $attendance = Attendance::findOrFail($id);
        $validatedData = $request->validate([
            'status' => 'required|string|in:Present,Absent',
        ]);

        $attendance->update($validatedData);
        return response()->json($attendance);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();
        return response()->json(null, 204);
    }
}
