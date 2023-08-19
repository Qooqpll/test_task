<?php

declare(strict_types=1);

namespace App\Http\Resources\Appointment;

use App\Http\Resources\Client\ClientResource;
use App\Http\Resources\Specialist\SpecialistResource;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class AppointmentResource extends JsonResource
{
    /** @var Appointment $resource */
    public $resource;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'client' => ClientResource::make($this->resource->client()->first()),
            'specialist' => SpecialistResource::make($this->resource->specialist()->first()),
            'date' => $this->resource->date,
            'time' => $this->resource->time,
        ];
    }
}
