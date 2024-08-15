<?php

namespace App\Services;

use App\Models\Ticket;
use App\Models\TicketInfo;
use Illuminate\Support\Facades\DB;

class TicketService
{
    public function store(array $validated): Ticket
    {
        return DB::transaction(function () use ($validated) {
            $validated['status'] ??= 'open';

            $latestTicket = Ticket::latest('id')->first();
            $nextId = $latestTicket ? $latestTicket->id + 1 : 1;
            $ticketNumber = 'TICKET-' . str_pad($nextId, 6, '0', STR_PAD_LEFT);
            $validated['ticket_number'] = $ticketNumber;

            if (isset($validated['ticket_infos']['attachment'])) {
                $filePath = $validated['ticket_infos']['attachment']
                    ->store('public/attachments');
                $validated['ticket_infos']['attachment'] = basename($filePath);
            }

            $ticketInfoData = $validated['ticket_infos'];
            unset($validated['ticket_infos']);

            $ticket = Ticket::create($validated);
            $ticketInfoData['ticket_id'] = $ticket->id;
            TicketInfo::create($ticketInfoData);

            return $ticket->load(
                'ticket_type',
                'ticket_info',
                'category.sub_categories'
            );
        });
    }
}
