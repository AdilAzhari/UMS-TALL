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
            $table->enum('program_status', ['Graduated', 'Enrolled', 'Suspended', 'Expelled']);
            $table->enum('program_type', ['Diploma', 'BACHELOR\'S DEGREE', 'MASTERS DEGREE', 'DOCTORATE DEGREE']);
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
