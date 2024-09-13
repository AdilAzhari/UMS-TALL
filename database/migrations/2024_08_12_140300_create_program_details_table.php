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
        Schema::create('program_details', function (Blueprint $table) {
            $table->id();
            $table->char('program_code')->unique();
            $table->text('description');
            $table->integer('duration_years');
            $table->foreignId('department_id')->constrained();
            $table->string('program_name')->nullable();
            $table->enum('program_status', ['Graduated', 'Enrolled', 'Suspended', 'Expelled']);
            $table->string('student_iD')->nullable();
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
