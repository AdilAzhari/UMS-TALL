<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Teacher;
use App\Services\CourseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    protected $courseService;
    public function __construct(CourseService $courseService){
        $this->courseService = $courseService;
    }
    public function index(){
        $user = Auth::user();
        return $this->courseService->getCurrentCourses($user);

        // return inertia('Courses/Index', [
        //     'courses' => $courseData,
        //     'registrationStatus' => [
        //         'isOpen' => true,
        //         'closingDate' => '2024-10-23',
        //     ],
        //     'academicProgress' => [
        //         // Add relevant academic progress data here
        //     ],
        // ]);
    }
}
