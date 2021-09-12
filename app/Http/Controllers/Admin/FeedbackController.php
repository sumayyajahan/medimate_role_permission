<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommonSetting;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(){
        $feedbacks = Feedback::all();
        return view('admin.feedbacks', compact('feedbacks'));
    }

    public function common(){
        $faq = CommonSetting::where('docName','faq')->first();
        $tnc = CommonSetting::where('docName','tnc')->first();
        $rp = CommonSetting::where('docName','rp')->first();

        return view('admin.common', compact('faq','tnc','rp'));
    }

    public function commonSave(Request $request){
        $faq = CommonSetting::where('docName', 'faq')->first();
        $tnc = CommonSetting::where('docName', 'tnc')->first();
        $rp = CommonSetting::where('docName', 'rp')->first();

        $faq->details = $request->faq;
        $faq->save();

        $tnc->details = $request->tnc;
        $tnc->save();

        $rp->details = $request->rp;
        $rp->save();

        return Redirect()->route('admin.faq')->with('success', 'Update Successfully saved');
    }

}
