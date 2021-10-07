<?php

namespace App\Http\Controllers\Api\Pharmacy;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pharmacy;
use App\Models\Admin;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Validator;
use Str;

class AuthController extends Controller
{
    public $successStatus = 200;

    public function login(Request $request)
    {

        $data = CommonHelper::login($request, "App\Models\Pharmacy");
        return $data;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'nullable|email|max:191|unique:pharmacies',
            'mobile' => 'required|string|unique:pharmacies',
            'address' => 'required|string|max:191',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['pharmaid'] = "MMPH" . date('yis') . rand(1, 9);
        $input['admin_id'] = Admin::create([
            'name'=>$input['name'],
            'email'=>$input['email'],
            'mobile'=>$input['mobile'],
            'password'=>$input['password']
        ])->id;
        $pharmacy = Pharmacy::create($input);

        $referralCode = Str::slug($request->name) . "-" . rand(11, 999);
        $pharmacy->referral_code = $referralCode;
        $pharmacy->save();

        $pharmacyData = Pharmacy::findOrFail($pharmacy->id);


        $token =  $pharmacy->createToken('MyApp')->accessToken;
        return response()->json(['data' => $pharmacyData,'token'=>$token], $this->successStatus);
    }

    public function resetPassword(Request $request)
    {
        $data = CommonHelper::resetPassword($request, "App\Models\Pharmacy");
        return response()->json($data->original['data'], $data->original['message']);
    }
}
