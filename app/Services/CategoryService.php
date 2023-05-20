<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    /**
     * Get All Category with giving a search parameter optionally
     *
     * @param  string  $query
     */
    public static function findAll(?string $query): Collection
    {
        $categories = Category::search($query)->orderBy('name')->get();

        return $categories;
    }

    /**
     * Get one record of category with a stories has related
     *
     * @param  mixed  $category
     */
    public static function findById(Category $category): Category
    {
        $category->load([
            'stories' => function ($query) {
                $query->orderBy('title');
            },
        ]);

        return $category;
    }

    /**
     * Create a new category
     */
    public static function addCategory(array $request): Category
    {
        $category = Category::create($request);

        return $category;
    }

    /**
     * Edit a category
     */
    public static function changeCategory(array $request, Category $category): Category
    {
        $category->updateOrFail($request);

        return $category;
    }

    /**
     * Delete a category
     */
    public static function deleteCategory(Category $category): bool
    {
        return $category->deleteOrFail();
    }
}
