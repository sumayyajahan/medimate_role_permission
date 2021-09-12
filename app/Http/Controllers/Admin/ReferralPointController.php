<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReferralPoint;
use Illuminate\Http\Request;

class ReferralPointController extends Controller
{
    public function view()
    {
        $referralPoint = ReferralPoint::first();
        return view('admin.referral_point', compact('referralPoint'));
    }

    public function update(Request $request,ReferralPoint $referralPoint)
    {
        $request->validate([
            'user_refer_to' => 'required|integer',
            'user_refer_by' => 'required|integer',
            'doctor_refer_to' => 'required|integer',
            'doctor_refer_by' => 'required|integer',
            'service_refer_to' => 'required|integer',
            'service_refer_by' => 'required|integer',
        ]);

        $referralPoint->update($request->all());
        return back()->with('success','Update Successful.');
    }
}
