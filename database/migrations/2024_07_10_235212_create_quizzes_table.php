<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete();
            $table->foreignId('class_id')->constrained()->cascadeOnDelete();
            $table->string('code');
            $table->string('description');
            $table->enum('type', ['graded', 'ungraded'])->default('ungraded');
            $table->string('title');
            $table->string('instructions');
            $table->enum('duration', ['5', '10', '15', '20', '25', '30', '35', '40', '45', '50', '55', '60']);
            $table->enum('status', ['draft', 'published', 'closed'])->default('draft');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('passing_score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
