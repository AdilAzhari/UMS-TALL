<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Inertia\Inertia;

class AchievementsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Fetch the student's enrollments with related data
        $enrollments = Enrollment::where('student_id', $user->student->id)
            ->with(['course', 'student', 'term'])
            ->pastEnrollments()
            ->get();

        // Group enrollments by term and calculate term-wise data
        $terms = $enrollments->groupBy('term_id')->map(function ($termData) {
            return [
                'term' => $termData->first()->term,
                'totalCredit' => $termData->sum(fn ($enrollment) => $enrollment->course->credit_hours ?? 0),
                'creditsPassed' => $this->calculatePassedCredits($termData),
                'gpa' => number_format($this->calculateTermGPA($termData), 2),
                'courses' => $termData->map(fn ($enrollment) => [
                    'course' => $enrollment->course,
                    'grade' => $enrollment->grade,
                ]),
            ];
        });

        // Calculate overall statistics
        $totalCredit = $terms->sum('totalCredit');
        $cumulativeGPA = $this->calculateCGPA($terms);

        // Create academic progress data
        $academicProgress = [
            'totalCreditsTaken' => $totalCredit,
            'creditsPassed' => $terms->sum('creditsPassed'),
            'creditsRemaining' => config('academics.required_credits', 120) - $totalCredit,
        ];

        return Inertia::render('AcademicAchievements', [
            'terms' => $terms->values(),
            'academicProgress' => $academicProgress,
            'cumulativeGPA' => number_format($cumulativeGPA, 2),
            'lastUpdated' => now()->toDateTimeString(),
        ]);
    }

    protected function calculateTermGPA($termData)
    {
        $totalPoints = 0;
        $totalCredits = 0;

        foreach ($termData as $enrollment) {
            $credit = $enrollment->course->credit_hours ?? 0;
            $grade = $this->getGradePoint($enrollment->grade);

            $totalPoints += ($credit * $grade);
            $totalCredits += $credit;
        }

        return $totalCredits > 0 ? ($totalPoints / $totalCredits) : 0;
    }

    protected function getGradePoint($grade)
    {
        return match ($grade) {
            'A', 'A+' => 4.0,
            'A-' => 3.7,
            'B+' => 3.3,
            'B' => 3.0,
            'B-' => 2.7,
            'C+' => 2.3,
            'C' => 2.0,
            'C-' => 1.7,
            'D+' => 1.3,
            'D' => 1.0,
            default => 0.0,
        };
    }

    protected function calculatePassedCredits($termData)
    {
        return $termData->sum(function ($enrollment) {
            $grade = $this->getGradePoint($enrollment->grade);

            return $grade >= 1.0 ? ($enrollment->course->credit_hours ?? 0) : 0;
        });
    }

    protected function calculateCGPA($terms)
    {
        $totalPoints = 0;
        $totalCredits = 0;

        foreach ($terms as $term) {
            $termCredits = $term['totalCredit'];
            $termGPA = floatval($term['gpa']);

            $totalPoints += ($termCredits * $termGPA);
            $totalCredits += $termCredits;
        }

        return $totalCredits > 0 ? ($totalPoints / $totalCredits) : 0;
    }
}
