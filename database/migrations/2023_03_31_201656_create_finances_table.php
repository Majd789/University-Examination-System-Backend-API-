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
        Schema::create('finances', function (Blueprint $table) {
            $table->id('id_paid');
            $table->integer('paid_code');
            $table->foreignId('student_id')->constrained('students','id_student')->cascadeOnDelete();
            $table->integer('amount_paid');
            $table->date('date_paid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finances');
    }
};
