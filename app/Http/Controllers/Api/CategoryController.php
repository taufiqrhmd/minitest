<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\CategoryService;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use HttpResponses;

    private $service;

    public function __construct(CategoryService $categoryService)
    {
        $this->service = $categoryService;
    }

    public function index(Request $request): JsonResponse
    {
        $query = $request->search;

        if ($request->user()->cant('viewAny', Category::class)) {
            return $this->error('Forbidden', 403);
        }

        try {
            $categories = $this->service->findAll($query);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->success($categories, 'These all categories');
    }

    public function show(Category $category): JsonResponse
    {
        if (auth()->user()->cant('viewAny', $category)) {
            return $this->error('Forbidden', 403);
        }

        try {
            $category = $this->service->findById($category);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->success($category, 'This is your category and all the story it has');
    }
}
