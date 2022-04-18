<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LapTimeSubmitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lap_time' => ['required', 'regex:/\d{1,2}:\d{2}\.\d{3}/'],
            'video_url' => ['required', 'active_url'],
        ];
    }
}
