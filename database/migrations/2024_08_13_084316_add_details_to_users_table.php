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
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('Preferred_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('city_of_residence')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('avatar')->nullable();
            $table->string('gender')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('nationality')->nullable();
            $table->string('country_of_residence')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('primary_email_addres')->nullable();
            $table->enum('role', ['admin', 'student', 'teacher'])->default('student');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
