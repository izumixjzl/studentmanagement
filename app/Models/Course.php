<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'course_code',
        'course_name',
        'description',
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'course_id', 'id');
    }
}