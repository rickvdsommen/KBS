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
        Schema::create('degrees', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('school');
            $table->string('degree');
            $table->string('experienceYears')->nullable();
            $table->integer('year')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();

            // Define unqiue key
            $table->unique(['email', 'school', 'degree']);
            
            // Define foreign key
            $table->foreign('email')->references('email')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('degrees');
    }
};
