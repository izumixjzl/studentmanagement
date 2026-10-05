<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'student_id',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'date_of_birth',
        'email',
        'phone',
        'address',
        'course_id',
        'year_level',
    ];

    public function course()
{
    return $this->belongsTo(Course::class, 'course_id', 'id');
}
}