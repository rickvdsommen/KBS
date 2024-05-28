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
            $table->unsignedBigInteger('user_id');
            $table->string('school');
            $table->string('degree');
            $table->string('currentYear')->nullable();
            $table->integer('degreeYears')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();

            // Define unqiue key
            $table->unique(['user_id', 'school', 'degree']);
            
            // Define foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
