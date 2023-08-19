<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Specialist\StoreRequest;
use App\Http\Requests\specialist\UpdateRequest;
use App\Http\Resources\Specialist\SpecialistResource;
use App\Http\Resources\Specialist\SpecialistResourceCollection;
use App\Models\Specialist;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class SpecialistController extends Controller
{
    public function index(Request $request): SpecialistResourceCollection
    {
        return SpecialistResourceCollection::make(Specialist::query()->paginate($request->per_page ?: 15));
    }

    public function store(StoreRequest $request): SpecialistResource
    {
        $specialist = Specialist::create([
            'name' => $request->name,
            'description_of_services' => $request->description,
            'schedule_data' => json_encode($request->schedule)
        ]);

        return SpecialistResource::make($specialist);
    }

    public function show(Request $request, Specialist $specialist): SpecialistResource
    {
        return SpecialistResource::make($specialist);
    }

    public function update(UpdateRequest $request, Specialist $specialist): SpecialistResource
    {
        $specialist->update(
            [
                'name' => $request->name ?: $specialist->name,
                'description_of_services' => $request->description ?: $specialist->description_of_services,
                'schedule_data' => json_encode($request->schedule) ?: $specialist->schedule_data
            ]
        );

        return SpecialistResource::make($specialist);
    }

    public function destroy(Request $request, Specialist $specialist): Response
    {
        $specialist->delete();

        return response()->noContent();
    }
}
