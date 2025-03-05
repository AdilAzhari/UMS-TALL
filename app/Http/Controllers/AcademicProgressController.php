<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAcademicProgressRequest;
use App\Http\Requests\UpdateAcademicProgressRequest;
use App\Models\AcademicProgress;
use Inertia\Inertia;

class AcademicProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $academicProgress = AcademicProgress::where('student_id', auth()->id())->first();
        $studentProgram = auth()->user()->student->program();

        return Inertia::render('AcademicProgress', [
            'academicProgress' => $academicProgress,
            'studentProgram' => $studentProgram,
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
    public function store(StoreAcademicProgressRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicProgress $academicProgress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicProgress $academicProgress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAcademicProgressRequest $request, AcademicProgress $academicProgress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicProgress $academicProgress)
    {
        //
    }
}
