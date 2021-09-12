<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ReportPrescriptionRequest extends FormRequest
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
            'type' => 'required|string|max:191',
            'file' => 'required|mimes:png,jpg,jpeg,doc,docx,pdf|max:10000',
            'ref_doctor' => 'nullable|string|max:191',
        ];
    }
}
