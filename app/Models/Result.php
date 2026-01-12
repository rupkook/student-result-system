<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
        'exam_type',
        'marks',
        'total_marks',
        'grade',
        'gpa',
        'status',
        'exam_date',
        'remarks',
    ];

    protected $casts = [
        'marks' => 'decimal:2',
        'total_marks' => 'decimal:2',
        'gpa' => 'decimal:2',
        'exam_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getPercentageAttribute()
    {
        return $this->total_marks > 0 ? ($this->marks / $this->total_marks) * 100 : 0;
    }

    public function isPublished()
    {
        return $this->status === 'published';
    }

    public function isPassed()
    {
        return $this->percentage >= 50;
    }
}
