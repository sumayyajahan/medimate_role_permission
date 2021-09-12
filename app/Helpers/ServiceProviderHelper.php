<?php

namespace App\Helpers;

use App\Models\ReferralHistory;
use App\Models\ReferralPoint;
use App\Models\ServiceProvider;
use App\Models\WalletTransactionLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Validator;

class ServiceProviderHelper
{

    /**
     * referralHistory
     *
     * @param  String $referralCode
     * @param  Object $serviceProvider
     * @return void
     */
    public static function referralHistory($referralCode, $serviceProvider)
    {
        if ($referralCode) {

            $serviceProviderReferBy = ServiceProvider::where('referral_code', $referralCode)->with('wallet')->first();

            if ($serviceProviderReferBy) {
                //create a referral history
                ReferralHistory::create(['service_provider_refer_by' => $serviceProviderReferBy->id, 'service_provider_id' => $serviceProvider->id])->save();

                //add points to doctor and referer
                $referralPoint = ReferralPoint::first();
                $serviceProvider->wallet->balance += $referralPoint->service_refer_by;
                $serviceProvider->wallet->save();
                $serviceProviderReferBy->wallet->balance += $referralPoint->service_refer_to;
                $serviceProviderReferBy->wallet->save();

                //add to transaction log
                WalletTransactionLog::create(['service_provider_id' => $serviceProvider->id, 'type' => 'Referral By Bonus', 'amount' => $referralPoint->service_refer_by]);

                WalletTransactionLog::create(['service_provider_id' => $serviceProviderReferBy->id, 'type' => 'Referral To Bonus', 'amount' => $referralPoint->service_refer_to]);

                //send notifications
                FileHelper::serviceNotify($serviceProvider->id, 'Referral Bonus', 'You got ' . $referralPoint->service_refer_by . ' Points as referral bonus.');

                FileHelper::serviceNotify($serviceProviderReferBy->id, 'Referral Bonus', $serviceProvider->name . ' use your referral code for registration. You got ' . $referralPoint->service_refer_to . ' Points as referral bonus.');
            }
        }
    }
}
