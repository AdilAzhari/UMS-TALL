<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequirementsRequest;
use App\Http\Requests\UpdateCourseRequirementsRequest;
use App\Models\CourseRequirement;

class CourseRequirementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courseRequirements = CourseRequirement::all();

        return inertia('CourseRequirements/Index', [
            'courseRequirements' => $courseRequirements,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequirementsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseRequirement $courseRequirement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseRequirement $courseRequirement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequirementsRequest $request, CourseRequirement $courseRequirement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseRequirement $courseRequirement)
    {
        //
    }
}
