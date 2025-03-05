<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with student data.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        // Fetch the student data with caching
        $studentData = $this->getStudentData($user);

        //        dd($studentData);
        return Inertia::render('Dashboard', [
            'studentProgram' => $studentData,
        ]);
    }

    /**
     * Fetch and format student data.
     *
     * @return array
     */
    private function getStudentData(User $user)
    {
        // Cache the student data for 1 hour to reduce database queries
        //        return Cache::remember("student_data_$user->id", 3600, function () use ($user) {

        $student = Student::with(['program.programType', 'enrollments.course', 'term'])
            ->where('user_id', $user->id)
            ->firstOrFail();

        // Fetch future, current, and past courses
        $futureCourses = $this->getCoursesByDateRange($student, 'future');
        $currentCourses = $this->getCoursesByDateRange($student, 'current');
        $pastCourses = $this->getCoursesByDateRange($student, 'past');

        return [
            'program_name' => $student->program->program_name,
            'program_type' => $student->program->programType->type,
            'registration_deadline' => $student->term->registration_end_date,
            'courses' => [
                'futureCourses' => $this->formatCourses($futureCourses),
                'currentCourses' => $this->formatCourses($currentCourses),
                'pastCourses' => $this->formatCourses($pastCourses),
            ],
        ];
        //        });
    }

    /**
     * Fetch courses based on the date range (future, current, or past).
     *
     * @return Collection
     */
    private function getCoursesByDateRange(Student $student, string $range)
    {
        $now = Carbon::now();

        return $student->enrollments()
            ->whereHas('term', function ($query) use ($range, $now): void {
                if ($range === 'future') {
                    $query->where('start_date', '>', $now)
                        ->whereNotIn('enrollment_status', ['Completed']);
                } elseif ($range === 'current') {
                    $query->where('start_date', '<=', $now)
                        ->where('end_date', '>=', $now);
                } elseif ($range === 'past') {
                    $query->where('end_date', '<', $now);
                }
            })
            ->with('course')
            ->get();
    }

    /**
     * Format the courses for the response.
     *
     * @return Collection|\Illuminate\Support\Collection
     */
    private function formatCourses(Collection $courses)
    {
        return $courses->map(function ($enrollment) {
            return [
                'id' => $enrollment->course->id,
                'name' => $enrollment->course->name,
                'code' => $enrollment->course->code,
                'status' => $enrollment->enrollment_status,
                'proctor' => $enrollment->proctor_status,
                'proctored' => $enrollment->proctored,
            ];
        });
    }
}
