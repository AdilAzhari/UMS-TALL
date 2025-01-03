<?php

namespace App\Http\Controllers\Campus;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Week;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($week_id, $course_id)
    {
//        todo('
//        1/ get the assignment for this week
//        2/ show the submitting status of the assignment
//        3/ display Submissions opened,Submissions closed,Assessments opened,Assessments closed
//        4/ dipsplay the result of the assignment if submitted
//        5/ allowing the submission whether by submitting a word, PDF, Doc, or manually written
//        6/ showing a section for notes if the teacher have a not on the submission
//        ');
//        $weekAssignments = week::
//        with('assignment')
//            ->whereCourseId($course_id)
//            ->has('assignment')
//            get();
//                ->dd();
                return inertia::render('Campus/Assignment/Index', []);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
