<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CourseTeacherseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CourseTeacher::factory()->create();
    }
}
