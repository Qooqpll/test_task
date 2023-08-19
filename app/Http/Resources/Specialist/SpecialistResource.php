<?php

declare(strict_types=1);

namespace App\Http\Resources\Specialist;

use App\Models\Specialist;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class SpecialistResource extends JsonResource
{

    /** @var Specialist $resource */
    public $resource;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'description' => $this->resource->description_of_services,
            'schedule' => json_decode($this->resource->schedule_data),
        ];
    }
}
