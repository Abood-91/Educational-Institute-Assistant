<?php

namespace Modules\CourseManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\StudentManagement\Models\Student;
use Modules\StudentManagement\Models\Attendance;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'teacher_id', 'name', 'description', 'grade_level', 'subject',
        'start_date', 'end_date', 'course_link'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }


}
