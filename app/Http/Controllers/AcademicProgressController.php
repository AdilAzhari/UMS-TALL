<?php

namespace App\Http\Controllers;

use App\Models\AcademicProgress;
use Inertia\Inertia;

class AcademicProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        // TODO: Implement __invoke() method.
        $academicProgress = AcademicProgress::where('student_id', auth()->id())->first();
        $studentProgram = auth()->user()->student->program();

        return Inertia::render('AcademicProgress', [
            'academicProgress' => $academicProgress,
            'studentProgram' => $studentProgram,
        ]);
    }
}
