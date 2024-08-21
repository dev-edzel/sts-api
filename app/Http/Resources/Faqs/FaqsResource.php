<?php

namespace App\Http\Resources\Faqs;

use App\Http\Resources\SubCategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FaqsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $subCategories = SubCategoryResource::collection(
            $this->whenLoaded('sub_categories')
        );

        return [
            'id' => $this->id,
            'name' => $this->name,
            'sub_categories' => $subCategories,
        ];
    }
}
