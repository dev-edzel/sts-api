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
        $ticketInfo = new TicketInfoResource($this->whenLoaded('ticket_info'));

        return [
            'id' => $this->id,
            'ticket_number' => $this->ticket_number,
            'reference_no' => $this->reference_no,
            'ticket_type' => $this->ticket_type,
            'category' => $category,
            'ticket_info' => $ticketInfo,
            'initiator' => $this->initiator,
            'status' => $this->status,
        ];
    }
}
