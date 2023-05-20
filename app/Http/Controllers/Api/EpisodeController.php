<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Story;
use App\Services\EpisodeService;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EpisodeController extends Controller
{
    use HttpResponses;

    private $service;

    public function __construct(EpisodeService $episodeService)
    {
        $this->service = $episodeService;
    }

    public function index(Request $request, Story $story): JsonResponse
    {
        if ($request->user()->cant('viewAny', $story)) {
            return $this->error('Forbidden', 403);
        }

        $query = $request->search;

        try {
            $episodes = $this->service->findAllEpisode($query, $story);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->success($episodes, 'These all your episodes');
    }

    public function show(Episode $episode): JsonResponse
    {
        if (Auth::user()->cant('viewAny', $episode)) {
            return $this->error('Forbidden', 403);
        }

        try {
            $result = $this->service->findEpisodeById($episode);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->success($result, 'This is your episode');
    }
}
