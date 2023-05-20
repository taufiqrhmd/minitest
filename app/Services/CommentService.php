<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Episode;
use App\Models\Story;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CommentService.
 */
class CommentService
{
    /**
     * Create a comment to story
     */
    public static function addStoryComment(array $request, Story $story): Model
    {
        $comment = $story->comments()->create([
            'body' => $request['body'],
            'user_id' => auth()->user()->id,
        ]);

        return $comment;
    }

    /**
     * Create a comment to episode
     */
    public static function addEpisodeComment(array $request, Episode $episode): Model
    {
        $comment = $episode->comments()->create([
            'body' => $request['body'],
            'user_id' => auth()->user()->id,
        ]);

        return $comment;
    }

    /**
     * Create a reply to a comment
     */
    public static function addReplyComment(array $request, Comment $comment): Model
    {
        $reply = $comment->replies()->create([
            'body' => $request['body'],
            'user_id' => auth()->user()->id,
        ]);

        return $reply;
    }

    /**
     * Edit a comment
     */
    public static function changeComment(array $request, Comment $comment): Comment
    {
        $comment->updateOrFail($request);

        return $comment;
    }

    /**
     * Delete a comment
     */
    public static function deleteComment(Comment $comment): bool
    {
        if ($comment->replies()->delete()) {
            return $comment->deleteOrFail();
        }

        return $comment->deleteOrFail();
    }
}
