<?php

namespace App\Helpers;

use Validator;
use Str;

use Illuminate\Support\Facades\Redirect;

class CommonHelper
{
        
    /**
     * resetPassword
     *
     * @param  mixed $request
     * @param  mixed $model
     * @return json data
     */
    public static function resetPassword($request, $model)
    {
        $request->validate([
            'mobile' => 'required|string|max:191'
        ]);
        $user = $model::where('mobile', $request->mobile)->first();
        if ($model == 'App\Models\User') {
            $user = $model::orWhere('mobile', $request->mobile)->orWhere('userid', $request->mobile)->first();
        }
        if ($user) {
            $user->password = bcrypt(12345678);
            $user->save();
            if ($model == 'App\Models\User') {
                $user->view_password = '12345678';
                $user->save();
            }
            //send notification according to model
            if ($model == "App\Models\User") {
                FileHelper::userNotify($user->id, 'Password Reset', "Your password has changed to 12345678");
            } elseif ($model == "App\Models\Doctor") {
                FileHelper::doctorNotify($user->id, 'Password Reset', "Your password has changed to 12345678");
            } elseif ($model == "App\Models\ServiceProvider") {
                FileHelper::serviceNotify($user->id, 'Password Reset', "Your password has changed to 12345678");
            }

            return response()->json(['data' => 'Your password has changed to `12345678`.', 'message' => '200']);
        } else {
            return response()->json(['data' => 'User not found.', 'message' => '401']);
        }
    }
    
    /**
     * login
     *
     * @param  mixed $request
     * @param  mixed $model
     * @return json
     */
    public static function login($request, $model)
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

        if ($model::where('mobile', $mobile)->count() <= 0) return response(array("message" => "Number does not exist"), 400);

        $doctor = $model::where('mobile', $mobile)->first();

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

    public static function loginActivity($id, $type)
    {
    }
    
    /**
     * sendSMS
     *
     * @param  mixed $contact
     * @param  mixed $msg
     * @return void
     */
    public static function sendSMS($contact, $msg)
    {
        $url = "https://esms.mimsms.com/smsapi?api_key=C20080066040da9a0ab5b3.00415555&type=text&contacts=" . $contact . "&senderid=MediMate&msg=" . $msg . "";
        return Redirect::to($url);
    }
    
    /**
     * sendSMSForNotification
     *
     * @param  mixed $contacts
     * @param  mixed $msg
     * @return void
     */
    public static function sendSMSForNotification($contacts, $msg = null)
    {
        $url = "https://esms.mimsms.com/smsapi";
        $data = [
            "api_key" => "C20080066040da9a0ab5b3.00415555",
            "type" => "text",
            "contacts" => $contacts,
            "senderid" => "MediMate",
            "msg" => $msg ?? "You have an appointment in 20 minutes."
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt(
            $ch,
            CURLOPT_RETURNTRANSFER,
            true
        );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    
    /**
     * createReferralCode
     *
     * @param  mixed $name
     * @return String
     */
    public static function createReferralCode($name)
    {

        $name = explode(' ', trim($name));
        return end($name) . "-" . rand(100000, 999999);
    }
}
