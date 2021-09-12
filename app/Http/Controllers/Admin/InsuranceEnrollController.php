<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\BonusPoint;
use App\Models\InsuranceEnroll;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InsuranceEnrollController extends Controller
{
    public function viewRequests(){
        $logs = InsuranceEnroll::where('status',0)->get();

        return view('admin.enroll_request',compact('logs'));
    }

    public function viewProcessing(){
        $logs = InsuranceEnroll::where('status',1)->where('is_approved',0)->get();
        return view('admin.enroll_processing',compact('logs'));
    }

    public function viewApproved(){
        $logs = InsuranceEnroll::where('status',1)->where('is_approved', 1)->get();
        return view('admin.enroll_approved',compact('logs'));
    }

    public function viewDeclined(){
        $logs = InsuranceEnroll::whereIn('status',[2,9])->orWhereIn('is_approved',[2,9])->get();
        return view('admin.enroll_reject',compact('logs'));
    }
// ajax controllers
    public function acceptEnroll($id){
        $log = InsuranceEnroll::find($id);
        $log->status = 1;
        $log->comment = "Accepted by Admin, Waiting for Insurance Provider Approval.ab-c-m";
        FileHelper::userNotify($log->user_id,"Insurance Accept.","Insurance request accepted.");
        $log->save();
    }

    // Confirm insurance
    public function acceptEnrollProvider($id){
        $log = InsuranceEnroll::find($id);
        BonusPoint::send_bonus_point($log->user_id, $log->insurance_package_id, Carbon::today());
        $log->is_approved = 1;
        $log->activation_date = Carbon::today();
        $log->comment = "Accepted by Insurance Provider.";
        $log->save();
    }

    public function rejectEnroll($id){
        $log = InsuranceEnroll::find($id);
        $log->status = 2;
        $log->comment = "Rejected by Admin.";
        $log->save();
    }

    public function rejectEnrollProvider($id){
        $log = InsuranceEnroll::find($id);
        $log->is_approved = 2;
        $log->comment = "Rejected by Insurance Provider.";
        $log->save();
    }

    public function rejectEnrollUser($id){
        $log = InsuranceEnroll::find($id);
        $log->is_approved = 2;
        $log->comment = "Rejected by User from Insurance Provider.";
        $log->save();
    }

    public function get_enroll_details($id)
    {
        $enroll = InsuranceEnroll::find($id);
        return view('admin.healthpack.enroll_details', compact('enroll'));
    }

}
