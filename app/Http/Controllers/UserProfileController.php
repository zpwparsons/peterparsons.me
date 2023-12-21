<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show(Request $request): UserResource
    {
        $user = $request->user();

        return UserResource::make($user);
    }
}
