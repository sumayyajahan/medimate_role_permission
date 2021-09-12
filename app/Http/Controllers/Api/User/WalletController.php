<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserWalletRequest;
use App\Models\BkashRechargeRequest;
use App\Models\UserWallet;
use App\Models\WalletTransactionLog;
use Illuminate\Http\Request;
use Auth;

class WalletController extends Controller
{

    public function wallet()
    {
        $wallet = UserWallet::where('user_id', Auth::id())->first();
        return $this->jsonResponse($wallet->balance, "Success.");
    }

    public function recharge(UserWalletRequest $request)
    {
        $userWallet = UserWallet::where('user_id', Auth::id())->first();
        $userWallet->balance += $request->amount;
        $userWallet->save();

        FileHelper::userNotify(Auth::id(), "Balance Recharge Successful", $request->amount." points added to your account. ");
        return $this->jsonResponse($userWallet->balance, "Success - Balance Recharged.");
    }

    public function bkash(Request $request)
    {
        $userWallet = new BkashRechargeRequest();
        $userWallet->user_id = Auth::id();
        $userWallet->trx_id = $request->trx_id;
        $userWallet->save();
        return $this->jsonRes("Success - Recharge Requested.", 200);
    }


    public function walletLog()
    {
        $log = WalletTransactionLog::where('user_id', Auth::id())->get();
        return $this->jsonRes($log, 200);
    }
}
