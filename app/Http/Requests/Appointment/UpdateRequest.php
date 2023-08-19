<?php

declare(strict_types=1);

namespace App\Http\Requests\Appointment;

use App\DTO\Appointment\UpdateDTOInterface;

final class UpdateRequest extends StoreRequest implements UpdateDTOInterface
{
}
