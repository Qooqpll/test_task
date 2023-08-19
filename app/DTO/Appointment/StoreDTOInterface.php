<?php

declare(strict_types=1);

namespace App\DTO\Appointment;

use App\Models\Specialist;
use App\Models\User;

interface StoreDTOInterface
{
    public function getClient(): ?User;

    public function getSpecialist(): ?Specialist;

    public function getDate(): ?string;

    public function getTime(): ?string;
}
