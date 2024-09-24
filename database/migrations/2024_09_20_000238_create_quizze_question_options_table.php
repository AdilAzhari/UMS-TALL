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
        Schema::create('quizze_question_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quizz_question_id')->constrained('quizze_questions')->cascadeOnDelete();
            $table->string('option');
            $table->boolean('is_correct')->default(false);
            $table->foreignId('created_by')->constrained('teachers')->cascadeOnDelete();
            $table->foreignId('updated_by')->constrained('teachers')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizze_question_options');
    }
};
