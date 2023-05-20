<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Services\StoryService;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    use HttpResponses;

    private $service;

    public function __construct(StoryService $storyService)
    {
        $this->service = $storyService;
    }

    public function index(Request $request): JsonResponse
    {
        if ($request->user()->cant('viewAny', Story::class)) {
            return $this->error('Forbidden', 403);
        }

        $query = $request->search;

        try {
            $stories = $this->service->findAllStories($query);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->success($stories, 'There All Your Stories');
    }

    public function show(Story $story): JsonResponse
    {
        if (auth()->user()->cant('viewAny', $story)) {
            return $this->error('Forbidden', 403);
        }

        try {
            $result = $this->service->findStoryById($story);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->success($result, 'This is your Story');
    }
}
