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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount');
            $table->date('payment_date');
            $table->enum('status', ['Pending', 'Completed', 'Failed', 'Refunded', 'Cancelled'])->default('Pending');
            $table->enum('method', ['Strip', 'Paypal', 'Credit Card'])->default('Credit Card');
            $table->enum('transaction_type', ['Exam/Course Processing Fee', 'Transferring Credit Fee', 'application Fee'])
                ->default('application Fee');
            $table->string('failure_reason')->nullable();
            $table->string('payment_intent')->nullable();
            $table->string('refund_id')->nullable();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
