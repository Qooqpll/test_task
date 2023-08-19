<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Client\ClientResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Knuckles\Scribe\Attributes\BodyParam;
use Knuckles\Scribe\Attributes\QueryParam;

final class AuthController extends Controller
{
    #[QueryParam("name", "string", " The name of the user", example: 'test')]
    #[QueryParam("password", "string", " The password of the user", example: 123)]
    public function login(Request $request): JsonResponse
    {
           $credentials = $request->only('name', 'password');

           if (auth()->attempt($credentials)) {
               $user = $request->user();
               $token = $user->createToken('API Token')->plainTextToken;

               return response()->json(['token' => $token]);
           }

           return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function register(RegisterRequest $request): ClientResource
    {
        $user = User::create([
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'phone_number' => $request->phone_number
        ]);

        return ClientResource::make($user);
    }
}
