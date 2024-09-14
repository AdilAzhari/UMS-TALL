<?php

namespace Database\Seeders;

use App\Models\department;
use App\Models\enrollment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            // StudentsSeeder::class,
            // UserSeeder::class,
            programSeeder::class,
            AttendanceSeeder::class,
            AssignmentSeeder::class,
            AssignmentSubmissionSeeder::class,
            CourseSeeder::class,
            // CourseRegistrationSeeder::class,
            ExamSeeder::class,
            ExamResultSeeder::class,
            enrollmentSeeder::class,
            // PaymentSeeder::class,
            StudentSeeder::class,
            departmentSeeder::class,
            GradingScaleSeeder::class,
            teacherSeeder::class,
            TermSeeder::class,
            classSeeder::class,
            NotificationSeeder::class,
        ]);
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
