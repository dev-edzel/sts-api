<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubCategoryResource;
use App\Models\SubCategory;
use Illuminate\Http\Request;

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

    public function show(SubCategory $subCategory)
    {
        return $this->success(
            'Searching Sub Category Successful',
            new SubCategoryResource($subCategory)
        );
    }
}
