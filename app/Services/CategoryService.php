<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    public function store(array $validated): Category
    {
        return DB::transaction(function () use ($validated) {
            $category = Category::create($validated);

            if (isset($validated['sub_categories'])) {
                $category->sub_categories()
                    ->createMany($validated['sub_categories']);
            }

            return $category->load('sub_categories');
        });
    }

    public function update(Category $category, array $validated): Category
    {
        return DB::transaction(function () use ($category, $validated) {
            $category->update($validated);

            if (isset($validated['sub_categories'])) {
                $category->sub_categories()->delete();
                $category->sub_categories()
                    ->createMany($validated['sub_categories']);
            }

            return $category->load('sub_categories');
        });
    }
}
