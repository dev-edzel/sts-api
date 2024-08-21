<?php

namespace App\Services;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $user = User::create([
                'username' => $request['username'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);

            $avatar = null;
            if (isset($request['user_info']['avatar'])) {
                $filePath = $request['user_info']['avatar']
                    ->store('public/avatars');
                $avatar = basename($filePath);
            }

            $user->user_info()->create([
                'first_name' => $request['user_info']['first_name'],
                'middle_name' => $request['user_info']['middle_name'],
                'last_name' => $request['user_info']['last_name'],
                'phone_number' => $request['user_info']['phone_number'],
                'avatar' => $avatar,
            ]);

            return new UserResource($user);
        });
    }

    // public function getStatusMetrics()
    // {
    //     TODO
    // }

    // public function getStatusMetrics()
    // {
    //     TODO
    // }
}
