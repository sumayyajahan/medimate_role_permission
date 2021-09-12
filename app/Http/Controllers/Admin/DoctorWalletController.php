<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorWalletRequest;
use App\Models\Cashout;
use App\Models\Doctor;
use App\Models\DoctorWallet;
use App\Models\WalletTransactionLog;
use Auth;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;

class DoctorWalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctorWallets = DoctorWallet::orderBy('doctor_id')->with('doctor')->get();
        return view('admin.doctor_wallets', compact('doctorWallets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = Doctor::orderBy('name')->get();
        return view('admin.doctor_wallet_create', compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoctorWalletRequest $request)
    {

        $doctorWallet = DoctorWallet::where('doctor_id', $request->doctor_id)->first();
        $doctorWallet->balance -= floatval($request->amount);
        $doctorWallet->save();

        $walletLog = new WalletTransactionLog;

        $walletLog->trx_id = rand(1, 9) . uniqid();
        $walletLog->doctor_id = $request->doctor_id;
        $walletLog->type = "Cash Out";
        $walletLog->amount = $request->amount;
        $walletLog->deposit = 0;
        $walletLog->payment_gateway = $request->payment_gateway;
        $walletLog->payment_note = $request->payment_note;

        $walletLog->save();

        FileHelper::doctorNotify($request->doctor_id, "Cashout", "Cashout request done.");

        return back()->with('status', 'TRX ID - ' . $walletLog->trx_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DoctorWallet $doctorWallet)
    {
        return view('admin.doctor_wallet_show', compact('doctorWallet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DoctorWallet $doctorWallet)
    {

        $doctors = Doctor::orderBy('name')->get();
        return view('admin.doctor_wallet_edit', compact('doctorWallet', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DoctorWallet $doctorWallet)
    {
        $doctorWallet->balance = $request->balance;
        $doctorWallet->save();
        return back()->with('success', 'Update Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DoctorWallet $doctorWallet)
    {
        $doctorWallet->delete();
        return back()->with('success', 'Successfully Deleted.');
    }


    public function doctorWalletLog()
    {
        $logs = WalletTransactionLog::Where('doctor_id', '!=', NULL)->with('doctor')->with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.doctor-wallet-history', compact('logs'));
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

        $doctorWallet = DoctorWallet::where('doctor_id', $co->doctor_id)->first();
        $doctorWallet->balance -= $co->amount;
        $doctorWallet->save();

        $walletLog = new WalletTransactionLog;
        $walletLog->trx_id = uniqid() . rand(111, 999);
        $walletLog->doctor_id = $co->doctor_id;
        $walletLog->type = "Point Cashout";
        $walletLog->amount = $co->amount;
        $walletLog->deposit = 1;
        $walletLog->payment_note = "Doctor point cashout.";
        $walletLog->save();

        FileHelper::doctorNotify($co->doctor_id, "Cashout Successful.", "Your request for ".$co->amount." points withdraw has been successful.");
    }
}
