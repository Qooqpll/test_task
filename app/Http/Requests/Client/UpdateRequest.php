<?php

declare(strict_types=1);

namespace App\Http\Requests\client;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => 'string',
            'phone_number' => 'string',
        ];
    }
}
