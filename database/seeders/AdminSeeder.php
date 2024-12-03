<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'First_name' => 'Adam',
            'Last_name' => 'Salhi',
            'Email' => 'admin@admin.admin',
            'Password' => Hash::make('admin'),
            'Picture' => '/uploads/admins/profiles/Admin_1.png',
            'Birthday' => '1981-05-06',
            'Gender' => 'Male',

        ]);
    }
}
