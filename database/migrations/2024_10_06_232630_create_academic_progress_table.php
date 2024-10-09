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
        Schema::create('academic_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('program_id')->nullable()->constrained();
            $table->foreignId('term_id')->nullable()->constrained();
            $table->integer('major_courses_total')->default(0);
            $table->integer('major_courses_completed')->default(0);
            $table->integer('general_courses_total')->default(0);
            $table->integer('general_courses_completed')->default(0);
            $table->integer('elective_courses_total')->default(0);
            $table->integer('elective_courses_completed')->default(0);
            $table->decimal('total_credits_earned', 5, 2)->default(0);
            $table->decimal('gpa', 3, 2)->nullable();
            $table->enum('academic_standing', ['good', 'warning', 'probation', 'suspension'])->default('good');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_progress');
    }
};
