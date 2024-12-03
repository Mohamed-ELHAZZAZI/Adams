<?php

namespace App\Http\Controllers;

use App\Models\AcademicLevel;
use Illuminate\Http\Request;

class AcademicLevelsController extends Controller
{
    public function getAll()
    {
        return AcademicLevel::get();
    }
}
