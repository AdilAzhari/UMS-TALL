<?php

use App\Enums\AttendanceReason;
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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->enum('status', ['Present', 'Absent'])->default('Present');
            $table->enum('reason', [AttendanceReason::SICK->value, AttendanceReason::VACATION->value,
                AttendanceReason::OTHER->value])
                ->nullable()->default(AttendanceReason::SICK);
            $table->text('notes')->nullable();
            $table->foreignId('enrollment_id')->constrained('enrollments')->cascadeOnDelete();
            $table->foreignId('Class_group_id')->constrained('class_groups')->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained('teachers')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
