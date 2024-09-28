<?php

namespace Modules\StudentManagement\Services;

use Modules\StudentManagement\Models\Student;
use Modules\StudentManagement\Models\Attendance;

class StudentService
{
    public function getStudentDetails($id)
    {
        $student = Student::findOrFail($id);

        // Use helper to format enrollment date
        $student->formatted_enrollment_date = formatDateRange($student->enrollment_date, now());

        return $student;
    }

    public function getAttendancePercentage($studentId)
    {
        $totalDays = Attendance::where('student_id', $studentId)->count();
        $presentDays = Attendance::where('student_id', $studentId)->where('status', 'Present')->count();

        // Use helper to calculate attendance percentage
        return calculateAttendancePercentage($presentDays, $totalDays);
    }
}
