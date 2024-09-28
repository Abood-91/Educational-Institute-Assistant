<?php


namespace Modules\CourseManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['exam_id', 'question_text', 'options', 'correct_answer'];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    protected $casts = [
        'options' => 'array',
    ];
}
