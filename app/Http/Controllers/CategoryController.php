<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        return $this->success(
            'Searching Categories Successful',
            CategoryResource::collection(
                Category::search($request->input('search'))
                    ->paginate(10)
            ),
        );
    }

    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();

        $category = Category::create($validated);

        return $this->success(
            'Storing Category Successful',
            new CategoryResource($category)
        );
    }

    public function show(Category $category)
    {
        return $this->success(
            'Searching Category Successful',
            new CategoryResource($category)
        );
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $changes = DB::transaction(function () use ($request, $category) {
            $changes = $this->resourceParser($request, $category);

            return $changes;
        });

        return $this->success(
            $changes ? 'Updating Category Successful' : 'No changes made.',
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
