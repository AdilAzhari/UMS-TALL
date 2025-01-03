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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Class_group_id')->constrained('class_groups')->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained('teachers')->cascadeOnDelete();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->foreignId('created_by')->constrained('teachers')->cascadeOnDelete();
            $table->string('slug')->unique();
            $table->integer('total_marks');
            $table->foreignId('updated_by')->nullable()->constrained('teachers')->cascadeOnDelete();
            $table->enum('status', ['pending', 'completed', 'overdue'])->default('pending');
            $table->string('title');
            $table->string('file')->nullable();
            $table->text('description');
            $table->date('deadline');
            $table->integer('max_attempts')->default(3);
            $table->integer('attachment_limit')->default(3);
            $table->timestamp('submission_start')->nullable();
            $table->timestamp('submission_end')->nullable();
            $table->enum('late_submission_policy', ['not_allowed', 'allowed'])->default('not_allowed');
            $table->enum('grading_type',['numeric','letter','pass_fail'])->default('numeric');
            $table->timestamp('assessment_start')->nullable();
            $table->timestamp('assessment_end')->nullable();
            $table->integer('passing_score')->default(0);
            $table->boolean('is_visible')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
