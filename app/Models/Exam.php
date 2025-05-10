<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'course_id', 'exam_date', 'start_time', 'end_time'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
}
