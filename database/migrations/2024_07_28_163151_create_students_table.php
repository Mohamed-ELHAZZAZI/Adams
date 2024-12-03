<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('Student_id')->unique();
            $table->string('First_name');
            $table->string('Last_name');
            $table->string('Email');
            $table->string('Picture');
            $table->date('Birthday');
            $table->integer('Grade');
            $table->enum('Gender', ['Male', 'Female']);
            $table->foreignId('major_id')->constrained('majors')->onDelete('cascade');
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->foreignId('academic_level_id')->constrained('academic_levels')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
