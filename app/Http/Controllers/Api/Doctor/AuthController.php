<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Helpers\CommonHelper;
use App\Helpers\DoctorHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\DoctorVisitCharge;
use App\Models\DoctorWallet;
use Illuminate\Support\Facades\Auth;
use Validator;
use Str;

class AuthController extends Controller
{
    public $successStatus = 200;

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $mobile = $request->input('mobile');
        $password = $request->input('password');

        if (Doctor::where('mobile', $mobile)->where('status', 0)->count() > 0) return response(array("message" => "We are reviewing your account. You'll get an SMS for update"), 401);

        elseif (Doctor::where('mobile', $mobile)->count() <= 0) return response(array("message" => "Number does not exist"), 400);

        $doctor = Doctor::where('mobile', $mobile)->first();

        if (password_verify($password, $doctor->password)) {
            return response(array("message" => "Sign In Successful", "data" => [
                "user" => $doctor,

                // Below the customer key passed as the second parameter sets the role
                // anyone with the auth token would have only customer access rights
                "token" => $doctor->createToken('Personal Access Token', ['doctor'])->accessToken
            ]), 200);
        } else {
            return response(array("message" => "Sorry, we do not recognize the password you have entered. Please try again"), 400);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'nullable|email|max:191|unique:doctors',
            'mobile' => 'required|string|unique:doctors',
            'bmdc_reg' => 'required|string|max:191',
            'password' => 'required|string|min:8|confirmed',
        ],[
            'email.unique' => 'An account with the email address you have entered is already registered. Please enter another email address.',
            'mobile.unique' => 'An account with the mobile number you have entered is already registered. If you have forgotten your password, click on the \'Forgot password?\' link in the login screen.',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['doctorid'] = "MMDR" . date('yis') . rand(1, 9);
        $input['status'] = 0;
        $doctor = Doctor::create($input);
        $doctor->referral_code = CommonHelper::createReferralCode($request->name);
        $doctor->save();
        $doctorData = Doctor::findOrFail($doctor->id);

        // send sms to doctor
        $message = 'Thank you for registering with MediMate. You will be receiving a confirmation after your account is activated.';
        CommonHelper::sendSMSForNotification($doctorData->mobile, $message);

        // Wallet Create
        DoctorWallet::create(['doctor_id' => $doctor->id]);
        DoctorVisitCharge::create(['doctor_id' => $doctor->id]);

        // Referral
        DoctorHelper::referralHistory($request->referral_code, $doctor);

        $token =  $doctor->createToken('MyApp')->accessToken;
        return response()->json(['data' => $doctorData, 'token' => $token], $this->successStatus);
    }

    public function resetPassword(Request $request)
    {
        $data = CommonHelper::resetPassword($request, "App\Models\Doctor");
        return response()->json($data->original['data'], $data->original['message']);
    }
}
