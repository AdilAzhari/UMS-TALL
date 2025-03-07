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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('program_code')->unique();
            $table->text('description');
            $table->integer('duration_years');
            $table->foreignId('department_id')->constrained('departments')->cascadeOnDelete();
            $table->string('program_name')->nullable();
            $table->foreignId('program_type_id')->constrained('program_types')->cascadeOnDelete();
            $table->foreignId('program_status_id')->constrained('program_statuses')->cascadeOnDelete();
            $table->integer('total_credits');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_details');
    }
};
