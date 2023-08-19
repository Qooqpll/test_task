<?php

declare(strict_types=1);

namespace App\Http\Requests\Appointment;

use App\DTO\Appointment\StoreDTOInterface;
use App\Models\Specialist;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest implements StoreDTOInterface
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'client_id' => 'required|int',
            'specialist_id' => 'required|int',
            'date' => 'date_format:d/m/Y',
            'time' => 'date_format:H:i',
        ];
    }

    public function getClient(): ?User
    {
        $client = User::query()->where('id', $this->input('client_id'))->first();

        /** @var User $client */
        return $client;
    }

    public function getSpecialist(): ?Specialist
    {
        $specialist = Specialist::query()->where('id', $this->input('specialist_id'))->first();

        /** @var Specialist $specialist */
        return $specialist;
    }

    public function getDate(): ?string
    {
        return $this->input('date');
    }

    public function getTime(): ?string
    {
        return $this->input('time');
    }
}
