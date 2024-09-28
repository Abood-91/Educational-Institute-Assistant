<?php

namespace Modules\StudentManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\CourseManagement\Models\Course;
use Modules\CourseManagement\Models\Assignment;
use Modules\CourseManagement\Models\Exam;



class Evaluation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['student_id', 'course_id', 'assignment_id', 'exam_id', 'marks_obtained', 'evaluation_date'];


    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }


}
