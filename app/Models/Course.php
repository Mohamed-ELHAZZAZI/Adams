<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'Grade',
        'C_id'
    ];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_student', 'course_id', 'student_id');
    }

    public function academic_level()
    {
        return $this->belongsTo(AcademicLevel::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function classes()
    {
        return $this->hasMany(ClassSession::class);
    }
}
