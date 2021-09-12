<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsurancePackageRequest extends FormRequest
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
            'insurance_id' => 'required',
            'admin_id' => 'nullable',
            'name' => 'required|string|max:191',
            'amount' => 'required',
            'duration' => 'required',
        ];
    }
}
