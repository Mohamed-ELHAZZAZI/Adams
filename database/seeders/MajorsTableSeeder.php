<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('majors')->insert([
            [
                'Prefix' => '3906',
                'Name' => 'Computer Science',
                'Short_name' => 'CS'
            ],
            [
                'Prefix' => '4908',
                'Name' => 'Information Technology',
                'Short_name' => 'IT'
            ],
            [
                'Prefix' => '5907',
                'Name' => 'Software Engineering',
                'Short_name' => 'SE'
            ],
            [
                'Prefix' => '6909',
                'Name' => 'Electrical Engineering',
                'Short_name' => 'EE'
            ],
            [
                'Prefix' => '2903',
                'Name' => 'Mechanical Engineering',
                'Short_name' => 'ME'
            ],
            [
                'Prefix' => '7901',
                'Name' => 'Civil Engineering',
                'Short_name' => 'CE'
            ],
            [
                'Prefix' => '8902',
                'Name' => 'Business Administration',
                'Short_name' => 'BA'
            ],
            [
                'Prefix' => '9904',
                'Name' => 'Marketing',
                'Short_name' => 'MKT'
            ],
            [
                'Prefix' => '1505',
                'Name' => 'Finance',
                'Short_name' => 'FIN'
            ],
            [
                'Prefix' => '2019',
                'Name' => 'Economics',
                'Short_name' => 'ECO'
            ],
        ]);
    }
}
