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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->foreignId('proctor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('term_id')->constrained()->cascadeOnDelete();
            $table->enum('status',['registered','in_progress','completed','withdrawn'])->default('in_progress')->index();
            $table->enum('proctor_status',['pending','approved','rejected'])->default('pending')->index();
            $table->timestamp('registered_at')->nullable()->default(now());
            $table->date('completion_date')->nullable();
            $table->enum('payment_status', ['unpaid', 'pending', 'paid', 'future'])->default('unpaid')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
