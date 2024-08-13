<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketTypeRequest;
use App\Http\Resources\TicketTypeResource;
use App\Models\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketTypeController extends Controller
{
    public function index(Request $request)
    {
        return $this->success(
            'Searching Ticket Types Successful',
            TicketTypeResource::collection(
                TicketType::search($request->input('search'))
                    ->paginate(10)
            ),
        );
    }

    public function store(TicketTypeRequest $request)
    {
        $validated = $request->validated();

        $ticketType = TicketType::create($validated);

        return $this->success(
            'Storing Ticket Type Successful',
            new TicketTypeResource($ticketType)
        );
    }

    public function show(TicketType $ticketType)
    {
        return $this->success(
            'Searching Ticket Type Successful',
            new TicketTypeResource($ticketType)
        );
    }

    public function update(TicketTypeRequest $request, TicketType $ticketType)
    {
        $changes = DB::transaction(function () use ($request, $ticketType) {
            $changes = $this->resourceParser($request, $ticketType);

            return $changes;
        });

        return $this->success(
            $changes ? 'Updating Holiday Successful' : 'No changes made.',
            new TicketTypeResource($ticketType)
        );
    }

    public function destroy(TicketType $ticketType)
    {
        DB::transaction(function () use ($ticketType) {
            $ticketType->save();
            $ticketType->delete();
        });

        return $this->success(
            'Deleting Ticket Type Successful',
            new TicketTypeResource($ticketType)
        );
    }

    public function trashed(Request $request)
    {
        return $this->success(
            'Searching Ticket Type Successful',
            TicketTypeResource::collection(
                TicketType::search($request->input('search'))
                    ->onlyTrashed()->paginate(10)
            )
        );
    }

    public function restore(string $id)
    {
        $ticketType = TicketType::onlyTrashed()->findOrFail($id);

        DB::transaction(function () use ($ticketType) {
            $ticketType->save();
            $ticketType->restore();
        });

        return $this->success(
            'Restoring Ticket Type Successful',
            new TicketTypeResource($ticketType)
        );
    }
}
