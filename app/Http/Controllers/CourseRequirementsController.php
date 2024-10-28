<?php

namespace App\Http\Controllers;

use App\Models\CourseRequirements;
use App\Http\Requests\StoreCourseRequirementsRequest;
use App\Http\Requests\UpdateCourseRequirementsRequest;

class CourseRequirementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courseRequirements = CourseRequirements::all();
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
    public function show(CourseRequirements $courseRequirements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseRequirements $courseRequirements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequirementsRequest $request, CourseRequirements $courseRequirements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseRequirements $courseRequirements)
    {
        //
    }
}
