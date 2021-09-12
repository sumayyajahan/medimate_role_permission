<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\LoginActivity;
use App\Models\ReferralHistory;
use App\Models\UserOrder;
use App\Models\WalletTransactionLog;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function userActivity(){
       $users =  LoginActivity::with('user')->where('type','patient')->get();
       $doctors =  LoginActivity::with('doctor')->where('type','doctor')->get();

       return view('admin.user-activity',compact('users','doctors'));
    }

    public function rechargeHistory(){
        $logs = WalletTransactionLog::with('user')->where('user_id','!=',NULL)->where('type', 'Point Recharge')->where('deposit',1)->get();

       return view('admin.recharge-history',compact('logs'));
    }

    public function referralHistory($type){

        $referralHistories = NULL;

        if($type == "user"){
            $referralHistories = ReferralHistory::whereNotNull('user_id')->with('user','userRefer')->latest()->get();
        }elseif($type == "doctor"){
            $referralHistories = ReferralHistory::whereNotNull('doctor_id')->with('doctor','doctorRefer')->latest()->get();
        }elseif($type == "service-provider"){
            $referralHistories = ReferralHistory::whereNotNull('service_provider_id')->with('serviceProvider', 'serviceProviderRefer')->latest()->get();
        }else{
            abort(404);
        }

        // return $referralHistories;
       return view('admin.referral-history',compact('referralHistories','type'));
    }

    public function salesReport(){

         $logs = UserOrder::with('user')->with('pharmacy')->where('is_complete',1)->get();

       return view('admin.sales',compact('logs'));
    }

    public function frequentDoctor(){

        $logs = Doctor::withCount('appointmentScheduleOld')->withCount('appointmentScheduleUp')->withCount('appointmentScheduleCanceled')->get();
        // return $logs;

       return view('admin.most-freq-doc',compact('logs'));
    }

    public function latestOrders(){

        $logs = UserOrder::with('user')->with('pharmacy')->with('state')->orderBy('created_at')->get();

       return view('admin.latest-orders',compact('logs'));
    }

    public function commission()
    {
        $total=0;
        $logs = WalletTransactionLog::where('deposit',2)->with('appointmentSchedule')->orderBy('created_at', 'desc')->get();
        foreach ($logs as $key => $value) {
            $total += $value->amount;
        }
        return view('admin.medimate-wallet-history', compact('logs', 'total'));
    }
}
