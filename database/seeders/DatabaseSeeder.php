<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory()->create([
        //     'name' => 'admin',
        //     'email' => 'admin@example.com',
        // ]);
        $this->call([
            // UserSeeder::class,
            // departmentSeeder::class,
            // ProgramTypeSeeder::class,
            // ProgramStatuseSeeder::class,
            // programSeeder::class,
            // TermSeeder::class,
            // CourseCategorySeeder::class,
            // CourseSeeder::class,
            // TeacherSeeder::class,
            // StudentSeeder::class,
            // ProctorSeeder::class,
            // ClassSeeder::class,
            // enrollmentSeeder::class,
            // AttendanceSeeder::class,
            // AssignmentSeeder::class,
            // QuizzeSeeder::class,
            // WeekSeeder::class,
            // GradingScaleSeeder::class,
            // AssignmentSubmissionSeeder::class,
            // ExamSeeder::class,
            // ExamResultSeeder::class,
            // TechnicalTeamSeeder::class,
            // announcementSeeder::class,
            // QuizzeQuestionSeeder::class,
            // QuizzeQuestionOptionSeeder::class,
            // QuizzeAnswerSeeder::class,
            // QuizzeSubmissionSeeder::class,
            // MaterialSeeder::class,
            // ExamQuestionSeeder::class,
            // ExamAnswerSeeder::class,
            // ExamQuestionOptionSeeder::class,
            // ExamSubmissionSeeder::class,
            // AnnouncementCommentSeeder::class,
            // AcademicProgressSeeder::class,
            // RegistrationSeeder::class,
            StudentCourseSeeder::class,
            // CourseTeacherseeder::class,
            // CourseRequirementsSeeder::class,
        ]);
        // \App\Models\Student::factory(50)->create(); // Create 50 students
        // \App\Models\Course::factory(20)->create();  // Create 20 courses


    }
}
