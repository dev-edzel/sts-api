<?php

namespace App\Services;

use App\Jobs\ProcessEmailVerification;
use App\Models\Ticket;
use App\Models\TicketInfo;
use Illuminate\Support\Facades\DB;
use App\Traits\OTPHandler;

class TicketService
{
    use OTPHandler;

    public function store(array $validated): Ticket
    {
        return DB::transaction(function () use ($validated) {
            $validated['status_id'] ??= 1;

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

            $email = $ticketInfoData['email'];
            if ($email) {
                $otpData = $this->generateOTP();
                $hashedOtp = $otpData['hashed'];

                $mailData = [
                    'otp' => $otpData['otp'],
                    'email' => $email,
                    'ref_no' => $hashedOtp['ref_no'],
                    'ticket_number' => $ticketNumber,
                ];

                ProcessEmailVerification::dispatch($mailData);

                $ticket->mail_data = $mailData;
                $ticket->otp_hashed = $hashedOtp;
            }

            return $ticket->load(
                'merchant',
                'ticket_info',
                'category.sub_categories',
                'status'
            );
        });
    }
}
