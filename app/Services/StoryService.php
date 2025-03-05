<?php

namespace App\Services;

use App\Models\Story;
use HTMLPurifier;
use HTMLPurifier_Config;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

class StoryService
{
    public function getAllStories($paginate = 10): LengthAwarePaginator
    {
        return Story::with('student', 'student.user')
            ->published()
            ->orderBy('published_at', 'desc')
            ->paginate($paginate);
    }

    public function createStory($data): Story
    {
        $validatedData = validator($data, [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'in:draft,published',
            'image' => 'nullable|max:2048',
        ])->validate();

        $validatedData['content'] = $this->sanitizeContent($validatedData['content']);
        $validatedData['image'] = $this->handleImageUpload($validatedData['image'] ?? null);

        //        todo: send an email to subscribed student to be notified tho email or notification message
        return (new Story)->create($validatedData + [
            'student_id' => auth()->user()->student->id ?? rand(1, 10),
            'published_at' => $validatedData['status'] !== 'draft' ? now() : null,
        ]);
    }

    protected function sanitizeContent($content): string
    {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.Allowed', 'p,b,i,u,a[href],ul,ol,li');
        $purifier = new HTMLPurifier($config);

        return $purifier->purify($content);
    }

    private function handleImageUpload(?UploadedFile $imageFile): ?string
    {
        if (null) {
            Storage::disk('public')->delete(null);
        }

        return $imageFile?->store('stories', 'public');
    }

    public function updateStory($storyId, $data)
    {
        $story = $this->findStoryById($storyId);

        // Sanitize content
        $data['content'] = $this->sanitizeContent($data['content']);

        // Handle image upload
        if (isset($data['image'])) {
            if ($story->image) {
                Storage::disk('public')->delete($story->image);
            }
            $imagePath = $data['image']->store('stories', 'public');
            $data['image'] = $imagePath;
        }

        $story->update($data + [
            'published_at' => $data['status'] !== 'draft' ? now() : null,
        ]);

        return $story;
    }

    public function findStoryById($storyId)
    {
        return Story::with('student', 'student.user')->findOrFail($storyId);
    }

    public function deleteStory($storyId)
    {
        $story = $this->findStoryById($storyId);
        $story->delete();

        return $story;
    }

    public function getRecommendedStories(): Collection
    {
        return Story::with('student', 'student.user', 'comments', 'replies')
            ->published()
            ->take(3)
            ->get();
    }
}
