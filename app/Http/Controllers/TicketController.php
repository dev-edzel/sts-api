<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Http\Resources\TicketResource;
use App\Jobs\QueueEmailVerification;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $tickets = Ticket::search($search)
            ->query(fn($query) => $query->with([
                'ticket_info',
                'ticket_type'
            ]))->paginate(10);

        return $this->success(
            'Tickets fetched successfully',
            TicketResource::collection($tickets)
        );
    }

    public function store(TicketRequest $request)
    {
        $ticket = app(TicketService::class)
            ->store($request->validated());

        return $this->success(
            'Storing Ticket Successful',
            new TicketResource($ticket),
            201
        );
    }

    public function show(Ticket $ticket)
    {
        $ticket->load(['ticket_info', 'ticket_type']);

        return $this->success(
            'Searching Ticket Successful',
            new TicketResource($ticket)
        );
    }

    public function otp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');

        $otpData = $this->generateOTP();

        $mailData = [
            'otp' => $otpData['otp'],
            'email' => $email,
        ];

        QueueEmailVerification::dispatch($mailData);

        return $this->success('Sending OTP successful.', $otpData['hashed']);
    }
}
