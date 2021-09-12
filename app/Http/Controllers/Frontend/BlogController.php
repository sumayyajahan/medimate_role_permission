<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactFeedback;
use App\Models\Gallery;
use App\Models\Pharmacy;
use Illuminate\Http\Request;

class BlogController extends Controller
{    
    public function index()
    {
        $pharmacy = new Pharmacy;
        return view('frontend.index');
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
        return view('frontend.galleries',compact('galleries'));
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
