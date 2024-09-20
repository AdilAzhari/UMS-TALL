<?php

namespace Database\Seeders;

use App\Models\Exam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exams = [
            [
                'exam_date' => '2024-09-09',
                'exam_description' => 'Exam 1',
                'exam_duration' => '2 hours',
                'exam_rules' => 'No cheating',
                'passing_score' => '50',
                'exam_questions' => 'What is the capital of France?',
                'created_by' => 1,
                'updated_by' => 1,
                'exam_passing_score' => '50',
                'exam_answers' => 'Paris',
            ],
        ];

        foreach ($exams as $exam) {
            Exam::create($exam);
        }
    }
}
