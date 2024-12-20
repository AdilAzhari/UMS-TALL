<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoryCommentRequest;
use App\Http\Requests\UpdateStoryCommentRequest;
use App\Models\Story;
use App\Models\StoryComment;
use Illuminate\Http\RedirectResponse;

class StoryCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function storeComment(StoreStoryCommentRequest $request): RedirectResponse
    {
        $story = Story::findOrFail($request->story_id);

        $story->comments()->create($request->all() + [
            'student_id' => $story->student_id,
            'published_at' => now(),
        ]);

        return redirect()->back()->with('message', 'Comment created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateComment(UpdateStoryCommentRequest $request, $storyId, $commentId)
    {
        $comment = StoryComment::findOrFail($commentId);
        $request->merge([
            'published_at' => now(),
        ]);
        $comment->update($request->all());

        return redirect()->back()->with('message', 'Comment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyComment($storyId, $commentId)
    {
        $storyComment = StoryComment::where('id', $commentId)->where('story_id', $storyId)->firstOrFail();
        $storyComment->delete();

        return redirect()->back()->with('message', 'Comment deleted successfully.');
    }
}
