<?php

namespace App\Http\Controllers;

use App\Http\Requests\OtpRequest;
use App\Http\Requests\TicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $tickets = Ticket::search($search)
            ->query(fn($query) => $query->with([
                'ticket_info',
                'merchant'
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
        $ticket->load(['ticket_info', 'merchant']);

        return $this->success(
            'Searching Ticket Successful',
            new TicketResource($ticket)
        );
    }
    public function verifyOtp(OtpRequest $request)
    {
        $validated = $request->validated();

        $this->checkOTP(
            $validated['otp'],
            $validated['hashed']['otp'],
            $validated['hashed']['t']
        );

        $ticket = Ticket::where('ticket_number', $validated['ticket_number'])
            ->with(['ticket_info', 'merchant', 'category.sub_categories'])
            ->firstOrFail();

        return $this->success(
            'Verified Successfully.',
            new TicketResource($ticket)
        );
    }

    public function checkStatus(Request $request)
    {
        $validated = $request->validate([
            'ticket_number' => ['required', 'string']
        ]);

        $ticket = Ticket::where(
            'ticket_number',
            $validated['ticket_number']
        )->first();

        if (!$ticket) {
            return $this->error(
                'Invalid Ticket Number',
            );
        }

        $ticketStatus = [
            'status' => $ticket->status
        ];

        return $this->success(
            'Ticket status fetched successfully.',
            $ticketStatus
        );
    }

    public function metricsForStatus()
    {
        $metrics = DB::table('statuses')
            ->leftJoin('tickets', 'statuses.id', '=', 'tickets.status_id')
            ->select(
                'statuses.name as status',
                DB::raw('count(tickets.id) as total_tickets')
            )
            ->groupBy('statuses.name')
            ->get();

        return $this->success(
            'Ticket Status Metrics fetched successfully.',
            $metrics
        );
    }

    public function metricsForMerchant()
    {
        $metrics = DB::table('merchants')
            ->leftJoin('tickets', 'merchants.id', '=', 'tickets.merchant_id')
            ->select(
                'merchants.name as merchant',
                DB::raw('count(tickets.id) as total_tickets')
            )
            ->groupBy('merchants.name')
            ->get();

        return $this->success(
            'Ticket Merchant Metrics fetched successfully.',
            $metrics
        );
    }
}
