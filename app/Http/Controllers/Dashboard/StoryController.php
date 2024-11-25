<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Models\StoryComment;
use Illuminate\Http\Request;
use Inertia\Inertia;

use function Termwind\render;

class StoryController extends Controller
{
    public function index()
    {
        $story = Story::with('comments','student','student.user','replies')
            // ->where('published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(10);
        $comments = StoryComment::with('replies')->whereNull('parent_id')->with('replies.student.user')->get();
        $recommendedStories = Story::with('student')->inRandomOrder()->limit(3)->get();
        // dd($story->toArray(),$comments,$recommendedStories);
        return Inertia::render('Stories/Index', [
            'story' => $story->toArray(),
            'comments' => $comments,
            'recommendedStories' => $recommendedStories,
        ]);
    }

    public function store(Request $request, $slug)
    {
        $story = Story::where('slug', $slug)->firstOrFail();

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

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
        $story = Story::with('student.user')->findOrFail($storyId);

        $comments = StoryComment::where('story_id', $storyId)
            ->whereNull('parent_id')->with('replies.student.user')->get();

        $recommendedStories = Story::with('student')->inRandomOrder()->limit(3)->get();

        return Inertia::render('Stories/Show', [
            'story' => $story,
            'comments' => $comments,
            'recommendedStories' => $recommendedStories,
        ]);
    }
}
