<?php

declare(strict_types=1);

namespace App\Http\Resources\Specialist;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

final class SpecialistResourceCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
