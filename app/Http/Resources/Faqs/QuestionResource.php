<?php

namespace App\Http\Resources\Faqs;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $answers = AnswerResource::collection(
            $this->whenLoaded('answers')
        );

        return [
            'id' => $this->id,
            'question' => $this->question,
            'answers' => $answers,
        ];
    }
}
