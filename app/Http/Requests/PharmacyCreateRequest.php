<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PharmacyCreateRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:191|unique:pharmacies',
            'mobile' => 'required|string|unique:pharmacies',

            'license' => 'nullable|string|max:191',
            'incharge' => 'required|string|max:191',
            'mobile_2' => 'nullable|string|max:191',

            'address' => 'required|string|max:191',
            'district' => 'required|string',
            'police_station' => 'required|string|max:191',
            'post_office' => 'required|string|max:191',
            'password' => 'required|string|min:8',
            'image' => 'nullable|image|max:15000',
        ];
    }
}
