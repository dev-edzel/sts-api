<?php

namespace App\Http\Controllers;

use App\Http\Resources\Faqs\FaqsResource;
use App\Models\Category;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $categories = Category::search($search)
            ->query(fn($query) => $query->with([
                'sub_categories.questions.answers'
            ]))->paginate(10);

        return $this->success(
            'FAQs retrieved successfully',
            FaqsResource::collection($categories)
        );
    }
}
