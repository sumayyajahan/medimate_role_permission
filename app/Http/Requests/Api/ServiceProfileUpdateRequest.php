<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ServiceProfileUpdateRequest extends FormRequest
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
            'name' => 'nullable|string|max:191',
            'mobile' => 'nullable|string|max:191',
            'mobile_2' => 'nullable|string|max:191',
            'dob' => 'nullable',
            'address' => 'nullable|string|max:191',
            'license' => 'nullable|string|max:191',
            'incharge' => 'nullable|string|max:191',
            'district' => 'nullable|string',
            'police_station' => 'nullable|string|max:191',
            'post_office' => 'nullable|string|max:191',
            'image' => 'nullable|image|max:20000',
        ];
    }
}
