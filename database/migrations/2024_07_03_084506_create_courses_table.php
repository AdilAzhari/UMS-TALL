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
            $table->text('description');
            $table->integer('credit')->default(3);
            $table->string('syllabus');
            $table->string('image');
            $table->boolean('status')->default(false);
            $table->foreignId('program_id')->constrained('programs')->cascadeOnDelete();
            $table->boolean('requier_proctor')->default(false);
            $table->boolean('is_paid')->default(false);
            $table->decimal('cost', 10, 2)->nullable();
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
