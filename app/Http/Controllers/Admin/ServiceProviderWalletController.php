<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceProviderWalletRequest;
use App\Models\BkashRechargeRequest;
use App\Models\Cashout;
use App\Models\ServiceProvider;
use App\Models\Notification;
use App\Models\ServiceProviderComission;
use App\Models\ServiceProviderComissionHistory;
use App\Models\ServiceProviderWallet;
use App\Models\UserWallet;
use App\Models\WalletTransactionLog;
use Auth;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;

class ServiceProviderWalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceProviderWallets = ServiceProviderWallet::orderBy('service_provider_id')->with('serviceProvider')->get();
        return view('admin.service_provider_wallets', compact('serviceProviderWallets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $serviceProviders = ServiceProvider::orderBy('name')->get();
        return view('admin.service_provider_wallet_create', compact('serviceProviders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceProviderWalletRequest $request)
    {


        $serviceProviderWallet = ServiceProviderWallet::where('service_provider_id', $request->service_provider_id)->first();
        $serviceProviderComission = ServiceProviderComission::where('service_provider_id', $request->service_provider_id)->first();
        $amount = $request->amount + ($request->amount * $serviceProviderComission->personal_recharge/100);
        $serviceProviderWallet->balance += intval($amount);
        $serviceProviderWallet->save();

        $walletLog = new WalletTransactionLog;

        $walletLog->trx_id = rand(1, 9) . uniqid();
        $walletLog->service_provider_id = $request->service_provider_id;
        $walletLog->type = "Service Provider Recharge";
        $walletLog->amount =$amount;
        $walletLog->deposit = 0;
        $walletLog->payment_gateway = $request->payment_gateway;
        $walletLog->payment_note = $request->payment_note;

        $walletLog->save();

        $body =$amount . " Points Added to your Account. Trx ID - " . $walletLog->trx_id;
        FileHelper::serviceNotify($request->service_provider_id, "Balance Recharge Successful.", $body);

        $serviceProviderComissionHistory = new ServiceProviderComissionHistory();
        $serviceProviderComissionHistory->service_provider_id = $request->service_provider_id;
        $serviceProviderComissionHistory->type = "Admin Recharge";
        $serviceProviderComissionHistory->recharge_amount = $request->amount;
        $serviceProviderComissionHistory->comission_amount = intval($request->amount * $serviceProviderComission->personal_recharge / 100);
        $serviceProviderComissionHistory->comission_percentage = $serviceProviderComission->personal_recharge;
        $serviceProviderComissionHistory->save();
        return back()->with('status', 'TRX ID - ' . $walletLog->trx_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceProvider $serviceProviderWallet)
    {
        return view('admin.service_provider_wallet_show', compact('doctorWallet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $serviceProviderWallet = ServiceProviderWallet::findOrfail($id);
        $serviceProviders = ServiceProvider::orderBy('name')->get();
        return view('admin.service_provider_wallet_edit', compact('serviceProviderWallet', 'serviceProviders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $serviceProviderWallet = ServiceProviderWallet::findOrfail($id);
        $serviceProviderWallet->balance = $request->amount;
        $serviceProviderWallet->save();
        return back()->with('success', 'Update Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceProvider $serviceProviderWallet)
    {
        $serviceProviderWallet->delete();
        return back()->with('success', 'Successfully Deleted.');
    }

    
    /**
     * get the service provider logs
     *
     * @return Response
     */
    public function serviceProviderWalletLog()
    {
        $logs = WalletTransactionLog::Where('service_provider_id', '!=', NULL)->with('serviceProvider')->orderBy('created_at', 'desc')->get();
        return view('admin.service-provider-wallet-history', compact('logs'));
    }
    public function serviceProviderRechargeLog()
    {
        $logs = WalletTransactionLog::Where('service_provider_id', '!=', NULL)->whereNotNull('user_id')->with('serviceProvider', 'user')->orderBy('created_at', 'desc')->get();
        return view('admin.service-provider-recharge-history', compact('logs'));
    }
    public function serviceProviderComissionLog()
    {
        $logs = ServiceProviderComissionHistory::with('serviceProvider', 'user')->orderBy('created_at', 'desc')->get();
        return view('admin.service-provider-comission-history', compact('logs'));
    }

    public function cashout()
    {
        $logs = Cashout::with('doctor.wallet')->where('status', 0)->get();
        return view('admin.cashoutreq', compact('logs'));
    }

    public function cashoutDone($id)
    {
        $co = Cashout::find($id);
        $co->status = 1;
        $co->save();
    }

    public function bkashRequest()
    {
        $requests = BkashRechargeRequest::where('is_recharged', 0)->whereNotNull('service_provider_id')->with('serviceProvider')->get();
        return view('admin.service-provider-wallet-bkash-recharge', compact('requests'));
    }

    public function bkashRecharge(Request $request)
    {
       
        $serviceProviderWallet = ServiceProviderWallet::where('service_provider_id', $request->service_provider_id)->first();
        $serviceProviderComission = ServiceProviderComission::where('service_provider_id', $request->service_provider_id)->first();
        $amount = $request->amount + ($request->amount * $serviceProviderComission->personal_recharge / 100);
        $serviceProviderWallet->balance += intval($amount);
        $serviceProviderWallet->save();

        $walletLog = new WalletTransactionLog;
        $walletLog->trx_id = uniqid() . rand(111, 999);
        $walletLog->service_provider_id = $request->service_provider_id;
        $walletLog->type = "Point Recharge";
        $walletLog->amount = $amount;
        $walletLog->deposit = 1;
        $walletLog->payment_gateway = $request->payment_gateway;
        $walletLog->payment_note = "bKash TRX ID - " . $request->payment_note;
        $walletLog->save();

        $br = BkashRechargeRequest::where('trx_id', $request->payment_note)->first();
        $br->is_recharged = 1;
        $br->save();

        $notify = new Notification();
        $notify->service_provider_id = $request->service_provider_id;
        $notify->title =  "Balance Recharge Successful";
        $notify->body = $amount . " Points Added to your Account. Trx ID - " . $walletLog->trx_id;
        $notify->save();

        $serviceProviderComissionHistory = new ServiceProviderComissionHistory();
        $serviceProviderComissionHistory->service_provider_id = $request->service_provider_id;
        $serviceProviderComissionHistory->type = "Bkash Recharge";
        $serviceProviderComissionHistory->recharge_amount = $request->amount;
        $serviceProviderComissionHistory->comission_amount = intval($request->amount * $serviceProviderComission->personal_recharge / 100);
        $serviceProviderComissionHistory->comission_percentage = $serviceProviderComission->personal_recharge;
        $serviceProviderComissionHistory->save();

        
    }
}
