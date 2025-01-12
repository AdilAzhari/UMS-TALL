<?php

namespace App\Http\Controllers\Campus;

use App\Http\Controllers\Controller;
use App\Models\Week;
use Inertia\Inertia;
use Inertia\Response;

class LearningGuideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return inertia::render('Campus/LearningGuide/Index');
    }

    public function show(string $id): Response
    {
        $week = week::with('learningGuide')
            ->where('week_number', $id)
            ->has('learningGuide')
            ->get()
            ->pluck('learningGuide');

        return inertia::render('Campus/LearningGuide/Show', [
            'weeks' => $week,
        ]);
    }
}
