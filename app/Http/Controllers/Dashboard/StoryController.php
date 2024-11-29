<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Models\StoryComment;
use App\Models\StoryTag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::with('student', 'student.user')
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return Inertia::render('Stories/Index', [
            'stories' => $stories,
            'tags' => StoryTag::get(),
        ]);
    }

    public function storeComment(Request $request, $id)
    {
        dd($id, $request->all());
        $story = Story::where('id', $id)->firstOrFail();

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        dd($request);
        StoryComment::create([
            'story_id' => $story->id,
            'student_id' => auth()->id(),
            'content' => $request->content,
            'approved' => false, // Requires admin approval
        ]);

        return back()->with('success', 'Your comment has been submitted and is awaiting approval.');
    }

    public function show($storyId)
    {
        $story = Story::with('student', 'student.user')->findOrFail($storyId);

        $comments = $story->comments()->with('student', 'student.user', 'replies.student', 'replies.student.user')->get();

        $recommendedStories = Story::with('student', 'student.user')->inRandomOrder()->limit(3)->get();

        return Inertia::render('Stories/Show', [
            'story' => $story,
            'comments' => $comments,
            'recommendedStories' => $recommendedStories,
        ]);
    }

    public function edit($storyId)
    {
        $story = Story::findOrFail($storyId);
        return Inertia::render('Stories/Edit', [
            'story' => $story,
        ]);
    }
}
