<?php

namespace App\Http\Controllers\Campus;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //        todo('list all the courses student taking this term');
        return inertia::render('Campus/Index');
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

    public function course(): Response
    {
        $course = Course::with([
            'weeks' => function ($query) {
                $query->orderBy('week_number');
            },
            'weeks.quizzes',
            'weeks.assignments',
            'weeks.materials'
        ])->findOrFail(3);

        return inertia::render('Campus/Course', [
            'weeks' => $course->weeks->map(function ($week) {
                return [
                    'id' => $week->id,
                    'week_number' => $week->week_number,
                    'learningGuidance' => $week->learningGuidance ?? [
                            'overview' => null,
                            'topics' => [],
                            'objectives' => [],
                            'tasks' => []
                        ],
                    'quizzes' => $week->quizzes,
                    'assignments' => $week->assignments,
                    'materials' => $week->materials
                ];
            }),
            'course' => [
                'name' => $course->name,
                'code' => $course->code,
                'id' => $course->id,
            ]
        ]);
    }

    public function courseAnnouncements($id): Response
    {
        return inertia::render('Campus/CourseAnnouncement');
    }

    public function showAnnouncement($courseId, $announcementId): Response
    {
        return inertia::render('Campus/Announcement/Show');
    }
}
