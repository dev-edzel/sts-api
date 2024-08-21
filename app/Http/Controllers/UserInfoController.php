<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserInfoRequest;
use App\Http\Resources\UserInfoResource;
use App\Models\UserInfo;
use Illuminate\Support\Facades\DB;

class UserInfoController extends Controller
{
    public function update(UserInfoRequest $request, UserInfo $userInfo)
    {
        $changes = DB::transaction(function () use ($request, $userInfo) {
            $changes = $this->resourceParser($request, $userInfo);

            return $changes;
        });

        return $this->success(
            $changes ? 'Updating User Info Successful' : 'No changes made.',
            new UserInfoResource($userInfo)
        );
    }
}
