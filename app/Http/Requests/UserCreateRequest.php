<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name' => 'required|string|max:36',
            'email' => 'nullable|email|max:191|unique:users',
            'mobile' => 'required|string',
            'dob' => 'required|date|after:1947-01-01',
            'address' => 'required|string|max:191',
            'district' => 'required|string',
            'police_station' => 'required|string|max:191',
            'post_office' => 'required|string|max:191',
            'password' => 'required|string|min:8',
            'image' => 'required|image|max:15000',
        ];
    }
}
