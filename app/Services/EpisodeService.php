<?php

namespace App\Services;

use App\Models\Episode;
use App\Models\Story;
use Illuminate\Database\Eloquent\Collection;

class EpisodeService
{
    /**
     * Get all episodes from a story
     *
     * @param  string  $query
     */
    public static function findAllEpisode(?string $query, Story $story): Collection
    {
        $episodes = Episode::search($query)->query(function ($builder) {
            $builder->with(['story', 'like'])->withCount(['comments', 'likes', 'visits as views']);
        })->where('story_id', $story->id)->orderBy('title')->get();

        return $episodes;
    }

    /**
     * Get a episode
     */
    public static function findEpisodeById(Episode $episode): Episode
    {
        $episode->visit();

        $episode->load([
            'like',
            'comments' => function ($query) {
                $query->with([
                    'replies' => function ($query) {
                        $query->with('like', 'user')->withCount('likes');
                    }, 'like', 'user',
                ])->withCount(['replies', 'likes']);
            },
        ])->loadCount(['comments', 'likes', 'visits as views']);

        return $episode;
    }

    /**
     * Create an Episode from a story
     */
    public static function addEpisode(array $request, Story $story): Episode
    {
        $episode = Episode::create([
            'title' => $request['title'],
            'body' => $request['body'],
            'story_id' => $story->id,
        ]);

        return $episode;
    }

    /**
     * Edit a episode
     */
    public static function changeEpisode(array $request, Episode $episode): Episode
    {
        $episode->updateOrFail($request);

        $episode->load(['comments.replies', 'likes'])->loadCount(['comments', 'likes']);

        return $episode;
    }

    /**
     * Delete a episode
     */
    public static function deleteEpisode(Episode $episode): bool
    {
        return $episode->deleteOrFail();
    }
}
