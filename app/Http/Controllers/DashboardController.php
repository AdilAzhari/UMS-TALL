<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Term;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $programName = User::where('id', $user->id)
            ->with([
                'student.program:id,program_name',
                'student.academicProgress',
                'student.enrollments',
                'student.courses',
                'student.registrations',
                'student.department:id,name,code',
            ])
            ->first();

        $studentData = $this->buildStudentData($programName);

        // return $studentData;
        return Inertia::render('Dashboard', [
            'studentProgram' => $studentData,
        ]);
    }

    private function buildStudentData($programName)
    {
        $term = Term::where('end_date', '<', now())
            ->orderBy('end_date', 'desc')
            ->first();
        $user = Auth::user();
        $programName = User::where('id', $user->id)
            ->with([
                'student.program:id,program_name',
                'student.academicProgress',
                'student.enrollments',
                'student.courses',
                'student.registrations',
                'student.department:id,name,code',
            ])
            ->first();

        $term = Term::where('end_date', '<', now())
            ->orderBy('end_date', 'desc')
            ->first();

        $pastCourses = Registration::where('student_id', $user->student->id)->PastCourses()->get();
        $futureCourses = Registration::where('student_id', $user->student->id)->futureCourses()->get();

        return [
            'courses' => [
                'pastCourses' => $this->mapCourses($pastCourses),
                'futureCourses' => $this->mapCourses($futureCourses),
            ],
            'program_name' => $programName->student->program->program_name ?? null,
            'currentTerm' => $term->name ?? null,
            'academicProgress' => $programName->student->academicProgress,
            'programType' => $programName->program->programType ?? null,
            'studentDepartment' => $programName->student->department ? [
                'name' => $programName->student->department->name,
                'code' => $programName->student->department->code,
            ] : null,
            'totalCredit' => collect($programName->student->courses ?? [])->sum('credit'),
            'gpa' => $programName->student->academicProgress->map(fn ($progress) => $progress->gpa)->first() ?? null,
        ];
    }

    protected function mapCourses($courses)
    {
        return $courses->map(fn ($course) => [
            'id' => $course->id,
            'name' => $course->course->name,
            'status' => $course->registration,
            'proctor' => $course->proctor_status,
            'paid' => $course->course->paid,
            'credit' => $course->course->credit,
            'proctorType' => $course->proctorType,
            'code' => $course->course->code,
            'examDate' => $course->course->exam->exam_date ?? 'This course exam data has not been set yet',
            'description' => $course->course->description,
        ]) ?? [];
    }

    private function getStudentDepartment($student)
    {
        if (! $student->department) {
            return null;
        }

        return [
            'name' => $student->department->name,
            'code' => $student->department->code,
        ];
    }

    private function mapEnrollments($enrollments, $status)
    {
        return $enrollments->filter(fn ($enrollment) => $enrollment->status === $status)
            ->map(fn ($enrollment) => [
                'id' => $enrollment->id,
                'course_name' => optional($enrollment->course)->name,
                'course_code' => optional($enrollment->course)->code,
                'status' => $enrollment->status,
                'proctor' => optional(optional($enrollment->registrations->first())->proctor)->name,
                'payment_status' => optional($enrollment->registrations->first())->payment_status,
                'total_credits' => optional($enrollment->course)->credit,
            ]);
    }
}
