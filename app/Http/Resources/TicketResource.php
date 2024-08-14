<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $category = new CategoryResource($this->whenLoaded('category'));

        return [
            'id' => $this->id,
            'ticket_number' => $this->ticket_number,
            'reference_no' => $this->reference_no,
            'ticket_type' => $this->ticket_type,
            'category' => $category,
            'ticket_info' => $this->ticket_info,
            'initiator' => $this->initiator,
            'status' => $this->status,
        ];
    }
}
