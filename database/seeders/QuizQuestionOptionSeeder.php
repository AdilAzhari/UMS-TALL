<?php

namespace Database\Seeders;

use App\Models\QuizQuestionOption;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class QuizQuestionOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        QuizQuestionOption::factory()->count(1000)->create([
            'created_by' => Teacher::factory()->create()->first()->id,
        ]);
    }
}
