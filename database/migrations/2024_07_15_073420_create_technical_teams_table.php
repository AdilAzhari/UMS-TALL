<?php

use App\Enums\TechnicalTeamRole;
use App\Enums\TechnicalTeamStatus;
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
        Schema::create('technical_teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('role', [TechnicalTeamRole::SUPPORT->value, TechnicalTeamRole::MANAGER->value, TechnicalTeamRole::SUPER_ADMIN->value, TechnicalTeamRole::ADMIN->value])
                ->default(TechnicalTeamRole::ADMIN->value);
            $table->enum('status', [TechnicalTeamStatus::ACTIVE->value, TechnicalTeamStatus::INACTIVE->value])
                ->default(TechnicalTeamStatus::ACTIVE->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technical_teams');
    }
};
