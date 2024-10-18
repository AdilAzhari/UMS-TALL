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
        // todo: get the prgram name of the student :Done
        // todo: get the department of the student
        // todo: get the current week of the course
        // todo: get the credits completed
        // todo: get the gpa
        // todo: get the cumulative gpa
        // todo: get the cumulative gpa by term
        // todo: get the curent courses
        // todo: get the current term courses
        // todo: get the past courses
        // todo: get the future courses if the student is registered


        $programName = User::where('id', Auth::user()->id)
            ->with('student.program:id,program_name,program_type', 'student.academicProgress', 'student.enrollments', 'student.courses', 'student.registrations')
            ->get();

        $studentData = $programName->map(function ($user) {
                return [
                    'program_name' => $user->student->program->program_name,
                    'program_type' => $user->student->program->program_type,
                    'term' => $user->student->registrations,
                    'academicProgress' => $user->student->academicProgress,
                    'enrollments' => $user->student->enrollments,
                    'courses' => $user->student->courses,
                    'currentWeekNumber' => $user->student->weeks,
                    'studentDepartment' => $user->student->department,
                    'currentCourses' => $user->student->enrollments->map(function($enrollment) {
                        return $enrollment->where('status','pending')->get();
                        }),
                    'futureCourses' => $user->student->enrollments->map(function($enrollment) {
                        return $enrollment->where('status','enrolled');
                    }),
                    // 'pastCourses' => $user->student->terms,
                ];
            });


        // $currentWeekNumber = Week::where('term_id', auth::user()->id)->with('course')->get();
        // $creditCompleted = Student::where('id', auth::user()->id)->with('course')->get();
        // $enrollment = enrollment::where('student_id', auth::user()->id)->with('course')->get();
        // $academicProgress = User::where('id', Auth::user()->id)->with('student.academicProgress')->get();
        dd($studentData);
        // return inertia('Dashboard', [
        //     'studentProgram' => $studentProgram,
        // ]);
    }
}
