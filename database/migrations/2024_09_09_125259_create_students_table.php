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
        if(Schema::hasTable('students')){
           return;
        }
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('enrollment_number')->nullable();
            $table->enum('status',['Graduated', 'Enrolled', 'Suspended', 'Expelled'])->default('Enrolled');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('program_id')->constrained('programs')->cascadeOnDelete();
            $table->foreignId('department_id')->constrained('departments')->cascadeOnDelete();
            $table->foreignId('current_term_id')->constrained('terms')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
