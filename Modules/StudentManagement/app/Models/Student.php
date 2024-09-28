<?php

namespace Modules\StudentManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\StudentManagement\Models\Attendance;
use Modules\CourseManagement\Models\Course;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class Student extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'email', 'phone_number', 'enrollment_date', 'password'];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }


}
