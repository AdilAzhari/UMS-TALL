<?php

namespace App\Http\Controllers;

use App\Models\AcademicProgress;
use App\Models\enrollment;
use App\Models\Program;
use App\Models\Student;
use App\Models\Term;
use App\Models\User;
use App\Models\Week;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // todo: get the current term of the student :Done

        $user = Auth::user();

        $programName = User::where('id', $user->id)
            ->with([
                'student.program:id,program_name',
                'student.academicProgress',
                'student.enrollments',
                'student.courses',
                'student.registrations',
                'student.department:id,name,code' // Added fields to load specific department info
            ])
            ->first();

            $studentData = [
                'programName' => $programName->student->program->program_name ?? null,
                'programType' => $programName->student->program->programType ?? null,
                'term' => $programName->student->registrations ?? null,
                'academicProgress' => $programName->student->academicProgress->map(fn($progress) => $progress->academic_standing)->first() ?? null,
                'courses' => $programName->student->courses->map(fn($course) => [
                    'id' => $course->id,
                    'name' => $course->name,
                    'category' => $course->category,
                ]) ?? null,
                'currentWeekNumber' => $programName->student->courses->map(fn($course) => $course->weeks->map(fn($week) => $week->week_number))->flatten()->unique()->sort()->first() ?? null,
                'studentDepartment' => $programName->student->department ? [
                    'name' => $programName->student->department->name,
                    'code' => $programName->student->department->code,
                ] : null,
                'totalCredit' => collect($programName->student->courses ?? [])->sum('credit'),
                'pastCourses' => $programName->student->enrollments
                    ->filter(fn($enrollment) => $enrollment->status === 'completed' && $enrollment->completion_date < now())
                    ->map(fn($enrollment) => [
                        'id' => $enrollment->id,
                        'course_name' => $enrollment->course->name ?? null,
                        'course_code' => $enrollment->course->code ?? null,
                        'status' => $enrollment->status ?? null,
                        'proctor' => $enrollment->registrations->map(fn($registration) => $registration->proctor->name)->first() ?? null,
                        'payment_status' => $enrollment->registrations->map(fn($registration) => $registration->payment_status)->first() ?? null,
                        'total_credits' => $enrollment->course->credit ?? null,
                    ]),
                'currentCourses' => $programName->student->enrollments
                    ->filter(fn($enrollment) => $enrollment->status === 'pending')
                    ->map(fn($enrollment) => [
                        'id' => $enrollment->id,
                        'courseName' => $enrollment->course->name ?? null,
                        'courseCode' => $enrollment->course->code ?? null,
                        'status' => $enrollment->status ?? null,
                        'enrollmentDate' => $enrollment->enrollment_date ?? null,
                        'proctor' => $enrollment->registrations->map(fn($registration) => $registration->proctor->name)->first() ?? null,
                        'paymentStatus' => $enrollment->registrations->map(fn($registration) => $registration->payment_status)->first() ?? null,
                    ]),
                'futureCourses' => $programName->student->enrollments
                    ->filter(fn($enrollment) => $enrollment->status === 'enrolled')
                    ->map(fn($enrollment) => [
                        'id' => $enrollment->id,
                        'course_name' => $enrollment->course->name ?? null,
                        'course_code' => $enrollment->course->code ?? null,
                        'status' => $enrollment->status ?? null,
                        'proctor' => $enrollment->registrations->map(fn($registration) => $registration->proctor->name)->first() ?? null,
                        'payment_status' => $enrollment->registrations->map(fn($registration) => $registration->payment_status)->first() ?? null,
                    ]),
                'majorElectiveCount' => $programName->student->courses->filter(fn($courses) => $courses->category === 'major_elective')->count() ?? [],
                'general' => $programName->student->courses->filter(fn($courses) => $courses->category === 'general') ?? [],
                'general_education' => $programName->student->courses->filter(fn($courses) => $courses->category === 'general_education') ?? [],
                'major_required' => $programName->student->courses->filter(fn($courses) => $courses->category === 'major_required') ? [
                    'count' => $programName->student->courses->filter(fn($courses) => $courses->category === 'major_required')->count(),
                    'courses' => $programName->student->courses->filter(fn($courses) => $courses->category === 'major_required')->map(fn($course) => [
                        'id' => $course->id,
                        'name' => $course->name,
                    ])
                ] : null,
                'gpa' => $programName->student->academicProgress->map(fn($progress) => $progress->gpa)->first() ?? null,
            ];


        // return $studentData  ;
        return inertia('Dashboard', [
            'studentProgram' => $studentData,
        ]);
    }
}
