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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('First_name');
            $table->string('Last_name');
            $table->string('role')->default('admin');
            $table->string('Email');
            $table->string('Password')->nullable();
            $table->string('Picture');
            $table->date('Birthday');
            $table->enum('Gender', ['Male', 'Female']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
