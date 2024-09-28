<?php

namespace Modules\CourseManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\StudentManagement\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamSubmission extends Model
{
    use HasFactory;

    protected $fillable = ['exam_id', 'student_id', 'answers', 'submitted_at'];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
