<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['class_id', 'student_id', 'status'];

    public function class()
    {
        return $this->belongsTo(ClassSession::class, 'class_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
