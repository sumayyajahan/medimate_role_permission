<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\CommonHelper;
use App\Helpers\FileHelper;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\ReferralHistory;
use App\Models\ReferralPoint;
use App\Models\UserWallet;
use App\Models\WalletTransactionLog;
use Illuminate\Support\Facades\Auth;
use Validator;
use Str;

class AuthController extends Controller
{
    public $successStatus = 200;

    public static function login(Request $request)
    {
        $model = "App\Models\User";
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $mobileOrId = $request->input('mobile');
        $password = $request->input('password');

        if ($model::orWhere('mobile', $mobileOrId)->orWhere('userid', $mobileOrId)->count() <= 0) return response(array("message" => "User not exist"), 400);

        $doctor = $model::orWhere('mobile', $mobileOrId)->orWhere('userid', $mobileOrId)->first();

        if (password_verify($password, $doctor->password)) {

            return response(array("message" => "Sign In Successful", "data" => [
                "user" => $doctor,

                // Below the customer key passed as the second parameter sets the role
                // anyone with the auth token would have only customer access rights
                "token" => $doctor->createToken('Personal Access Token', ['doctor'])->accessToken
            ]), 200);
        } else {
            return response(array("message" => "Sorry, we do not recognize the password you have entered. Please try again. If you have forgotten your password, click on the 'Forgot password?' link in the login screen."), 400);
        }
    }
    public function register(Request $request)
    {
        // return "lksfj";
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'nullable|email|max:191|unique:users',
            'mobile' => 'required|string|unique:users',
            'address' => 'required|string|max:191',
            'lat' => 'nullable',
            'lng' => 'nullable',
            'gender' => 'nullable',
            'dob' => 'nullable|date',
            'image' => 'nullable|image',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'email.unique' => 'An account with the email address you have entered is already registered. Please enter another email address.',
            'mobile.unique' => 'An account with the mobile number you have entered is already registered. If you have forgotten your password, click on the \'Forgot password?\' link in the login screen.',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['userid'] = "MMPA" . date('yis') . rand(1, 9);
        $user = User::create($input);

        $imageName = FileHelper::uploadImage($request, $user);
        $user->update(['image' => $imageName]);
        $user->update(['view_password' => $request->password]);

        // Referral Create
        $user->referral_code =  CommonHelper::createReferralCode($request->name);
        $user->save();
        // Wallet Create
        $userWallet = UserWallet::create(['user_id' => $user->id]);

        // Referral
        UserHelper::referralHistory($request->referral_code, $user);

        $userData = User::findOrFail($user->id);
        $token =  $user->createToken('MyApp')->accessToken;
        return response()->json(['data' => $userData, 'token' => $token],  $this->successStatus);
    }

    public function update(Request $request)
    {

        $user = User::findOrFail(Auth::id());
        $user->update($request->all());

        return $this->jsonResponse($user, "Successfully updated user");
    }

    // public function updatePassword(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'password' => 'required|string|min:8|confirmed',
    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()], 401);
    //     }
    //     $user = User::findOrFail(Auth::id());
    //     $input = $request->all();
    //     $input['password'] = bcrypt($input['password']);
    //     if (bcrypt($request->old_password) == $user->password) {
    //         $user->password = $input['password'];
    //         $user->view_password = $request->password;
    //         $user->save();
    //     } else {
    //         return response()->json("Password Not Matched",401);
    //     }

    //     FileHelper::userNotify($user->id,"Password Changed.","Your password has been changed successfully.");
    //     return $this->jsonResponse($user, "Successfully updated user");
    // }

    public function resetPassword(Request $request)
    {
        $data = CommonHelper::resetPassword($request, "App\Models\User");

        return response()->json($data->original['data'], $data->original['message']);
    }
}
