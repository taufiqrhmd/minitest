<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Episode;
use App\Models\Story;

/**
 * Class LikeService.
 */
class LikeService
{
    /**
     * Like a story
     */
    public static function likeStory(Story $story): Story
    {
        $like = $story->like();
        $user_id = auth()->id();

        if ($like->count() > 0) {
            $like->detach($user_id);

            $story->load('like')->loadCount('likes');

            return $story;
        }

        $like->attach($user_id);

        $story->load('like')->loadCount('likes');

        return $story;
    }

    /**
     * Like a episode
     */
    public static function likeEpisode(Episode $episode): Episode
    {
        $like = $episode->like();
        $user_id = auth()->id();

        if ($like->count() > 0) {
            $like->detach($user_id);

            $episode->load('like')->loadCount('likes');

            return $episode;
        }

        $like->attach($user_id);

        $episode->load('like')->loadCount('likes');

        return $episode;
    }

    /**
     * Like a comment
     */
    public function likeComment(Comment $comment): Comment
    {
        $like = $comment->like();
        $user_id = auth()->id();

        if ($like->count() > 0) {
            $like->detach($user_id);

            $comment->load('like')->loadCount('likes');

            return $comment;
        }

        $like->attach($user_id);

        $comment->load('like')->loadCount('likes');

        return $comment;
    }
}
