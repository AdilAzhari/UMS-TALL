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
            $table->foreignId('enrollment_id')->nullable()->constrained();
            $table->decimal('gpa', 3, 2)->nullable();
            $table->Integer('total_credits')->default(0);
            $table->Integer('total_courses')->default(0);
            $table->Integer('total_courses_completed')->default(0);
            $table->Integer('total_courses_failed')->default(0);
            $table->Integer('total_courses_withdrawn')->default(0);
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
