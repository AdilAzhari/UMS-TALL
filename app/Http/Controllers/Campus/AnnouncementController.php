<?php

namespace App\Http\Controllers\Campus;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnnouncementCommentRequest;
use App\Models\Announcement;
use App\Models\AnnouncementComment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AnnouncementController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnnouncementCommentRequest $request, Announcement $announcement)
    {
        $request->validated();
        $comment = AnnouncementComment::create([
            'announcement_id' => $request->announcement_id,
            'comment' => $request->comment,
            'user_id' => $request->user()->id,
            'commented_by' => $request->user()->id,
        ]);

        return redirect()->back()->with('message', 'Reply submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $courseId, string $announcementId)
    {
        $announcement = Announcement::findOrFail($announcementId)
            ->load('comments.user', 'user');

        return inertia::render('Campus/Announcement/Show', [
            'announcement' => $announcement,
            'courseId' => $courseId,
        ]);
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
