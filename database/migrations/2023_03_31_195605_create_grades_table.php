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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses','id_course')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('students','id_student')->cascadeOnDelete();
            $table->integer('th_grades')->nullable(); // نظري
            $table->integer('pr_grades'); // عملي
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
