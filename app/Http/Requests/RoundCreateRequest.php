<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoundCreateRequest extends FormRequest
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
            'name' => ['required'],
            'tla' => ['required', 'string', 'max:3'],
            'track_variation_id' => ['required', 'exists:track_variations,id'],
            'car_id' => ['required', 'exists:cars,id'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date'],
        ];
    }
}
