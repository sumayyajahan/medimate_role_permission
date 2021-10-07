<?php

namespace App\Http\Controllers\Api\ServiceProvider;

use App\Helpers\CommonHelper;
use App\Helpers\ServiceProviderHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use App\Models\Doctor;
use App\Models\ServiceProviderComission;
use App\Models\ServiceProviderWallet;
use App\Models\User;
use App\Models\Admin;
use App\Models\UserWallet;
use Illuminate\Support\Facades\Auth;
use Validator;
use Str;

class AuthController extends Controller
{
    public $successStatus = 200;

    public function login(Request $request)
    {

        $data = CommonHelper::login($request, "App\Models\ServiceProvider");
        return $data;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'nullable|email|max:191|unique:service_providers',
            'mobile' => 'required|string|unique:service_providers',
            'address' => 'nullable|string|max:191',
            'password' => 'required|string|min:8|confirmed',

        ], [
            'email.unique' => 'An account with the email address you have entered is already registered. Please enter another email address.',
            'mobile.unique' => 'An account with the mobile number you have entered is already registered. If you have forgotten your password, click on the \'Forgot password?\' link in the login screen.',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $password = bcrypt($input['password']);
        $input['password'] = $password;
        $input['serviceid'] = "MMSP" . date('yis') . rand(1, 9);
        $input['admin_id'] = Admin::create([
            'name'=>$input['name'],
            'email'=>$input['email'],
            'mobile'=>$input['mobile'],
            'password'=>$input['password']
        ])->id;
        $service_provider = ServiceProvider::create($input);
        $service_provider->referral_code = CommonHelper::createReferralCode($request->name);
        $service_provider->save();
        ServiceProviderWallet::create(['service_provider_id' => $service_provider->id]);
        ServiceProviderComission::create(['service_provider_id' => $service_provider->id]);

        $user = User::where('mobile', $request->mobile)->first();
        // Create User account in User account not exist
        if (!$user) {
            $input['userid'] = "MM" . date('ymdHis') . rand(10, 99);
            $input['password'] = $password;
            $user =  User::create($input);
            $user->view_password = $request->password;
            $user->referral_code = CommonHelper::createReferralCode($request->name);
            $user->save();
            // Wallet Create
            UserWallet::create(['user_id' => $user->id]);
        }

        $service_providerData = ServiceProvider::findOrFail($service_provider->id);



        // Referral
        ServiceProviderHelper::referralHistory($request->referral_code, $service_provider);


        $token =  $service_provider->createToken('MyApp')->accessToken;
        return response()->json(['data' => $service_providerData, 'token' => $token], $this->successStatus);
    }

    public function resetPassword(Request $request)
    {
        $data = CommonHelper::resetPassword($request, "App\Models\ServiceProvider");
        return response()->json($data->original['data'], $data->original['message']);
    }
}
