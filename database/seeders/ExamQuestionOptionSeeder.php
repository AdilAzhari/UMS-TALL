<?php

namespace Database\Seeders;

use App\Models\ExamQuestionOption;
use Illuminate\Database\Seeder;

class ExamQuestionOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        examquestionoption::factory(2000)->create();
    }
}
