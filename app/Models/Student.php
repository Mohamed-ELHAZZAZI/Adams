<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'Student_id',
        'First_name',
        'Last_name',
        'password',
        'Email',
        'Picture',
        'Birthday',
        'Grade',
        'Gender',
        'Nationality'
    ];


    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function academic_level()
    {
        return $this->belongsTo(AcademicLevel::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student', 'student_id', 'course_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
