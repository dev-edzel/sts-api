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
        $ticketInfo = new TicketInfoResource($this->whenLoaded('ticket_info'));

        return [
            'id' => $this->id,
            'ticket_number' => $this->ticket_number,
            'reference_no' => $this->reference_no,
            'merchant' => $this->merchant,
            'category' => $this->category,
            'sub_category' => $this->sub_category,
            'ticket_info' => $ticketInfo,
            'initiator' => $this->initiator,
            'status' => $this->status,
            'otp_hashed' => $this->when(isset($this->otp_hashed), $this->otp_hashed),
        ];
    }
}
