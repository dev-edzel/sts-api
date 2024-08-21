<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::search($search)
            ->query(fn($query) => $query->with([
                'user_info'
            ]))->paginate(10);

        return $this->success(
            'Users fetched successfully',
            UserResource::collection($users)
        );
    }

    public function store(UserRequest $request)
    {
        $user = app(UserService::class)
            ->store($request->validated());

        return $this->success(
            'User created successfully',
            new UserResource($user),
            201
        );
    }

    public function update(UserRequest $request, User $user)
    {
        $changes = DB::transaction(function () use ($request, $user) {
            $changes = $this->resourceParser($request, $user);

            return $changes;
        });

        return $this->success(
            $changes ? 'Updating User Successful' : 'No changes made.',
            new UserResource($user)
        );
    }

    public function show(User $user)
    {
        return $this->success(
            'Searching User Successful',
            new UserResource($user)
        );
    }
}
