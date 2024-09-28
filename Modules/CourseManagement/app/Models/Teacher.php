<?php

namespace Modules\CourseManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
                'name', 'email', 'phone_number', 'subject_expertised', 'hire_date', 'password'
    ];


    public function courses()
    {
        return $this->hasMany(Course::class);
    }


}
