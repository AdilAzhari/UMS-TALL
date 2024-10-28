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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('max_students')->default(30);
            $table->integer('credit')->default(3);
            $table->string('syllabus')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->default(false);
            $table->foreignId('program_id')->constrained('programs')->cascadeOnDelete();
            $table->foreignId('prerequisite_course_id')->nullable()->constrained('courses')->cascadeOnDelete();
            $table->foreignId('course_category_id')->constrained()->cascadeOnDelete();
            $table->boolean('requier_proctor')->default(false);
            $table->enum('paid', ['paid', 'unpaid', 'future_payment'])->default('unpaid');
            $table->decimal('cost', 10, 2)->nullable();
            $table->integer('sequence')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
