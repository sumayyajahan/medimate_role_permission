<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PharmacySalesmanCreateRequest extends FormRequest
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
            'email' => 'required|email|max:191|unique:pharmacy_salesmen',
            'mobile' => 'required|string|unique:pharmacy_salesmen',
            'password' => 'required|string|min:8',
            'image' => 'nullable|image|max:15000',
        ];
    }
}
