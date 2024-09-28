<?php

namespace Modules\CourseManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assignment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['course_id', 'assignment_title', 'due_date', 'total_marks'];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }



}
