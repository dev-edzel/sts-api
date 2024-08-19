<?php

namespace App\Http\Controllers;

use App\Http\Resources\StatusResource;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index(Request $request)
    {
        return $this->success(
            'Searching Statuses Successful',
            StatusResource::collection(
                Status::search($request->input('search'))
                    ->paginate(10)
            ),
        );
    }

    public function show(Status $status)
    {
        return $this->success(
            'Searching Status Successful',
            new StatusResource($status)
        );
    }
}
