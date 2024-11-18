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
            $table->Date('paymentDate');
            $table->enum('status',['Pending', 'Completed', 'Failed', 'Refund']);
            $table->enum('method ',['Strip','Paypal','Creadit Card']);
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id ')->constrained()->cascadeOnDelete();
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
