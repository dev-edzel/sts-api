<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoryRequest;
use App\Http\Resources\SubCategoryResource;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    public function index(Request $request)
    {
        return $this->success(
            'Searching Sub Categories Successful',
            SubCategoryResource::collection(
                SubCategory::search($request->input('search'))
                    ->paginate(10)
            ),
        );
    }

    public function store(SubCategoryRequest $request)
    {
        $validated = $request->validated();

        $subCategory = SubCategory::create($validated);

        return $this->success(
            'Storing Sub Category Successful',
            new SubCategoryResource($subCategory)
        );
    }

    public function show(SubCategory $subCategory)
    {
        return $this->success(
            'Searching Sub Category Successful',
            new SubCategoryResource($subCategory)
        );
    }

    public function update(SubCategoryRequest $request, SubCategory $subCategory)
    {
        $changes = DB::transaction(function () use ($request, $subCategory) {
            $changes = $this->resourceParser($request, $subCategory);

            return $changes;
        });

        return $this->success(
            $changes ? 'Updating Sub Category Successful' : 'No changes made.',
            new SubCategoryResource($subCategory)
        );
    }

    public function destroy(SubCategory $subCategory)
    {
        DB::transaction(function () use ($subCategory) {
            $subCategory->save();
            $subCategory->delete();
        });

        return $this->success(
            'Deleting Sub Category Successful',
            new SubCategoryResource($subCategory)
        );
    }

    public function trashed(Request $request)
    {
        return $this->success(
            'Searching Sub Categories Successful',
            SubCategoryResource::collection(
                SubCategory::search($request->input('search'))
                    ->onlyTrashed()->paginate(10)
            )
        );
    }

    public function restore(string $id)
    {
        $subCategory = SubCategory::onlyTrashed()->findOrFail($id);

        DB::transaction(function () use ($subCategory) {
            $subCategory->save();
            $subCategory->restore();
        });

        return $this->success(
            'Restoring Sub Category Successful',
            new SubCategoryResource($subCategory)
        );
    }
}
