<?php

namespace Modules\CourseManagement\Services;

use Modules\CourseManagement\Models\Course;

class CourseService
{
    public function getCourseWithDetails($id)
    {
        $course = Course::with('teacher', 'subjects', 'exams', 'assignments')->find($id);

        if ($course) {
            // Using the general_helper in this service
            $course->formatted_dates = formatDateRange($course->start_date, $course->end_date);
        }

        return $course;
    }
}
