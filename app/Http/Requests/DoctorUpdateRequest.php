<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:191',
            'mobile' => 'required|string',
            'nid' => 'nullable|string|max:191',
            'bmdc_reg' => 'nullable|string|max:191',
            'department' => 'nullable|string|max:191',
            'degree' => 'nullable|string|max:191',
            'designation' => 'nullable|string|max:191',
            'specializations' => 'required',
            'address' => 'nullable|string|max:191',
            'district' => 'nullable|string',
            'police_station' => 'nullable|string|max:191',
            'post_office' => 'nullable|string|max:191',
            'password' => 'nullable|string|min:8',
            'image' => 'nullable|image|max:15000',
        ];
    }
}
