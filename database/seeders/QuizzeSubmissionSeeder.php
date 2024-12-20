<?php

namespace Database\Seeders;

use App\Models\QuizzeSubmission;
use Illuminate\Database\Seeder;

class QuizzeSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        QuizzeSubmission::factory()->create();
    }
}
