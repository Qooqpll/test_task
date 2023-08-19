<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Appointment\StoreRequest;
use App\Http\Requests\Appointment\UpdateRequest;
use App\Http\Resources\Appointment\AppointmentResource;
use App\Http\Resources\Appointment\AppointmentResourceCollection;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Knuckles\Scribe\Attributes\BodyParam;

final class AppointmentController extends Controller
{

    #[BodyParam("per_page", "int", " The per page of the page", example: 10)]
    public function index(Request $request): AppointmentResourceCollection
    {
        return AppointmentResourceCollection::make(
            Appointment::query()
                ->where('client_id', $request->user()->id)
                ->paginate($request->per_page ?: 15)
        );
    }

    public function store(StoreRequest $request): AppointmentResource
    {
        $appointment = Appointment::store($request);

        return AppointmentResource::make($appointment);
    }

    public function show(Request $request, Appointment $appointment): AppointmentResource
    {
        return AppointmentResource::make($appointment);
    }

    public function update(UpdateRequest $request, Appointment $appointment): AppointmentResource
    {
        $appointment->updateDetails($request);

        return AppointmentResource::make($appointment);
    }

    public function destroy(Request $request, Appointment $appointment): Response
    {
        $appointment->delete();

        return response()->noContent();
    }
}
