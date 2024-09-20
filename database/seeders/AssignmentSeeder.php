<?php

namespace Database\Seeders;

use App\Models\Assignment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        [
            'title' => 'Assignment 2',
            'description' => 'Assignment 2 description',
            'due_date' => '2021-12-31',
            'total_marks' => 100,
            'course_id' => 1,
            'created_by' => 1,
            'week_id' => 1,
            'class_id' => 1,
            'teacher_id' => 1,
        ],
        [
            'title' => 'Assignment 3',
            'description' => 'Assignment 3 description',
            'due_date' => '2021-12-31',
            'total_marks' => 100,
            'course_id' => 1,
            'created_by' => 1,
            'week_id' => 1,
            'class_id' => 1,
            'teacher_id' => 1,
        ],
        [
            'title' => 'Assignment 4',
            'description' => 'Assignment 4 description',
            'due_date' => '2021-12-31',
            'total_marks' => 100,
            'course_id' => 1,
            'created_by' => 1,
            'week_id' => 1,
            'class_id' => 1,
            'teacher_id' => 1,
        ],
        [
            'title' => 'Assignment 5',
            'description' => 'Assignment 5 description',
            'due_date' => '2021-12-31',
            'total_marks' => 100,
            'course_id' => 1,
            'created_by' => 1,
            'week_id' => 1,
            'class_id' => 1,
            'teacher_id' => 1,
        ];
    }
}
