<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\Auth\PersonalAccessTokenStoreRequest;
use App\Http\Resources\PersonalAccessTokenResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class PersonalAccessTokenController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $tokens = $request->user()->tokens;

        return PersonalAccessTokenResource::collection($tokens);
    }

    public function store(PersonalAccessTokenStoreRequest $request): array
    {
        $user = User::firstWhere('email', $request->email);

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return ['token' => $user->createToken($request->device_name)];
    }

    public function destroy(Request $request, PersonalAccessToken $token): Response
    {
        abort_unless($request->user()->is($token->tokenable), Response::HTTP_FORBIDDEN);

        $token->delete();

        return response()->noContent();
    }
}
