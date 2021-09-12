<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class EPrescriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'appointment_schedule_id' => 'required',
            'cc' => 'nullable|string|max:65530',
            'oe' => 'nullable|string|max:65530',
            'advice' => 'nullable|string|max:65530',
            'rx' => 'nullable|string|max:65530',
        ];
    }
}
