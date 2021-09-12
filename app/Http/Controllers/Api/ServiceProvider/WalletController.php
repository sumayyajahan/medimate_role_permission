<?php

namespace App\Http\Controllers\Api\ServiceProvider;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserWalletRequest;
use App\Models\BkashRechargeRequest;
use App\Models\Notification;
use App\Models\ServiceProviderComission;
use App\Models\ServiceProviderComissionHistory;
use App\Models\ServiceProviderWallet;
use App\Models\User;
use App\Models\WalletTransactionLog;
use Illuminate\Http\Request;
use Auth;

class WalletController extends Controller
{
    
    /**
     * get the wallet
     *
     * @return Response
     */
    public function wallet()
    {
        $wallet = ServiceProviderWallet::where('service_provider_id', Auth::id())->first();
        return $this->jsonResponse($wallet->balance, "Success.");
    }

    public function recharge(UserWalletRequest $request)
    {
        $serviceProviderWallte = ServiceProviderWallet::where('service_provider_id', Auth::id())->first();
        $comission = ServiceProviderComission::where('service_provider_id', Auth::id())->first();
        $amount = round($request->amount + $request->amount * ($comission->personal_recharge / 100));
        $serviceProviderWallte->balance += $amount;
        $serviceProviderWallte->save();
        WalletTransactionLog::create([
            'trx_id' => rand(1, 9) . 's' . uniqid(),
            'service_provider_id' => Auth::id(),
            'type' => 'Personal Recharge',
            'amount' => $request->amount,
            'deposit' => 1,
            'payment_gateway' => 'serviceProvider',
            'payment_note' => 'serviceProvider'
        ]);

        $comissionHistory = new ServiceProviderComissionHistory();
        $comissionHistory->service_provider_id = Auth::id();
        $comissionHistory->type = 'personal_recharge';
        $comissionHistory->recharge_amount = $request->amount;
        $comissionHistory->comission_amount = round($amount - $request->amount);
        $comissionHistory->comission_percentage = $comission->personal_recharge;
        $comissionHistory->save();

        FileHelper::serviceNotify(Auth::id(), "Cash in request", "Cash in request submitted.");
        return $this->jsonResponse($serviceProviderWallte->balance, "Success - Balance Recharged.");
    }

    /**
     * service provider recharge the patient wallet
     *
     * @param  Request $request
     * @return Response
     */
    public function rechargePatient(UserWalletRequest $request)
    {

        $serviceProviderWallte = ServiceProviderWallet::where('service_provider_id', Auth::id())->first();
        $user = User::where('userid', $request->healthid)->with('wallet')->first();
        $serviceUser = User::where('mobile', Auth::user()->mobile)->first();
        $comission_data = ServiceProviderComission::where('service_provider_id', Auth::id())->first();

        if ($user->parent_id == null) {
            $comission = $comission_data->patient_recharge;
        } else {
            $comission = $comission_data->family_recharge;
        }

        $comissionAmount = round($request->amount * ($comission / 100));

        if ($serviceProviderWallte->balance >= $request->amount) {

            $balance = $serviceProviderWallte->balance - $request->amount;
            $balance = $balance + $comissionAmount;

            $serviceProviderWallte->balance = $balance;
            $serviceProviderWallte->save();
            $user->wallet->balance += $request->amount;
            $user->wallet->save();

            $userNotification = Notification::create(['user_id' => $user->id, 'title' => 'Recharge Successful.', 'body' => $request->amount . ' points recharge to your account.']);

            $serviceProviderNotification = Notification::create(['service_provider_id' => Auth::id(), 'title' => 'Recharge Successful with Cashback.', 'body' => $request->amount . ' points recharged. You get ' . $comissionAmount . ' points cashback.']);

            WalletTransactionLog::create([
                'trx_id' => rand(1, 9) . 's' . uniqid(),
                'service_provider_id' => Auth::id(),
                'type' => 'Patient Recharge',
                'amount' => $request->amount,
                'deposit' => 0,
                'payment_gateway' => 'serviceProvider',
                'payment_note' => 'Patient/ Family Recharge'
            ]);

            WalletTransactionLog::create([
                'trx_id' => rand(1, 9) . 's' . uniqid(),
                'service_provider_id' => Auth::id(),
                'type' => 'Cash Back',
                'amount' => $comissionAmount,
                'deposit' => 1,
                'payment_gateway' => 'serviceProvider',
                'payment_note' => 'Patient/ Family Recharge'
            ]);

            WalletTransactionLog::create([
                'trx_id' => rand(1, 9) . 'sp' . uniqid(),
                'user_id' => $user->id,
                'type' => 'Recharge',
                'amount' => $request->amount,
                'deposit' => 1,
                'payment_gateway' => 'serviceProvider',
                'payment_note' => 'Patient/ Family Recharge'
            ]);

            $comissionHistory = new ServiceProviderComissionHistory();
            $comissionHistory->service_provider_id = Auth::id();
            $comissionHistory->user_id = $user->id;
            $comissionHistory->type = $comission_data->type;
            $comissionHistory->recharge_amount = $request->amount;
            $comissionHistory->comission_amount = $comissionAmount;
            $comissionHistory->comission_percentage = $comission;
            $comissionHistory->save();
            return $this->jsonResponse([$userNotification, $serviceProviderNotification], "Transaction Successful.");
        } else {
            Notification::create(['service_provider_id' => Auth::id(), 'title' => 'Recharge Cancel.', 'body' => 'Insufficient Balance']);
            return $this->jsonResponse(NULL, "Insufficient Balance.");
        }
    }



    /**
     * request for bkash recharge
     *
     * @param  Request $request
     * @return Response
     */
    public function bkash(Request $request)
    {
        $serviceProviderWallte = new BkashRechargeRequest();
        $serviceProviderWallte->service_provider_id = Auth::id();
        $serviceProviderWallte->trx_id = $request->trx_id;
        $serviceProviderWallte->save();

        return $this->jsonRes("Success - Recharge Requested.", 200);
    }


    public function walletLog()
    {
        $log = WalletTransactionLog::where('service_provider_id', Auth::id())->get();
        return $this->jsonRes($log, 200);
    }
}
