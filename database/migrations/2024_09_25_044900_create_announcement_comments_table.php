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
        Schema::create('announcement_comments', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->foreignId('announcement_id')->constrained()->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('announcement_comments')->cascadeOnDelete();
            $table->foreignId('commented_by')->constrained('users')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcement_comments');
    }
};