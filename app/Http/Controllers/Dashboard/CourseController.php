<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;
use App\Services\CourseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // Todo: Add course categories
    // Todo: Add course registration logic
    // Todo: Add course registration validation
    // Todo: Add course registration view
    // Todo: show courses based on course categories
    // Todo: show available courses
    // Todo: show registered courses
    // Todo: show course registration status
    // Todo: show course registration closing date
    // Todo: show academic progress (CGPA)
    // Todo: show course registration form
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
    // Todo: show course registration closing date
    // Todo: show time left for course registration to close
    // public function index(){
    //     $user = Auth::user();
    //     // return "Hello";
    //     return inertia('Courses/Index', [
    //         'user' => $user,
    //     ]);
    // }
    public function registration(){
        $user = Auth::user();
        // $courseCategories = CourseCategory::all();
        return inertia('Courses/CourseRegistration', [
            'user' => $user,
            // 'courseCategories' => $courseCategories,
        ]);
    }
    protected $courseService;
    public function __construct(CourseService $courseService){
        $this->courseService = $courseService;
    }
    public function index(){
        $user = Auth::user();
        $courseData = $this->courseService->getCurrentCourses($user);
        $programName = User::where('id', $user->id)
            ->with([
                'student.program:id,program_name,program_type',
                'student.academicProgress',
                'student.enrollments',
                'student.courses',
                'student.registrations',
                'student.department:id,name,code' // Added fields to load specific department info
            ])
            ->first();

            $studentData = [
                'program_name' => $programName->student->program->program_name ?? null,
                'program_type' => $programName->student->program->program_type ?? null,
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
                        'course_name' => $enrollment->course->name ?? null,
                        'course_code' => $enrollment->course->code ?? null,
                        'status' => $enrollment->status ?? null,
                        'enrollment_date' => $enrollment->enrollment_date ?? null,
                        'proctor' => $enrollment->registrations->map(fn($registration) => $registration->proctor->name)->first() ?? null,
                        'payment_status' => $enrollment->registrations->map(fn($registration) => $registration->payment_status)->first() ?? null,
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
                'general_education' => $programName->student->courses->filter(fn($courses) => $courses->category === 'general_education')->map(fn($course) => [
                    'id' => $course->id,
                    'name' => $course->name,
                ])->count() ?? [],
                'major_required' => $programName->student->courses->filter(fn($courses) => $courses->category === 'major_required') ? [
                    'count' => $programName->student->courses->filter(fn($courses) => $courses->category === 'major_required')->count(),
                    'courses' => $programName->student->courses->filter(fn($courses) => $courses->category === 'major_required')->map(fn($course) => [
                        'id' => $course->id,
                        'name' => $course->name,
                    ])
                ] : null,
                'gpa' => $programName->student->academicProgress->map(fn($progress) => $progress->gpa)->first() ?? null,
            ];


        return inertia('Courses/Index', [
            'user' => $user,
            'courses' => $courseData,
            'registrationStatus' => [
                'isOpen' => true,
                'closingDate' => '2024-10-23',
            ],
            'studentProgram' => $studentData,
        ]);
    }
}
