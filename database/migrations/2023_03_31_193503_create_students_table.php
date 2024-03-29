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
            $table->id('id_student');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('mother');
            $table->string('gender');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->double('phone');
            $table->integer('fidelity_constrain');
            $table->string('health_status');
            $table->string('certificate_type');
            $table->string('faculty');
            $table->string('year');
            $table->string('year_join');
            $table->string('status_record');
            $table->integer('amount');
            $table->string('password');
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
