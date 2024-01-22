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
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->string('job_title')->nullable();
            $table->integer('age')->nullable();
            $table->json('skills'); // Storing as text, consider JSON or another structure for more complexity
            $table->json('courses')->nullable(); // Storing as text, consider JSON or another structure for more complexity
            $table->json('education'); // Storing as text, consider JSON or another structure for more complexity
            $table->json('work_experience')->nullable();
            $table->string('template')->default('template1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};
