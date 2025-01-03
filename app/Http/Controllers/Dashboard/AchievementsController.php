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

        $studentData = Enrollment::where('student_id', $user->student->id)
            ->with(['course', 'course.CourseGrade', 'student', 'term'])
            ->pastCourses()
            ->get();
        //        CourseGrades::where('student_id', $user->student->id)->get()->dd();
        //            return $CourseGrade;
        $terms = $studentData->groupBy('term_id')->map(function ($termData) {
            $termGPA = $this->calculateTermGPA($termData);
            $creditsPassed = $this->calculatePassedCredits($termData);

            return [
                'term' => $termData->first()->term,
                'totalCredit' => $termData->sum(function ($registration) {
                    return $registration->course->credit ?? 0;
                }),
                'creditsPassed' => $creditsPassed,
                'gpa' => number_format($termGPA, 2),
                'CourseGrade' => $termData->CourseGrade,
                'courses' => $termData->map(function ($registration) {
                    return [
                        'course' => $registration->course,
                        'grade' => $registration->grade,
                    ];
                }),
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
            'totalCredit' => $totalCredit,
            'cumulativeGPA' => number_format($cumulativeGPA, 2),
        ]);
    }

    protected function calculateTermGPA($termData)
    {
        $totalPoints = 0;
        $totalCredits = 0;

        foreach ($termData as $registration) {
            $credit = $registration->course->credit ?? 0;
            $grade = $this->getGradePoint($registration->grade);

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
        return $termData->sum(function ($registration) {
            $grade = $this->getGradePoint($registration->grade);

            return $grade >= 1.0 ? ($registration->course->credit ?? 0) : 0;
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
