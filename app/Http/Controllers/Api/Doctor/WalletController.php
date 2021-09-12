<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DoctorWalletRequest;
use App\Models\Cashout;
use App\Models\DoctorWallet;
use App\Models\WalletTransactionLog;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class WalletController extends Controller
{

    public function wallet()
    {
        $wallet = DoctorWallet::where('doctor_id', Auth::id())->first();
        return $this->jsonResponse($wallet->balance, "Success.");
    }
    public function recharge(DoctorWalletRequest $request)
    {
        $doctorWallet = DoctorWallet::where('doctor_id', Auth::id())->first();
        $doctorWallet->balance += $request->amount;
        $doctorWallet->save();
        return $this->jsonResponse($doctorWallet, "Success - Balance Recharged.");
    }

    public function cashout(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|string',
        ]);
        $cashout = Cashout::create(array_merge($request->all(), ['doctor_id' => Auth::id()]));
        FileHelper::doctorNotify(Auth::id(), "Cashout Request.", "You have requested for " . $request->amount . " point cashout.");
        return $this->jsonResponse($cashout, "Success - Cashout Requested");
    }



    public function walletLog()
    {
        $log = WalletTransactionLog::where('doctor_id', Auth::id())->orderBy('id', 'DESC')->get();
        return $this->jsonRes($log, 200);
    }
}
