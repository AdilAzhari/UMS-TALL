<?php

namespace App\Http\Controllers\Campus;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Material;
use Inertia\Inertia;
use Inertia\Response;
use JetBrains\PhpStorm\NoReturn;

class CampusController extends Controller
{
    /**
     * Display a listing of the student courses within the current term.
     */
    public function index(): Response
    {
        $student = auth()->user()->student->load(['courses', 'term']);

        return inertia::render('Campus/Index', [
            'student' => $student,
        ]);
    }

    public function course($id): Response
    {
        $course = Course::with([
            'weeks' => function ($query): void {
                $query->orderBy('week_number');
            },
            'weeks.quizzes',
            'weeks.assignments',
            'weeks.materials',
            'materials',
            'announcements' => function ($query): void {
                $query->with('createdBy.user')->latest();
            },
        ])->findOrFail($id);

        // Fetch syllabus items
        $syllabus = Material::where('course_id', $course->id)
            ->where('content_type', 'syllabus')
            ->get();

        // Fetch resources
        $resources = Material::where('course_id', $course->id)
            ->where('content_type', 'resource')
            ->get();

        return Inertia::render('Campus/Course', [
            'courseId' => $course->id,
            'weeks' => $course->weeks->map(function ($week) {
                return [
                    'id' => $week->id,
                    'week_number' => $week->week_number,
                    'title' => $week->title,
                    'start_date' => $week->start_date,
                    'end_date' => $week->end_date,
                    'materials' => $week->materials,
                    'assignments' => $week->assignments,
                    'quizzes' => $week->quizzes,
                ];
            }),
            'course' => [
                'name' => $course->name,
                'code' => $course->code,
                'id' => $course->id,
            ],
            'announcements' => $course->announcements->map(function ($announcement) {
                return [
                    'id' => $announcement->id,
                    'title' => $announcement->title,
                    'description' => $announcement->message,
                    'created_at' => $announcement->created_at,
                    'type' => $announcement->type,
                    'author' => $announcement,
                ];
            }),
            'syllabus' => $syllabus->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'description' => $item->description,
                    'date' => $item->created_at, // Use created_at or a custom date field
                ];
            }),
            'resources' => $resources->map(function ($resource) {
                return [
                    'id' => $resource->id,
                    'title' => $resource->title,
                    'description' => $resource->description,
                    'type' => $resource->type,
                    'url' => $resource->url,
                    'size' => $resource->size,
                ];
            }),
        ]);
    }

    public function courseAnnouncements($id): Response
    {
        dd($this->course()->id);

        return inertia::render('Campus/CourseAnnouncement');
    }

    public function showAnnouncement($courseId, $announcementId): Response
    {
        return inertia::render('Campus/Announcement/Show');
    }

    #[NoReturn]
    public function storeAnnouncement(int $id)
    {
        dd('hello');
    }
}
