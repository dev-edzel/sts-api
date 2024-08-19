<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

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
}
