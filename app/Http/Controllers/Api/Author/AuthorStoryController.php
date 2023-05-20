<?php

namespace App\Http\Controllers\Api\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStoryRequest;
use App\Http\Requests\UpdateStoryRequest;
use App\Models\Story;
use App\Services\StoryService;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorStoryController extends Controller
{
    use HttpResponses;

    private $service;

    public function __construct(StoryService $storyService)
    {
        $this->service = $storyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        if ($request->user()->cant('viewAny', Story::class)) {
            return $this->error('Forbidden', 403);
        }

        $query = $request->search;

        try {
            $result = $this->service->findAllUserStories($query);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        if ($result == null) {
            $this->success([], 'No Story yet');
        }

        return $this->success($result, 'These all stories');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoryRequest $request): JsonResponse
    {
        if ($request->user()->cant('create', Story::class)) {
            return $this->error('Unauthorize', 403);
        }

        $validated = $request->validated();
        $image = $request->file('image');

        try {
            $result = $this->service->addStory($validated, $image);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }

        return $this->success($result, 'A new story has been added', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Story $story): JsonResponse
    {
        if (Auth::user()->cant('view', $story)) {
            return $this->error('Forbidden', 403);
        }

        try {
            $result = $this->service->findStoryById($story);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }

        return $this->success($result, 'This is the story');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoryRequest $request, Story $story): JsonResponse
    {
        if ($request->user()->cant('update', $story)) {
            return $this->error('Forbidden', 403);
        }

        $validated = $request->validated();
        $image = $request->file('image');

        try {
            $result = $this->service->changeStory($validated, $image, $story);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->success($result, 'This is yout updated story');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Story $story): JsonResponse
    {
        if (Auth::user()->cant('delete', $story)) {
            return $this->error('Forbidden', 403);
        }

        try {
            $this->service->deleteStory($story);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->success([], 'Story was deleted successfully');
    }
}
