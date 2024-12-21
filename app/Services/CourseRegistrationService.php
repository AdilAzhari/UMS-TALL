<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Proctor;
use App\Models\Registration;
use App\Models\Term;
use App\Models\User;
use App\Notifications\AssignProctorNotification;
use App\Notifications\CourseRegistrationNotification;
use Illuminate\Support\Facades\Notification;

class CourseRegistrationService
{
    public function registerCourses($request): array
    {
        $studentId = auth()->user()->student->id;
        $validated = $request->validated();

        if (count($validated['courses']) > 4) {
            return ['status' => 'error', 'message' => 'You cannot register for more than 4 courses.'];
        }

        $currentTerm = $this->getCurrentTerm();

        foreach ($validated['courses'] as $courseId) {
            $course = (new Course)->find($courseId);
            if (!$course) {
                return ['status' => 'error', 'message' => 'Invalid course selected.'];
            }

            $error = $this->checkRegistrationEligibility($studentId, $courseId, $currentTerm);
            if ($error) {
                return ['status' => 'error', 'message' => $error];
            }

            $registration = (new Registration)->create([
                'student_id' => $studentId,
                'course_id' => $courseId,
                'proctor_id' => 1,
                'term_id' => $currentTerm->id,
                'status' => 'registered',
                'proctor_status' => 'pending',
                'registered_at' => now(),
                'payment_status' => 'unpaid',
            ]);

            $this->sendRegistrationNotification($registration, $course);
        }

        return ['status' => 'success'];
    }

    protected function getCurrentTerm(): Term
    {
        return (new Term)->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();
    }

    protected function checkRegistrationEligibility($studentId, $courseId, $currentTerm): ?string
    {
        $existingRegistration = (new Registration)->where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->where('term_id', $currentTerm->id)
            ->first();
        if ($existingRegistration) {
            return 'You have already registered for this course.';
        }

        $passedCourse = (new Registration)->where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->where('status', 'passed')
            ->first();
        if ($passedCourse) {
            return 'You have already passed this course.';
        }

        $failedCourse = (new Registration)->where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->where('status', 'failed')
            ->first();
        if ($failedCourse) {
            return 'You have already failed this course.';
        }

        return null;
    }

    protected function sendRegistrationNotification($registration, $course): void
    {
        $requiresProctor = $course->requier_proctor;
        if ($registration->proctor_id) {
            Notification::send(auth()->user(), new CourseRegistrationNotification($course, $registration->proctor_status, $requiresProctor));
        }
    }

    public function getStudentData($user): array
    {
        $programName = (new User)->where('id', $user->id)
            ->with([
                'student.program:id,program_name',
                'student.academicProgress',
                'student.enrollments',
                'student.courses',
                'student.registrations',
                'student.department:id,name,code',
            ])
            ->first();

        $term = (new Term)->where('end_date', '<', now())
            ->orderBy('end_date', 'desc')
            ->first();

        $pastCourses = (new Registration)->where('student_id', $user->student->id)->PastCourses()->get();
        $futureCourses = (new Registration)->where('student_id', $user->student->id)->futureCourses()->get();
        $currentCourses = (new Registration)->where('student_id', $user->student->id)->currentCourses()->get();
        $ProctoredCourses = (new Registration)->where('student_id', $user->student->id)->proctored()->get();

        return [
            'courses' => [
                'past' => $this->mapCourses($pastCourses),
                'current' => $this->mapCourses($currentCourses),
                'future' => $this->mapCourses($futureCourses),
                'futureProctoredCourses' => $this->mapCourses($ProctoredCourses),
            ],
            'program_name' => $programName->student->program->program_name ?? null,
            'currentTerm' => $term->name ?? null,
            'academicProgress' => $programName->student->academicProgress,
            'studentDepartment' => $programName->student->department ? [
                'name' => $programName->student->department->name,
                'code' => $programName->student->department->code,
            ] : null,
            'totalCredit' => collect($programName->student->courses ?? [])->sum('credit'),
            'gpa' => $programName->student->academicProgress->map(fn($progress) => $progress->gpa)->first() ?? null,
        ];
    }

    protected function mapCourses($courses): array
    {
        return $courses->map(fn($course) => [
            'id' => $course->id,
            'name' => $course->course->name,
            'status' => $course->status,
            'proctor' => $course->proctor_status,
            'paid' => $course->course->paid,
            'credit' => $course->course->credit,
            'proctorType' => $course->proctorType,
            'code' => $course->course->code,
            'examDate' => $course->course->exam->exam_date ?? 'This course exam data has not been set yet',
            'description' => $course->course->description,
        ]) ?? [];
    }

    public function getAvailableCourses($user): Course
    {
        $pastCourses = (new Registration)->where('student_id', $user->student->id)->PastCourses()->pluck('course_id');
        $currentCourses = (new Registration)->where('student_id', $user->student->id)->currentCourses()->pluck('course_id');
        $futureCourses = (new Registration)->where('student_id', $user->student->id)->futureCourses()->pluck('course_id');

        return (new Course)->whereNotIn('id', $pastCourses)
            ->whereNotIn('id', $currentCourses)
            ->whereNotIn('id', $futureCourses)
            ->get();
    }

    public function assignProctor($data): array
    {
        $studentId = auth()->user()->student->id;
        $validated = $data;
        $course = (new Registration)->find($validated['course_id']);

        $proctor = (new Proctor)->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'country' => $validated['country'],
            'student_id' => $studentId,
        ]);

        Notification::send($proctor, new AssignProctorNotification($course->course, $proctor));

        return ['status' => 'success'];
    }
}
