<?php

namespace App\Services;

use App\Models\Story;
use HTMLPurifier;
use HTMLPurifier_Config;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use LaravelIdea\Helper\App\Models\_IH_Story_C;

class StoryService
{
    public function getAllStories($paginate = 10): \Illuminate\Contracts\Pagination\LengthAwarePaginator|LengthAwarePaginator|array|_IH_Story_C
    {
        return Story::with('student', 'student.user')
            ->published()
            ->orderBy('published_at', 'desc')
            ->paginate($paginate);
    }

    public function createStory($data)
    {
        $validatedData = validator($data, [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'in:draft,published',
<<<<<<< HEAD
            'image' => 'nullable|image|max:2048',
=======
            'image' => 'nullable|max:2048'
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
        ])->validate();

        $validatedData['content'] = $this->sanitizeContent($validatedData['content']);
        $validatedData['image'] = $this->handleImageUpload($validatedData['image'] ?? null);

        //        todo: send an email to subscribed student to be notified tho email or notification message
        return Story::create($validatedData + [
<<<<<<< HEAD
            'student_id' => auth()->user()->student->id,
            'published_at' => $validatedData['status'] !== 'draft' ? now() : null,
        ]);

=======
                'student_id' => auth()->user()->student->id ?? rand(1, 10),
                'published_at' => $validatedData['status'] !== 'draft' ? now() : null,
            ]);
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
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

    public function getRecommendedStories(): array|_IH_Story_C|Collection
    {
        return Story::with('student', 'student.user', 'comments', 'replies')->published()
            ->take(3)
            ->get()
            ->sortByDesc('published_at');
    }
}
