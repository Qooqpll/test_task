<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\client\UpdateRequest;
use App\Http\Resources\Client\ClientResource;
use App\Http\Resources\Client\ClientResourceCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Knuckles\Scribe\Attributes\BodyParam;

final class ClientController extends Controller
{
    #[BodyParam("per_page", "int", " The per page of the page", example: 10)]
    public function index(Request $request): ClientResourceCollection
    {
        return ClientResourceCollection::make(User::query()->paginate($request->per_page ?: 15));
    }

    public function show(Request $request, User $user): ClientResource
    {
        return ClientResource::make($user);
    }

    public function update(UpdateRequest $request, User $user): ClientResource
    {
        $user->update(
            [
                'name' => $request->name ?: $user->name,
                'phone_number' => $request->phone_number ?: $user->phone_number
            ]
        );

        return ClientResource::make($user);
    }

    public function destroy(User $user): Response
    {
        $user->delete();

        return response()->noContent();
    }
}
