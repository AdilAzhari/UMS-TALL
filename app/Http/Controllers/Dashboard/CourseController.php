<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(){
        $courses = Course::with(['department', 'program','teachers.user'])->where(
            'status', 1
        )->paginate(5);

        $courseData = $courses->map(function($course) {
            return [
                'course_name' => $course->name,
                'teachers' => $course->teachers->map(function($teacher) {
                    return $teacher->user->name;
                }),
                'department' => $course->department->name ?? 'No Department', // Example for department name
                'program' => $course->program->program_name ?? 'No Program', // Example for program name
                'code' => $course->code,
                'credit' => $course->credit,
                'students' => $course->students->count(),
                'proctor' => $course->requier_proctor ? 'Required' : 'Not Required',
                'category' => ucwords(str_replace('_', ' ', $course->category)),
            ];
        });

        // return $courses->map(function($course) {
        //     return [
        //         'course_name' => $course->name,
        //         'teachers' => $course->teachers->map(function($teacher) {
        //             return $teacher->user->name;
        //         }),
        //         'department' => $course->department->code ?? 'No Department', // Example for department name
        //         'program' => $course->program->program_name ?? 'No Program', // Example for program name
        //         'status' => $course->status,
        //     ];
        // });
        return inertia('Courses/Index', [
            'courses' => $courseData,
            'registrationStatus' => [
                'isOpen' => true,
                'closingDate' => '2024-10-23',
            ],
            'academicProgress' => [
                // Add relevant academic progress data here
            ],
        ]);
    }
}
