<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $categories = Ticket::search($search)
            ->query(fn($query) => $query->with([
                'ticket_infos',
                'ticket_types'
            ]))->paginate(10);

        return $this->success(
            'Tickets fetched successfully',
            TicketResource::collection($categories)
        );
    }

    public function store(TicketRequest $request)
    {
        //TODO STORING TICKET WITH INFO
    }
}
