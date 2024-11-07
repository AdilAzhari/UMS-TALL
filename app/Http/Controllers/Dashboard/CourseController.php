<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRegiserRequest;
use App\Models\Course;
use App\Models\CourseRequirement;
use App\Models\Registration;
use Illuminate\Support\Facades\Notification;
use App\Models\Term;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // Todo: Add course categories
    // Todo: Add course registration logic
    // Todo: Add course registration validation
    // Todo: show registered courses
    // Todo: show course registration status
    // Todo: show course registration closing date
    // Todo: show course registration success message
    // Todo: show course registration error message
    // Todo: show course registration form validation error message
    // Todo: for the courses that require prerequisites, show the prerequisites
    // Todo: for courses requiring proctor after, show form for proctor details
    // Todo: show course registration closing date
    // Todo: after registration, show registered courses and status
    // Todo: sending email to student after registration
    // Todo: sending email to proctor after registration (if any) and if they have accepted the course will be added to the course list.
    // Todo: if not, show the reason why it was rejected (and send email to student) and it will not be added to the course list.
    // Todo: sending email to teacher after registration
    // Todo: show time left for course registration to close

    public function register(CourseRegiserRequest $request)
    {
        try {

            // Get the authenticated student ID
            $student = auth()->user()->student->id;
            // Check maximum course limit
            $validated = $request->validated();
            if (count($validated['courses']) > 4) {
                return back()->withErrors([
                    'courses' => 'You cannot register for more than 4 courses.'
                ]);
            }
            // Get current active term
            $currentTerm = Term::where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->first();

            if (!$currentTerm) {
                return back()->withErrors([
                    'courses' => 'No active term found for registration.'
                ]);
            }
            // Register each course
            foreach ($validated['courses'] as $courseId) {
                $course = Course::find($courseId);
                if (!$course) {
                    return back()->withErrors([
                        'courses' => 'Invalid course selected.'
                    ]);
                }
                // Check if the student has already registered for the course
                $existingRegistration = Registration::where('student_id', $student)
                    ->where('course_id', $courseId)
                    ->where('term_id', $currentTerm->id)
                    ->first();

                if ($existingRegistration) {
                    return back()->withErrors([
                        'courses' => 'You have already registered for ' . $course->name . '.'
                    ]);
                }

                // Check if the student has already passed the course
                $passedCourse = Registration::where('student_id', $student)
                    ->where('course_id', $courseId)
                    ->where('status', 'passed')
                    ->first();

                if ($passedCourse) {
                    return back()->withErrors([
                        'courses' => 'You have already passed ' . $course->name . '.'
                    ]);
                }
                // Check if the student has already failed the course
                $failedCourse = Registration::where('student_id', $student)
                    ->where('course_id', $courseId)
                    ->where('status', 'failed')
                    ->first();

                if ($failedCourse) {
                    return back()->withErrors([
                        'courses' => 'You have already failed ' . $course->name . '.'
                    ]);
                }
                // Register the course
               $registration = Registration::create([
                    'student_id' => $student,
                    'course_id' => $courseId,
                    'proctor_id' => 1,
                    'term_id' => $currentTerm->id,
                    'status' => 'registered',
                    'proctor_status' => 'pending',
                    'registered_at' => now(),
                    'payment_status' => false,
                ]);
                dd($registration);
                // Send email to student

                // Notification::send();
                // Send email to teacher
                // Send email to proctor (if any)

            }
            return redirect()->back()->with('success', 'Courses registered successfully!');

        } catch (\Exception $e) {
            return back()->withErrors([
                'courses' => 'An error occurred while registering courses. Please try again.'
            ]);
        }
    }

    public function index(){
        $user = Auth::user();
        $programName = User::where('id', $user->id)
            ->with([
                'student.program:id,program_name',
                'student.academicProgress',
                'student.enrollments',
                'student.courses',
                'student.registrations',
                'student.department:id,name,code'
            ])
            ->first();

            $term = Term::where('end_date', '<', now())
                ->orderBy('end_date', 'desc')
                ->first();

            $pastCourses = Registration::where('student_id', $user->student->id)->PastCourses()->get();
            $futureCourses = Registration::where('student_id', $user->student->id)->futureCourses()->get();
            $currentCourses = Registration::where('student_id', $user->student->id)->currentCourses()->get();

            $studentData = [
                'courses' => [
                    'past' => $pastCourses->map(fn($course) => [
                        'id' => $course->id,
                        'name' => $course->course->name,
                        'code' => $course->course->code,
                        'status' => $course->status,
                        'proctor' => $course->proctor_status,
                        'paid' => $course->course->paid,
                        'grade' => $course->grade,
                        'sequence' => $course->course->sequence > 1 ? 'retake' : 'first attempt',
                        'credit' => $course->course->credit,
                        'category' => $course->course->category->name,
                        'prerequisite' => $course->course->prerequisite_course_id ? Course::find($course->course->prerequisite_course_id)->name : null,
                        'instructors' => $course->course->teachers->map(fn($teacher) => $teacher->name),
                        'requier_proctor' => $course->course->requier_proctor ? 'Required' : 'Not Required',
                        'term' => $course->term->name,
                    ]) ?? [],
                    'current' => $currentCourses->map(fn($course) => [
                        'id' => $course->id,
                        'name' => $course->course->name,
                        'status' => $course->status,
                        'proctor' => $course->proctor_status,
                        'paid' => $course->course->paid,
                        'sequence' => $course->course->sequence ?? 'first attempt',
                        'credit' => $course->course->credit,
                        'category' => $course->course->category->name,
                        // 'prerequisite' => $course->course->prerequisite_course_id ? Course::find($course->course->prerequisite_course_id)->name : null,
                        'instructors' => $course->course->teachers->map(fn($teacher) => $teacher->name),
                        'courseRequirements' => CourseRequirement::where('program_id', $programName->student->program_id)->get(),
                        // 'courseRequirements' => $course->course->courseRequirements ?? [],
                    ]) ?? [],
                    'future' => $futureCourses->map(fn($course) => [
                        'id' => $course->id,
                        'name' => $course->course->name,
                        'code' => $course->course->code,
                        'status' => $course->status,
                    ]) ?? [],
                ],
                'program_name' => $programName->student->program->program_name ?? null,
                'currentTerm' => $term->name ?? null,
                'academicProgress' => $programName->student->academicProgress,
                'currentWeekNumber' => $programName->student->courses->map(fn($course) => $course->weeks->map(fn($week) => $week->week_number))->flatten()->unique()->sort()->first() ?? null,
                'studentDepartment' => $programName->student->department ? [
                    'name' => $programName->student->department->name,
                    'code' => $programName->student->department->code,
                ] : null,
                'totalCredit' => collect($programName->student->courses ?? [])->sum('credit'),
                'courseCategories' => $programName->student->courseCategories(),
                'categoryCounts' => $pastCourses->groupBy('course.category.name')->map(function ($courses, $categoryName) {
                    return [
                        'name' => $categoryName,
                        'count' => $courses->count(),
                    ];
                })->values(),
                'gpa' => $programName->student->academicProgress->map(fn($progress) => $progress->gpa)->first() ?? null,
                // 'courseRequirements' => CourseRequirement::where('program_id', $programName->student->program_id)->get(),
                'sequence' => $programName->student->courses->map(fn($course) => $course->sequence)->flatten()->unique()->sort()->first() ?? null,
            ];
            $availableCourses = course::whereNotIn('id', $pastCourses->pluck('course_id'))
                    ->orWhereNotIn('id', $currentCourses->pluck('course_id'))
                    ->orWhereNotIn('id', $futureCourses->pluck('course_id'))
                    ->get();

            // return $availableCourses->count();
        return inertia('Courses/Index', [
            'user' => $user,
            'courses' => $studentData,
            'registrationStatus' => [
                'isOpen' => true,
                'closingDate' => '2024-10-23',
            ],
            'availableCourses' => $availableCourses,
            'studentProgram' => $studentData,
        ]);
    }
}
