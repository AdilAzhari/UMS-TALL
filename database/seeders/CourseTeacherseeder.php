<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseTeacherseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Course::all()->each(function ($course) {
            $course->teachers()->attach(
                \App\Models\Teacher::inRandomOrder()->first()
            );
        });
    }
}
