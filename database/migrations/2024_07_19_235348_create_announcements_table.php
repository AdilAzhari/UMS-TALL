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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->foreignId('week_id')->constrained('weeks')->cascadeOnDelete();
            $table->foreignId('class_group_id')->constrained('class_groups')->cascadeOnDelete();
            $table->text('message');
            $table->string('title');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->enum('type', ['Announcement', 'Assignment', 'Quiz'])->default('Announcement');
            $table->enum('audience', ['Global', 'Week', 'Course'])->default('Global');
            $table->string('attachments')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('teachers');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
