<?php

namespace Database\Seeders;

use App\Models\Quizze;
use Illuminate\Database\Seeder;

class QuizzeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Quizze::factory()->create();
    }
}
