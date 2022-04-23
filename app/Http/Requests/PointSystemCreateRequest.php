<?php

namespace App\Http\Requests;

use App\Rules\PositionsAreUnique;
use App\Rules\PositionsProvided;
use Illuminate\Foundation\Http\FormRequest;

class PointSystemCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'positions' => ['bail', 'array', 'required', new PositionsProvided, new PositionsAreUnique],
        ];
    }
}
