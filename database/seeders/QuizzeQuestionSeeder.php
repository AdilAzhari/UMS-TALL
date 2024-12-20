<?php

namespace Database\Seeders;

use App\Models\QuizzeQuestion;
use Illuminate\Database\Seeder;

class QuizzeQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        QuizzeQuestion::factory()->count(10)->create();
    }
}
