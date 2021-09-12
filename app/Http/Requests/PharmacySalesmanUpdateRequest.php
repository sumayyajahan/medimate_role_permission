<?php

namespace App\Http\Requests;

use App\Models\PharmacySalesman;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class PharmacySalesmanUpdateRequest extends FormRequest
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
        // $id = app('request')->segment(3);
        // dd($id);
        return [
            'name' => 'required|string|max:191',
            'email' => "required|email|unique:pharmacy_salesmen,email,".app('request')->segment(3),
            'mobile' => "required|string|unique:pharmacy_salesmen,mobile,".app('request')->segment(3),
            'password' => 'nullable|string|min:8',
            'image' => 'nullable|image|max:15000',
        ];
    }
}
