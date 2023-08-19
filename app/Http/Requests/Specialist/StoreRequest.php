<?php

declare(strict_types=1);

namespace App\Http\Requests\Specialist;

use Illuminate\Foundation\Http\FormRequest;

final class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'schedule.*' => 'required|array',
            'schedule.day' => 'required|date_equals:30/11/2022',
            'schedule.start' => 'required|date_format:H:i',
            'schedule.end' => 'required|date_format:H:i',
        ];
    }
}
