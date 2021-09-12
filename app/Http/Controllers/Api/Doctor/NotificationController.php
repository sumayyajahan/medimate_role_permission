<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function addNotification(Request $request)
    {

    }

    public function getNotification()
    {
        $notifications = Notification::where('doctor_id', Auth::id())->orWhere('type', 'doctor')->orWhere('type', 'all')->latest()->get();
        foreach ($notifications as $notification) {
            $notification->status = '';
            $notification->save();
        }
        return $this->jsonRes($notifications, 200);
    }

    public function deleteNotification($id)
    {
        $notifications = Notification::where('doctor_id', Auth::id())->where('id', $id)->first();
        $notifications->delete();
        return $this->jsonRes("Delete Successful", 200);
    }
}
