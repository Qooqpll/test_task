<?php

declare(strict_types=1);

namespace App\Models;

use App\DTO\Appointment\StoreDTOInterface;
use App\DTO\Appointment\UpdateDTOInterface;
use Carbon\Traits\Date;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ramsey\Uuid\Type\Time;

/**
 * @property int $id
 * @property int $client_id
 * @property int $specialist_id
 * @property Date $date
 * @property Time $time
 */
final class Appointment extends Model
{
    use HasFactory;

    public static function store(StoreDTOInterface $dto): self
    {
        $instance = new self();
        $instance->client()->associate($dto->getClient());
        $instance->specialist()->associate($dto->getSpecialist());
        $instance->date = $dto->getDate();
        $instance->time = $dto->getTime();

        $instance->save();

        return $instance;
    }

    public function updateDetails(UpdateDTOInterface $dto): self
    {
        $this->client()->associate($dto->getClient());
        $this->specialist()->associate($dto->getSpecialist());
        $this->date = $dto->getDate();
        $this->time = $dto->getTime();

        $this->save();

        return $this;
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function specialist(): BelongsTo
    {
        return $this->belongsTo(Specialist::class, 'specialist_id', 'id');
    }
}
