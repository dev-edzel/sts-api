<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $categories = Category::search($search)
            ->query(fn($query) => $query->with('sub_categories'))
            ->paginate(10);

        return $this->success(
            'Categories fetched successfully',
            CategoryResource::collection($categories)
        );
    }

    public function store(CategoryRequest $request)
    {
        $category = app(CategoryService::class)
            ->store($request->validated());

        return $this->success(
            'Storing Category Successful',
            new CategoryResource($category)
        );
    }

    public function show(Category $category)
    {
        $category->load('sub_categories');

        return $this->success(
            'Searching Category Successful',
            new CategoryResource($category)
        );
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category = app(CategoryService::class)
            ->update($category, $request->validated());

        return $this->success(
            'Updating Category Successful',
            new CategoryResource($category)
        );
    }

    public function destroy(Category $category)
    {
        DB::transaction(function () use ($category) {
            $category->save();
            $category->delete();
        });

        return $this->success(
            'Deleting Category Successful',
            new CategoryResource($category)
        );
    }

    public function trashed(Request $request)
    {
        return $this->success(
            'Searching Categories Successful',
            CategoryResource::collection(
                Category::search($request->input('search'))
                    ->onlyTrashed()->paginate(10)
            )
        );
    }

    public function restore(string $id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);

        DB::transaction(function () use ($category) {
            $category->save();
            $category->restore();
        });

        return $this->success(
            'Restoring Category Successful',
            new CategoryResource($category)
        );
    }
}
