<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $table = 'admins';

    protected $fillable = [
        'First_name',
        'Last_name',
        'Password',
        'Email',
        'Picture',
        'Birthday',
        'Gender',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'Password',
        'remember_token',
        'created_at',
        'updated_at',
        'id'
    ];

    public function getAuthIdentifierName()
    {
        return 'Email';
    }

    public function getAuthPassword()
    {
        return $this->Password;
    }
}
