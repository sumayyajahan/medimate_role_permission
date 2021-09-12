<?php

namespace App\Helpers;

use App\Models\ReferralHistory;
use App\Models\ReferralPoint;
use App\Models\User;
use App\Models\WalletTransactionLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Validator;

class UserHelper
{

    public static function middleware($class){
        $class->middleware('preventBackHistory');
        $class->middleware('auth');
        //middleware for status check
        // $class->middleware('checkStatus');
        //middleware for email verification
    //    $class->middleware('verified');

    }


    /**
     * changePassword
     *
     * @param  Object $request
     * @return int
     */
    public static function changePassword($request)
    {
        $validator = Validator::make($request->all(), [
            'oldpassword' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $user = Auth::user();
        if (Hash::check($request->oldpassword, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            return 1;
        } else {
            return  0;
        }
    }

    /**
     * referralHistory
     *
     * @param  String $referralCode
     * @param  Object $user
     * @return void
     */
    public static function referralHistory($referralCode,$user)
    {
        if ($referralCode) {

            $userReferBy = User::where('referral_code', $referralCode)->with('wallet')->first();

            if ($userReferBy) {
                //create a referral history
                ReferralHistory::create(['user_refer_by' => $userReferBy->id, 'user_id' => $user->id])->save();

                //add points to user and referer
                $referralPoint = ReferralPoint::first();
                $user->wallet->balance += $referralPoint->user_refer_by;
                $user->wallet->save();
                $userReferBy->wallet->balance += $referralPoint->user_refer_to;
                $userReferBy->wallet->save();

                //add to transaction log
                WalletTransactionLog::create(['user_id' => $user->id, 'type' => 'Referral By Bonus', 'amount' => $referralPoint->user_refer_by]);
                WalletTransactionLog::create(['user_id' => $userReferBy->id, 'type' => 'Referral To Bonus', 'amount' => $referralPoint->user_refer_to]);

                //send notifications
                FileHelper::userNotify($user->id, 'Referral Bonus', 'You got ' . $referralPoint->user_refer_by . ' Points as referral bonus.');

                FileHelper::userNotify($userReferBy->id, 'Referral Bonus', $user->name . ' use your referral code for registration. You got ' . $referralPoint->user_refer_to . ' Points as referral bonus.');
            }
        }
    }

}