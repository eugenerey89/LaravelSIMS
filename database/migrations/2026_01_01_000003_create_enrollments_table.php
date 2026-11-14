<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->string('school_year', 9);           // e.g. 2026-2027
            $table->enum('semester', ['1st', '2nd', 'Summer']);
            $table->enum('status', ['Enrolled', 'Completed', 'Dropped'])->default('Enrolled');
            $table->decimal('grade', 4, 2)->nullable();
            $table->timestamps();

            $table->unique(['student_id', 'subject_id', 'school_year', 'semester'], 'enrollment_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
