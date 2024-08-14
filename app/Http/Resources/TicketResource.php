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
        $ticketInfo = TicketInfoResource::collection(
            $this->whenLoaded('ticket_infos')
        );

        $ticketType = TicketTypeResource::collection(
            $this->whenLoaded('ticket_types')
        );

        return [
            'ticket_number' => $this->ticket_number,
            'reference_no' => $ticketType,
            'ticket_type' => $this->reference_no,
            'ticket_types_id' => $this->ticket_types_id,
            'category_id' => $this->category_id,
            'sub_category_id' => $this->sub_category_id,
            'initiator' => $this->initiator,
            'status' => $this->status,
            'ticket_info' => $ticketInfo
        ];
    }
}
