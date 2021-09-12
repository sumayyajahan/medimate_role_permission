<?php

namespace App\Http\Controllers\Api\ServiceProvider;

use App\Helpers\CommonHelper;
use App\Helpers\DoctorHelper;
use App\Helpers\FileHelper;
use App\Helpers\ServiceProviderHelper;
use App\Helpers\UploadImage;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorSpecialization;
use App\Models\DoctorVisitCharge;
use App\Models\DoctorWallet;
use App\Models\Pharmacy;
use App\Models\ServiceProvider;
use App\Models\ServiceProviderComission;
use App\Models\ServiceProviderWallet;
use App\Models\Specialization;
use App\Models\User;
use App\Models\UserWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Str;
use Validator;

class OnboardController extends Controller
{
    public $successStatus = 200;
    // User on board - register user from service provider

    public function user_register(Request $request)
    {

        $serviceid = Auth::user()->serviceid;

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'nullable|email|max:191|unique:users',
            'mobile' => 'nullable|string|unique:users',
            'address' => 'required|string|max:191',
            'lat' => 'nullable',
            'lng' => 'nullable',
            'gender' => 'nullable',
            'dob' => 'nullable|date',
            'image' => 'nullable|image',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => Arr::first(Arr::flatten($validator->messages()->get('*')))], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
//        $input['referral_code']
        $input['userid'] = "MMPA" . date('yis') . rand(1, 9);
        $input['service_by'] = $serviceid;

        if($request->hasFile('image')) {
            $file=$request->file('image');
            $input['image'] = UploadImage::image_upload($file);
        }

        $user = User::create($input);

        // send sms to doctor
        $message = 'Your medimate account has been registered as patient. Your default password is 12345678';
        CommonHelper::sendSMSForNotification($user->mobile, $message);

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


    // Doctor register
    public function doctor_register(Request $request)
    {
        $serviceid = Auth::user()->serviceid;

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
            return response()->json(['error' => Arr::first(Arr::flatten($validator->messages()->get('*')))], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['doctorid'] = "MMDR" . date('yis') . rand(1, 9);
        $input['status'] = 0;
        $input['service_by'] = $serviceid;
        $specializations = json_decode($input['specialization']);

        if($request->hasFile('image')) {
            $file=$request->file('image');
            $input['image'] = UploadImage::image_upload($file);
        }

        $doctor = Doctor::create($input);
        $doctor->referral_code = CommonHelper::createReferralCode($request->name);

        // specialization create
        if(!empty($specializations)) {
            $specializationDatabase = '';
            foreach ($specializations as $specialization) {
                $specializationTable = Specialization::findOrFail($specialization);
                DoctorSpecialization::create(['doctor_id' => $doctor->id, 'specialization_id' => $specialization]);
                $specializationDatabase .= $specializationTable->name . ",";
            }
            $doctor->specialization = $specializationDatabase;
        }

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

    // Pharmacy Register

    public function pharmacy_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'nullable|email|max:191|unique:pharmacies',
            'mobile' => 'nullable|string|unique:pharmacies',
            'address' => 'required|string|max:191',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        if ($validator->fails()) {

            return response()->json(['error' => Arr::first(Arr::flatten($validator->messages()->get('*')))], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['pharmaid'] = "MMPH" . date('yis') . rand(1, 9);
        $input['service_by'] = $serviceid = Auth::user()->serviceid;

        if($request->hasFile('image')) {
            $file=$request->file('image');
            $input['image'] = UploadImage::image_upload($file);
        }

        $pharmacy = Pharmacy::create($input);

        // send sms to doctor
        $message = 'Your medimate account has been registered as pharmacy. Your default password is 12345678';
        CommonHelper::sendSMSForNotification($pharmacy->mobile, $message);

        $referralCode = Str::slug($request->name) . "-" . rand(11, 999);
        $pharmacy->referral_code = $referralCode;
        $pharmacy->save();

        $pharmacyData = Pharmacy::findOrFail($pharmacy->id);


        $token =  $pharmacy->createToken('MyApp')->accessToken;
        return response()->json(['data' => $pharmacyData,'token'=>$token], $this->successStatus);
    }

    public function service_provider_register(Request $request)
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
            return response()->json(['error' => Arr::first(Arr::flatten($validator->messages()->get('*')))], 401);
        }
        $input = $request->all();
        $password = bcrypt($input['password']);
        $input['password'] = $password;
        $input['serviceid'] = "MMSP" . date('yis') . rand(1, 9);
        $input['service_by'] =  Auth::user()->serviceid;

        if($request->hasFile('image')) {
            $file=$request->file('image');
            $input['image'] = UploadImage::image_upload($file);
        }

        $service_provider = ServiceProvider::create($input);

        // send sms to doctor
        $message = 'Your medimate account has been registered as service provider. Your default password is 12345678';
        CommonHelper::sendSMSForNotification($service_provider->mobile, $message);

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

}
