<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\ReferralHistory;
use App\Models\User;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    /**
     * add a user by Referral
     *
     * @param  Request $request
     * @return Response
     */
    public function addReferral(Request $request)
    {

        $referral_code = $request->referral_code;

        $referred_by_id = User::Select('id')->where('referral_code', $referral_code)->first();

        $rh = ReferralHistory::create(array_merge($request->all(), ['referred_by_id'=> $referred_by_id->id]))->save();


        return $this->jsonResponse($rh,"Refereed");
    }

    public function getReferral($id)
    {
        $rh = ReferralHistory::Where('referred_by_id',$id)->count();
        return $this->jsonResponse($rh, "Total Refereed Count");
    }
}
