<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserWalletRequest;
use App\Models\BkashRechargeRequest;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserWallet;
use App\Models\WalletTransactionLog;
use Auth;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
class UserWalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userWallets = UserWallet::orderBy('user_id')->with('user')->get();
        return view('admin.user_wallets', compact('userWallets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('name')->get();
        return view('admin.user_wallet_create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserWalletRequest $request)
    {

        $userWallet = UserWallet::where('user_id',$request->user_id)->first();
        $userWallet->balance += floatval($request->amount);
        $userWallet->save();

        $walletLog = new WalletTransactionLog;

        $walletLog->trx_id = uniqid() . rand(111, 999);
        $walletLog->user_id = $request->user_id;
        $walletLog->type = "Point Recharge";
        $walletLog->amount = $request->amount;
        $walletLog->deposit = 1;
        $walletLog->payment_gateway = $request->payment_gateway;
        $walletLog->payment_note = $request->payment_note;

        $walletLog->save();

        $body = $request->amount . " Points Added to your Account. Trx ID - " . $walletLog->trx_id;
        FileHelper::userNotify($request->user_id, "Balance Recharge Successful",$body);

        return back()->with('status', 'TRX ID - '. $walletLog->trx_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(UserWallet $userWallet)
    {
        return view('admin.user_wallet_show', compact('userWallet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(UserWallet $userWallet)
    {

        $users = User::orderBy('name')->get();
        return view('admin.user_wallet_edit', compact('userWallet','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserWallet $userWallet)
    {
        $userWallet->balance = $request->balance;
        $userWallet->save();
        return back()->with('success', 'Update Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserWallet $userWallet)
    {
        $userWallet->delete();
        return back()->with('success', 'Successfully Deleted.');
    }


    public function userWalletLog()
    {
        $logs = WalletTransactionLog::Where('user_id','!=',NULL)->with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.user-wallet-history', compact('logs'));
    }


    public function bkashRequest(){
        $requests = BkashRechargeRequest::where('is_recharged',0)->whereNotNull('user_id')->with('user')->get();
        return view('admin.wallet-bkash-recharge', compact('requests'));
    }

    public function bkashRecharge(Request $request){
        $userWallet = UserWallet::where('user_id', $request->user_id)->first();
        $userWallet->balance += floatval($request->amount);
        $userWallet->save();

        $walletLog = new WalletTransactionLog;

        $walletLog->trx_id = uniqid() . rand(111, 999);
        $walletLog->user_id = $request->user_id;
        $walletLog->type = "Point Recharge";
        $walletLog->amount = $request->amount;
        $walletLog->deposit = 1;
        $walletLog->payment_gateway = $request->payment_gateway;
        $walletLog->payment_note = "bKash TRX ID - ".$request->payment_note;

        $walletLog->save();


        $br = BkashRechargeRequest::where('trx_id', $request->payment_note)->first();
        $br->is_recharged = 1;
        $br->save();

        $notify = new Notification();
        $notify->user_id = $request->user_id;
        $notify->title =  "Balance Recharge Successful";
        $notify->body = $request->amount." Points Added to your Account. Trx ID - ". $walletLog->trx_id;
        $notify->save();

    }

}
