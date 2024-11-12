<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\assignProctorFormRequest;
use App\Http\Requests\CourseRegiserRequest;
use App\Models\Proctor;
use App\Models\Registration;
use Inertia\Inertia;
use App\Services\CourseRegistrationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class CourseController extends Controller
{
    protected $courseRegistrationService;

    public function __construct(CourseRegistrationService $courseRegistrationService)
    {
        $this->courseRegistrationService = $courseRegistrationService;
    }

    public function register(CourseRegiserRequest $request)
    {
        $result = $this->courseRegistrationService->registerCourses($request);

        if ($result['status'] === 'error') {
            return back()->withErrors($result['message']);
        }

        return redirect()->back()->with('success', 'Courses registered successfully!');
    }

    public function index()
    {
        $studentData = $this->courseRegistrationService->getStudentData(Auth::user());
        $availableCourses = $this->courseRegistrationService->getAvailableCourses(Auth::user());

        return Inertia::render('Courses/Index', [
            'user' => Auth::user(),
            'courses' => $studentData,
            'registrationStatus' => [
                'isOpen' => true,
                'closingDate' => '2024-10-23',
            ],
            'availableCourses' => $availableCourses,
            'studentProgram' => $studentData,
        ]);
    }
    public function showAssignProctorForm($courseID){
        return Inertia::render('ProctorDetailsForm', [
            'courseID' => $courseID,
        ]);
    }
    public function storeAssignProctorForm(assignProctorFormRequest $request, $courseID)
    {
        $data = $request->validated();
        $data['course_id'] = $courseID;
        $registration = Registration::where('id', $courseID)->first();

        $proctor = $this->courseRegistrationService->assignProctor($data);

        return redirect()->back()->with('success', 'Proctor assigned successfully!');
    }
    public function response(Request $request)
    {
        $proctor = Proctor::find($request->proctor);
        if (!$proctor) {
            return redirect()->route('courses')->with('error', 'Invalid proctor ID.');
        }
        if ($request->response === 'accept') {
            $proctor->registrations()->update(['proctor_status' => 'approved']);
            return redirect()->route('courses')->with('success', 'Proctor assignment accepted.');
        }

        if ($request->response === 'decline') {
            $proctor->registrations()->update(['proctor_status' => 'rejected']);
            return redirect()->route('courses')->with('success', 'Proctor assignment declined.');
        }

        return redirect()->route('courses')->with('error', 'Invalid response.');
    }
}
