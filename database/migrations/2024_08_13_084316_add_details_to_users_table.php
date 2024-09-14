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
            $table->string('middle_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('Preferred_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('city_of_residence')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('avatar')->nullable();
            $table->enum('gender',['male','female']);
            $table->string('date_of_birth')->nullable();
            $table->string('nationality')->nullable();
            $table->string('country_of_residence')->nullable();
            $table->enum('marital_status',['single','married','divorced','widowed'])->default('single')->nullable();
            $table->string('secondary_email_address')->nullable();
            $table->boolean('is_admin')->default(0);
            $table->enum('role', ['admin', 'student', 'teacher']);
            $table->boolean('is_active')->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
