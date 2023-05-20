<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Episode;
use App\Models\Story;
use App\Services\CommentService;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    use HttpResponses;

    private $service;

    public function __construct(CommentService $commentService)
    {
        $this->service = $commentService;
    }

    public function story(StoreCommentRequest $request, Story $story): JsonResponse
    {
        if (auth()->user()->cant('create', $story)) {
            return $this->error('Forbidden', 403);
        }

        $validated = $request->validated();

        try {
            $comment = $this->service->addStoryComment($validated, $story);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->success($comment, 'Comment Story success', 201);
    }

    public function episode(StoreCommentRequest $request, Episode $episode): JsonResponse
    {
        if (auth()->user()->cant('create', $episode)) {
            return $this->error('Forbidden', 403);
        }

        $validated = $request->validated();

        try {
            $comment = $this->service->addEpisodeComment($validated, $episode);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->success($comment, 'Comment Episode Success', 201);
    }

    public function reply(StoreCommentRequest $request, Comment $comment): JsonResponse
    {
        if (auth()->user()->cant('create', $comment)) {
            return $this->error('Forbidden', 403);
        }

        $validated = $request->validated();

        try {
            $comment = $this->service->addReplyComment($validated, $comment);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->success($comment, 'Reply Success', 201);
    }

    public function update(UpdateCommentRequest $request, Comment $comment): JsonResponse
    {
        if (auth()->user()->cant('update', $comment)) {
            return $this->error('Forbidden', 403);
        }

        $validated = $request->validated();

        try {
            $comment = $this->service->changeComment($validated, $comment);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->success($comment, 'Comment updated successfully');
    }

    public function destroy(Comment $comment): JsonResponse
    {
        if (auth()->user()->cant('delete', $comment)) {
            return $this->error('Forbidden', 403);
        }

        try {
            $this->service->deleteComment($comment);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->success([], 'Comment deleted successfully');
    }
}
