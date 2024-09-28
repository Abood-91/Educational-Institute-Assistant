<?php

namespace Modules\CourseManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'course_id', 'name', 'teacher_name'
    ];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }


}
