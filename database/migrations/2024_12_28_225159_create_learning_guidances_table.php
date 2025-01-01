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
        Schema::create('learning_guidances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('week_id')->constrained('weeks')->onDelete('cascade');
            $table->text('overview');
            $table->json('topics');
            $table->json('objectives');
            $table->json('tasks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_guidances');
    }
};