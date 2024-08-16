<?php

namespace App\Http\Controllers;

use App\Http\Resources\FaqsResource;
use App\Models\Faqs;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $faqs = Faqs::search($search)
            ->query(fn($query) => $query->with([
                'category',
            ]))->paginate(10);

        return $this->success(
            'Faqs fetched successfully',
            FaqsResource::collection($faqs)
        );
    }

    public function show(Faqs $faq)
    {
        return $this->success(
            'Searching Faq Successful',
            new FaqsResource($faq)
        );
    }
}
