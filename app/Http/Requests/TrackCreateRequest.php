<?php

namespace App\Http\Requests;

use App\Enums\ContentType;
use Illuminate\Foundation\Http\FormRequest;

class TrackCreateRequest extends FormRequest
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
            'name' => 'required',
            'content_type' => 'in:base,dlc,mod',
            'link' => 'required_unless:content_type,base',
        ];
    }
}
