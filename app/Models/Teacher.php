<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Authenticatable
{
    use HasFactory, HasApiTokens;


    protected $table = 'teachers';
    protected $fillable = [
        'Teacher_id',
        'First_name',
        'Last_name',
        'Email',
        'Picture',
        'Birthday',
        'Gender',
        'Nationality',
        'Password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'Password',
        'remember_token',
    ];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function academic_level()
    {
        return $this->belongsTo(AcademicLevel::class);
    }

    public function getAuthIdentifierName()
    {
        return 'Email';
    }

    public function getAuthPassword()
    {
        return $this->Password;
    }
}
