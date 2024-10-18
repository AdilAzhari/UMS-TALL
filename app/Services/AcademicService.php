<?php

namespace App\Services;

use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;

class AcademicService
{
    public function getAcademicAchievements(User $user)
    {
        // Implement logic to fetch academic achievements
        // This is a placeholder implementation
        return [
            'gpa' => 3.75,
            'completedCredits' => 90,
            'honorsReceived' => ['Dean\'s List', 'Academic Excellence Award'],
        ];
    }

    public function getCourseRegistrations(User $user)
    {
        return [
            'isOpen' => true,
            'closingDate' => Carbon::now()->addDays(30)->toDateString(),
            'registeredCourses' => $user->courses()->count(),
            'maxAllowedCourses' => 5,
        ];
    }

    public function getCurrentCourses(User $user)
    {
        return $user->courses()
            ->with(['department', 'program', 'teachers.user'])
            ->where('status', 1)
            ->get()
            ->map(function ($course) {
                return [
                    'course_name' => $course->name,
                    'teachers' => $course->teachers->pluck('user.name'),
                    'department' => $course->department->name ?? 'No Department',
                    'program' => $course->program->program_name ?? 'No Program',
                    'code' => $course->code,
                    'credit' => $course->credit,
                    'category' => ucwords(str_replace('_', ' ', $course->category)),
                ];
            });
    }

    public function getTermProgress()
    {
        // Define term start and end dates
        $termStart = Carbon::parse('2024-09-01'); // Example start date
        $termEnd = Carbon::parse('2024-12-15'); // Example end date
        $currentDate = Carbon::now();

        $totalWeeks = $termStart->diffInWeeks($termEnd);
        $currentWeek = $termStart->diffInWeeks($currentDate);

        // Ensure currentWeek doesn't exceed totalWeeks
        $currentWeek = min($currentWeek, $totalWeeks);

        return [
            'currentWeek' => $currentWeek,
            'totalWeeks' => $totalWeeks,
        ];
    }
}
