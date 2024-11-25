<?php

namespace App\Http\Controllers;

use App\Models\StoryComment;
use App\Http\Requests\StoreStoryCommentRequest;
use App\Http\Requests\UpdateStoryCommentRequest;
use Inertia\Inertia;

class StoryCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreStoryCommentRequest $request)
    {
        $data = $request->validate([
            'content' => 'required|string',
            'story_id' => 'required|exists:stories,id',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $comment = storyComment::create([
            'content' => $data['content'],
            'story_id' => $data['story_id'],
            'parent_id' => $data['parent_id'], // Distinguishes replies from top-level comments
            'student_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Comment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StoryComment $storyComment)
    {
        $comments = storyComment::where('story_id', $storyId)
            ->whereNull('parent_id') // Only top-level comments
            ->with(['replies.student.user']) // Include replies for each comment
            ->get();

        return Inertia::render('Stories/Show', [
            'comments' => $comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StoryComment $storyComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoryCommentRequest $request, StoryComment $storyComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoryComment $storyComment)
    {
        //
    }
}
