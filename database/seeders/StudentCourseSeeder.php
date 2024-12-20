<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();
        $courses = Course::all();

        // Loop through each student and randomly attach courses
        foreach ($students as $student) {
            // Randomly select 3 to 5 courses for each student
            $randomCourses = $courses->random(rand(3, 5))->pluck('id')->toArray();

            // Attach the courses to the student with a random enrolled date
            foreach ($randomCourses as $courseId) {
                $student->courses()->attach($courseId, [
                    'enrolled_date' => now()->subDays(rand(1, 365)),
                ]);
            }
        }
    }
}
