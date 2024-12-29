<?php

namespace Database\Seeders;

use App\Models\LearningGuidance;
use Illuminate\Database\Seeder;

class LearningGuidancesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        learningGuidance::factory(3)->create();
    }
}
