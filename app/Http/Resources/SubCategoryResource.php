<?php

namespace App\Http\Resources;

use App\Http\Resources\Faqs\QuestionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $questions = QuestionResource::collection(
            $this->whenLoaded('questions')
        );

        return [
            'id' => $this->id,
            'name' => $this->name,
            'category_id' => $this->category_id,
            'questions' => $questions,
        ];
    }
}
