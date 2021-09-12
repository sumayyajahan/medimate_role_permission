<?php

namespace App\Helpers;

use App\Models\ReferralHistory;
use App\Models\ReferralPoint;
use App\Models\Doctor;
use App\Models\WalletTransactionLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Validator;

class DoctorHelper
{
    
    /**
     * Create referralHistory
     *
     * @param  String $referralCode
     * @param  Object $doctor
     * @return void
     */
    public static function referralHistory($referralCode,$doctor)
    {
        if ($referralCode) {

            $doctorReferBy = Doctor::where('referral_code', $referralCode)->with('wallet')->first();

            if ($doctorReferBy) {
                //create a referral history
                ReferralHistory::create(['doctor_refer_by' => $doctorReferBy->id, 'doctor_id' => $doctor->id])->save();

                //add points to doctor and referer
                $referralPoint = ReferralPoint::first();
                $doctor->wallet->balance += $referralPoint->doctor_refer_by;
                $doctor->wallet->save();
                $doctorReferBy->wallet->balance += $referralPoint->doctor_refer_to;
                $doctorReferBy->wallet->save();

                //add to transaction log
                WalletTransactionLog::create(['doctor_id' => $doctor->id, 'type' => 'Referral By Bonus', 'amount' => $referralPoint->doctor_refer_by]);
                WalletTransactionLog::create(['doctor_id' => $doctorReferBy->id, 'type' => 'Referral To Bonus', 'amount' => $referralPoint->doctor_refer_to]);

                //send notifications
                FileHelper::doctorNotify($doctor->id, 'Referral Bonus', 'You got ' . $referralPoint->doctor_refer_by . ' Points as referral bonus.');

                FileHelper::doctorNotify($doctorReferBy->id, 'Referral Bonus', $doctor->name . ' use your referral code for registration. You got ' . $referralPoint->doctor_refer_to . ' Points as referral bonus.');
            }
        }
    }

}