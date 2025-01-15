<?php

use App\Enums\QuizDuration;
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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete();
            $table->foreignId('class_group_id')->constrained('class_groups')->cascadeOnDelete();
            $table->string('code');
            $table->string('description');
            $table->enum('type', ['Graded', 'Ungraded'])->default('Ungraded');
            $table->string('title');
            $table->string('instructions');
            $table->enum('duration', [QuizDuration::TEN->value, QuizDuration::SIXTY->value,
                QuizDuration::THIRTY->value, QuizDuration::FORTY_FIVE->value, QuizDuration::TWENTY->value])
                ->default(QuizDuration::TEN);
            $table->enum('status', ['Draft', 'Published', 'Closed'])->default('Draft');
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
