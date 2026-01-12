<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'course_code',
        'course_name',
        'description',
        'credits',
        'department',
        'instructor',
        'max_students',
        'status',
    ];

    protected $casts = [
        'credits' => 'integer',
        'max_students' => 'integer',
    ];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments');
    }
}
