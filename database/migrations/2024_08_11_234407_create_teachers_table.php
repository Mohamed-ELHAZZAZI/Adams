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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('Teacher_id')->unique();
            $table->string('First_name');
            $table->string('role')->default('teacher');
            $table->string('Last_name');
            $table->string('Email');
            $table->string('Password')->nullable();
            $table->string('Picture');
            $table->date('Birthday');
            $table->enum('Gender', ['Male', 'Female']);
            $table->foreignId('major_id')->constrained('majors')->onDelete('cascade');
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
