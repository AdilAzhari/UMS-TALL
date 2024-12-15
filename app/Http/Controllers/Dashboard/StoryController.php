<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStoryRequest;
use App\Models\StoryTag;
use App\Services\StoryService;
use Inertia\Inertia;

class StoryController extends Controller
{
    private StoryService $storyService;

    public function __construct(StoryService $storyService)
    {
        $this->storyService = $storyService;
    }

    public function index()
    {
        $stories = $this->storyService->getAllStories();

        return Inertia::render('Stories/Index', [
            'stories' => $stories,
            'tags' => StoryTag::get(),
        ]);
    }

    public function show($storyId)
    {
        $story = $this->storyService->findStoryById($storyId);
        $comments = $story->comments()->with('student', 'student.user', 'replies.student', 'replies.student.user')->get();
        $recommendedStories = $this->storyService->getRecommendedStories();

        return Inertia::render('Stories/Show', [
            'story' => $story,
            'comments' => $comments,
            'recommendedStories' => $recommendedStories,
        ]);
    }

    public function update(StoreStoryRequest $request, $storyId)
    {
        $story = $this->storyService->updateStory($storyId, $request->validated());
        return redirect()->route('stories.index')->with('message', 'Story updated successfully!');
    }

    public function store(StoreStoryRequest $request)
    {
        $story = $this->storyService->createStory($request->validated());

        return redirect()->route('stories.index')->with('message', 'Story created successfully!');
    }

    public function create($storyId = null)
    {
        if ($storyId) {
            $story = $this->storyService->findStoryById($storyId);
            return Inertia::render('Stories/Update', [
                'story' => $story,
            ]);
        }

        return Inertia::render('Stories/Create');
    }

    public function destroy($storyId)
    {
        $this->storyService->deleteStory($storyId);

        return redirect()->route('stories.index')->with('message', 'Story deleted successfully!');
    }
}
