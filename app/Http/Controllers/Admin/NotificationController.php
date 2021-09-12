<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Notification;
use App\Models\NotificationForAll;
use App\Models\Pharmacy;
use App\Models\ServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        $notifications = Notification::with('user')->with('doctor')->with('pharmacy')->get();
        $notificationsAll = NotificationForAll::all();
        return view('admin.view-notifications',compact('notifications', 'notificationsAll'));
    }


    public function create(){

        return view('admin.notify');
    }

    public function destroy(NotificationForAll $notificationForAll){

        $notificationForAll->delete();
        
        return Redirect()->route('admin.view-notifications')->with('success','Delete Successful');
    }

    
    /**
     * send notification to user by group, individual or all type
     *
     * @param  Request $request
     * @return Response
     */
    public function send(Request $request){
        if($request->group == 'su'){
            $notify = new Notification();
            $notify->user_id = $request->receiver;
            $notify->title = $request->title;
            $notify->body = $request->body;
            $notify->save();
        }
        if($request->group == 'sd'){
            $notify = new Notification();
            $notify->doctor_id = $request->receiver;
            $notify->title = $request->title;
            $notify->body = $request->body;
            $notify->save();
        }
        if($request->group == 'sp'){
            $notify = new Notification();
            $notify->pharmacy_id = $request->receiver;
            $notify->title = $request->title;
            $notify->body = $request->body;
            $notify->save();
        }
        if($request->group == 'ssp'){
            $notify = new Notification();
            $notify->service_provider_id = $request->receiver;
            $notify->title = $request->title;
            $notify->body = $request->body;
            $notify->save();
        }
        if($request->group == 'gu'){
            foreach ($request->receiver as $receiver) {
                $notify = new Notification();
                $notify->user_id = $receiver;
                $notify->title = $request->title;
                $notify->body = $request->body;
                $notify->save();
            }
        }
        if($request->group == 'gd'){
            foreach ($request->receiver as $receiver) {
                $notify = new Notification();
                $notify->doctor_id = $receiver;
                $notify->title = $request->title;
                $notify->body = $request->body;
                $notify->save();
            }
        }
        if($request->group == 'gsp'){
            foreach ($request->receiver as $receiver) {
                $notify = new Notification();
                $notify->service_provider_id = $receiver;
                $notify->title = $request->title;
                $notify->body = $request->body;
                $notify->save();
            }
        }
        if($request->group == 'gp'){
            $notify = new Notification();
            $notify->pharmacy_id = $receiver;
            $notify->title = $request->title;
            $notify->body = $request->body;
            $notify->save();
        }
        if($request->group == 'au'){
           $notify = new Notification();
           $notify->type = 'user';
           $notify->title = $request->title;
           $notify->body = $request->body;
            $notify->save();
        }
        if($request->group == 'ad'){
            $notify = new Notification();
            $notify->type = 'doctor';
            $notify->title = $request->title;
            $notify->body = $request->body;
            $notify->save();
        }
        if($request->group == 'ap'){
            $notify = new Notification();
            $notify->type = 'pharmacy';
            $notify->title = $request->title;
            $notify->body = $request->body;
            $notify->save();
        }
        if($request->group == 'asp'){
            $notify = new Notification();
            $notify->type = 'service';
            $notify->title = $request->title;
            $notify->body = $request->body;
            $notify->save();
        }
        if($request->group == 'all'){
            $notify = new Notification();
            $notify->type = 'all';
            $notify->title = $request->title;
            $notify->body = $request->body;
            $notify->save();
        }
        return Redirect()->route('admin.notify')->with('success','Notification Sent');
    }





    
    /**
     * showing notification list by group
     *
     * @param  Request $request
     * @return Response
     */
    public function list(Request $request){
        $option = '';
        if($request->group == 'user'){
            $users = User::all();
            foreach($users as $user){
                $option .= "<option value='$user->id'>$user->name</option>";
            }
        }
        if($request->group == 'doctor'){
            $users = Doctor::all();
            foreach($users as $user){
                $option .= "<option value='$user->id'>$user->name</option>";
            }
        }
        if($request->group == 'pharmacy'){
            $users = Pharmacy::all();
            foreach($users as $user){
                $option .= "<option value='$user->id'>$user->name</option>";
            }
        }
        if($request->group == 'service'){
            $users = ServiceProvider::all();
            foreach($users as $user){
                $option .= "<option value='$user->id'>$user->name</option>";
            }
        }
        return $option;
    }
}
