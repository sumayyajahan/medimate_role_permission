<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AppointmentSchedule;
use App\Models\AppointmentSlot;
use App\Models\ContactFeedback;
use App\Models\Gallery;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use App\Helpers\CommonHelper;
use App\Models\DoctorWallet;
// use App\Models\EPrescription;
use Illuminate\Support\Facades\Redirect;

class IndexController extends Controller
{
    public function index()
    {
        // $contact = "8801621092630";
        // $msg = "Demo index";
        // $url = "https://esms.mimsms.com/smsapi?api_key=C20080066040da9a0ab5b3.00415555&type=text&contacts=" . $contact . "&senderid=MediMate&msg=" . $msg . "";
        // return Redirect::to($url);
        // $url = "https://esms.mimsms.com/smsapi";
        // $data = [
        //     "api_key" => "C20080066040da9a0ab5b3.00415555",
        //     "type" => "text",
        //     "contacts" => "8801621092630",
        //     "senderid" => "MediMate",
        //     "msg" => "Test SMS Text"
        // ];
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // curl_setopt(
        //     $ch,
        //     CURLOPT_RETURNTRANSFER,
        //     true
        // );
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // $response = curl_exec($ch);
        // curl_close($ch);
        // return $response;

        return view('frontend.index');
    }

    public function send_sms()
    {
    }


    // public function termsAndConditions()
    // {
    //     return view('frontend.terms_and_conditions');
    // }

    // public function privacyPolicy()
    // {
    //     return view('frontend.privacy_policy');
    // }

    public function about()
    {
        return view('frontend.about');
    }
    public function contact()
    {
        return view('frontend.contact');
    }
    public function galleries()
    {
        $galleries = Gallery::latest();
        return view('frontend.galleries', compact('galleries'));
    }
    public function submitFeedback(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191',
            'phone' => 'nullable|string|max:191',
            'message' => 'nullable|string|max:65500',
            'feedback' => 'nullable|integer'
        ]);
        $feedback = new ContactFeedback();
        $feedback->name = $request->name;
        $feedback->email = $request->email;
        $feedback->phone = $request->phone;
        $feedback->message = $request->message;
        $feedback->feedback = $request->feedback;
        $feedback->save();
        return back()->with('success', 'Thank you for cantacting us. We will contact you soon.');
    }
}
