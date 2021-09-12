<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Controller;
use App\Notifications\MedimateRegistrationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        $request->validate([
            'to' => 'required|email',
            'subject' => 'required|string',
            'body' => 'required|string'
        ]);
        Notification::route('mail', $request->to)->notify(new MedimateRegistrationNotification($request->subject,$request->body));

        return $this->jsonResponse(NULL,'Mail Send Successful.');
    }
}
