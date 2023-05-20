<?php

namespace App\Services;

use App\Models\Story;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StoryService
{
    /**
     * Get all stories
     *
     * @param  string  $query
     */
    public static function findAllStories(?string $query): Collection
    {
        $stories = Story::search($query)->query(function ($builder) {
            $builder->with(['category', 'user', 'like'])->withCount(['episodes', 'comments', 'likes', 'visits as views']);
        })->orderBy('created_at', 'desc')->get();

        return $stories;
    }

    /**
     * Get all user's stories
     *
     * @param  string  $query
     */
    public static function findAllUserStories(?string $query): Collection
    {
        $stories = Story::search($query)->query(function ($builder) {
            $builder->with(['category', 'like'])->withCount(['episodes', 'comments', 'likes', 'visits as views']);
        })->where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();

        return $stories;
    }

    /**
     * Get a story by Id
     */
    public static function findStoryById(Story $story): Story
    {
        $story->visit();

        $story->load([
            'category',
            'like',
            'episodes' => function ($query) {
                $query->orderBy('title');
            },
            'comments' => function ($query) {
                $query->with([
                    'user',
                    'like',
                    'replies' => function ($query) {
                        $query->with(['like', 'user'])->withCount(['likes']);
                    },
                ])->withCount(['replies', 'likes']);
            },
        ])->loadCount(['episodes', 'comments', 'likes', 'visits as views']);

        return $story;
    }

    /**
     * Create a user's story
     *
     * @param  UploadedFile  $cover
     */
    public static function addStory(array $request, ?UploadedFile $cover): Story
    {
        if ($cover) {
            $request['cover'] = $cover->store('cover');
        }

        $story = Story::create([
            'title' => $request['title'],
            'synopsis' => $request['synopsis'],
            'cover' => $request['cover'],
            'user_id' => auth()->id(),
            'category_id' => $request['category_id'],
        ]);

        $story->load('category');

        return $story;
    }

    /**
     * Edit a Story
     *
     * @param  UploadedFile  $cover
     */
    public static function changeStory(array $request, ?UploadedFile $cover, Story $story): Story
    {
        if ($cover) {
            if ($story->cover) {
                Storage::move($story->cover, $cover);
            }

            $request['cover'] = $cover->store('cover');
        }

        $story->updateOrFail($request);

        $story->load(['category', 'episodes', 'comments'])->loadCount(['comments', 'likes']);

        return $story;
    }

    /**
     * Delete a story
     */
    public static function deleteStory(Story $story): bool
    {
        Storage::delete($story->cover);

        return $story->deleteOrFail();
    }
}
