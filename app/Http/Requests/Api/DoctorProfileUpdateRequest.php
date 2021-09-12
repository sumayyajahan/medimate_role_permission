<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class DoctorProfileUpdateRequest extends FormRequest
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
            'mobile' => 'required|string|min:14|max:14',
            'nid' => 'required|string|max:191',
            'bmdc_reg' => 'required|string|max:191',
            'department' => 'required|string|max:191',
            'degree' => 'required|string|max:191',
            'designation' => 'required|string|max:191',
            'specializations' => 'required',
            'dob' => 'required',
            'address' => 'required|string|max:191',
            'district' => 'required|string',
            'police_station' => 'required|string|max:191',
            'post_office' => 'required|string|max:191',
            'password' => 'nullable|string|min:8',
            'image' => 'nullable|image|max:15000',
        ];
    }
}
