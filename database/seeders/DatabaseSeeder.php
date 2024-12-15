<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        User::factory()->create([
//            'name' => 'admin',
//            'email' => 'admin@example.com',
//            'password' => '12345678',
//        ]);
//        User::factory()->create([
//            'name' => 'teacher',
//            'email' => 'teacher@example.com',
//            'password' => '12345678',
//        ]);
        $this->call([
//            UserSeeder::class,
//            departmentSeeder::class,
//            ProgramTypeSeeder::class,
//            ProgramStatuseSeeder::class,
//            programSeeder::class,
//            TermSeeder::class,
//            CourseCategorySeeder::class,
//            CourseSeeder::class,
//            TeacherSeeder::class,
//            StudentSeeder::class,
//            ProctorSeeder::class,
//            ClassSeeder::class,
//            enrollmentSeeder::class,
//            AttendanceSeeder::class,
//            AssignmentSeeder::class,
//            QuizzeSeeder::class,
//            WeekSeeder::class,
//            GradingScaleSeeder::class,
//            AssignmentSubmissionSeeder::class,
//            ExamSeeder::class,
            ExamResultSeeder::class,
            TechnicalTeamSeeder::class,
            announcementSeeder::class,
            QuizzeQuestionSeeder::class,
            QuizzeQuestionOptionSeeder::class,
            QuizzeAnswerSeeder::class,
            QuizzeSubmissionSeeder::class,
            MaterialSeeder::class,
            ExamQuestionSeeder::class,
            ExamAnswerSeeder::class,
            ExamQuestionOptionSeeder::class,
            AnnouncementCommentSeeder::class,
            AcademicProgressSeeder::class,
            RegistrationSeeder::class,
            StudentCourseSeeder::class,
            CourseTeacherseeder::class,
            CourseRequirementsSeeder::class,
            linkSeeder::class,
            CourseGradesSeeder::class,
            AcademicAchievementSeeder::class,
            PaymentSeeder::class,
            StorySeeder::class,
            StoryTagSeeder::class,
            StoryCommentSeeder::class
        ]);
    }
}
