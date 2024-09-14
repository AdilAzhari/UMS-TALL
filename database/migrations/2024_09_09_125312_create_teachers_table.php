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
        if(schema::hasTable('teachers')){
            return;
        }
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('qualification');
            $table->string('experience');
            $table->string('specialization');
            $table->string('department');
            $table->string('designation');
            $table->date('hire_date');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('department_id')->constrained('departments')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
