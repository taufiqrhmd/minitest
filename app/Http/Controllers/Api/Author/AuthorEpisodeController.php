<?php

namespace App\Http\Controllers\Api\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEpisodeRequest;
use App\Http\Requests\UpdateStoryRequest;
use App\Models\Episode;
use App\Models\Story;
use App\Services\EpisodeService;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorEpisodeController extends Controller
{
    use HttpResponses;

    private $service;

    public function __construct(EpisodeService $episodeService)
    {
        $this->service = $episodeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Story $story): JsonResponse
    {
        if ($request->user()->cant('view', $story)) {
            return $this->error('Forbidden', 403);
        }

        $query = $request->search;

        try {
            $episodes = $this->service->findAllEpisode($query, $story);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }

        return $this->success($episodes, 'These All Your Episodes');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEpisodeRequest $request, Story $story): JsonResponse
    {
        if ($request->user()->cant('create', Episode::class)) {
            return $this->error('Forbidden', 403);
        }

        $validated = $request->validated();

        try {
            $episode = $this->service->addEpisode($validated, $story);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->success($episode, 'A New Episode Created Successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Episode $episode): JsonResponse
    {
        if (Auth::user()->cant('view', $episode)) {
            return $this->error('Forbidden', 403);
        }

        try {
            $result = $this->service->findEpisodeById($episode);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->success($result, 'This is your episode');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoryRequest $request, Episode $episode): JsonResponse
    {
        if ($request->user()->cant('update', $episode)) {
            return $this->error('Forbidden', 403);
        }
        $validated = $request->validated();

        try {
            $episode = $this->service->changeEpisode($validated, $episode);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->success($episode, 'An Episode has been Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Episode $episode): JsonResponse
    {
        if (Auth::user()->cant('delete', $episode)) {
            return $this->error('Forbidden', 403);
        }

        try {
            $this->service->deleteEpisode($episode);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->success([], 'An Episode deleted successfully');
    }
}
