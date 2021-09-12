<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorCreateRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email|max:191|unique:doctors',
            'mobile' => 'required|string',
            'dob' => 'required|date',
            'nid' => 'required',
            'bmdc_reg' => 'required|string|max:20',
            'department' => 'required|string|max:191',
            'degree' => 'required|string|max:191',
            'designation' => 'required|string|max:191',
            'specializations' => 'required',
            'address' => 'required|string|max:191',
            'district' => 'required|string',
            'police_station' => 'required|string|max:191',
            'post_office' => 'required|string|max:191',
            'password' => 'required|string|min:8',
            'image' => 'required|image|max:15000',
        ];
    }
}
