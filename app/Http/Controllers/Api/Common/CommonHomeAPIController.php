<?php

namespace App\Http\Controllers\API\Common;

use App\Http\Controllers\Controller;
use App\Models\BonusPoint;
use App\Models\Notification;
use App\Models\NotificationForAll;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\Psr7\str;

class CommonHomeAPIController extends Controller
{
    public function get_dashboard($user_type, $user_id)
    {
        {
            $notification = 0;
            $bonus = null;

            if ($user_type == 'user'){
                $notification = Notification::where('user_id', $user_id)->where('status', '=', 'New')->count();
                $bonus_point = BonusPoint::get_balance_point($user_id);
                $bonus = $bonus_point->balance.' ('.$bonus_point->call_left.' Call)';
            }
            else if ($user_type == 'doctor'){
                $notification = Notification::where('doctor_id', $user_id)->where('status', '=', 'New')->count();
            }
            else if ($user_type == 'pharmacy'){
                $notification = Notification::where('pharmacy_id', $user_id)->where('status', '=', 'New')->count();
            }
            else if ($user_type == 'service-provider'){
                $notification = Notification::where('service_provider_id', $user_id)->where('status', '=', 'New')->count();
            }

            $data = array(
                'notifications' => (string)$notification,
                'bonus' => $bonus,

            );
            return $this->jsonRes($data, 200);
        }
    }


    public function get_popup()
    {
        $pop_up = NotificationForAll::where('type', '=', 'app')->latest()->first();

        $data = array(
            'has_notification' => $pop_up != null,
            'can_access_app' => $pop_up != null? $pop_up->can_access_app : true,
            'title' => $pop_up != null? $pop_up->title:null,
            'body' => $pop_up != null? $pop_up->body:null,
            'build_number' => $pop_up != null? $pop_up->build_number : null,
            'apple_build' => $pop_up != null? $pop_up->apple_build : null,
            'has_button' => $pop_up != null? $pop_up->has_button : false,
            'button_text' => $pop_up != null? $pop_up->button_text : null,
            'button_url' => $pop_up != null? $pop_up->button_url : null,
        );
        return $this->jsonRes($data, 200);
    }

}
