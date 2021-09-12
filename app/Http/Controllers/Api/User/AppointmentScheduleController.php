<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\CommonHelper;
use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AppointmentScheduleRequest;
use App\Models\AppointmentSchedule;
use App\Models\AppointmentSlot;
use App\Models\Notification;
use App\Models\UserWallet;
use App\Models\WalletTransactionLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function index()
    {
        $appointmentSchedules = AppointmentSchedule::with('doctor')->where('user_id', Auth::id())->get();
        $appointmentSchedules->load('appointmentSlot');
        return $this->jsonResponse($appointmentSchedules, "success");
    }

    /**
     * get the upcoming appointment
     *
     * @return Response
     */
    public function upcoming()
    {
        $appointmentSchedules = AppointmentSchedule::with('doctor')
            ->where('user_id', Auth::id())
            ->where('active', 1)
            ->where('consult', 0)
            ->get();
        $appointmentSchedules->load('appointmentSlot');
        return $this->jsonResponse($appointmentSchedules, "success");
    }


    public function history()
    {
        $appointmentSchedules = AppointmentSchedule::with('doctor')
            ->where('user_id', Auth::id())
            ->where('active', 1)
            ->where('consult', 1)
            ->get();
        $appointmentSchedules->load('appointmentSlot');
        return $this->jsonResponse($appointmentSchedules, "success");
    }

    public function indexDoctor()
    {
        $appointmentSchedules = AppointmentSchedule::with('user')->where('doctor_id', Auth::id())->get();
        // $appointmentSchedules = 1;
        return $this->jsonResponse($appointmentSchedules, "success");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentScheduleRequest $request)
    {

        $user_id = null;
        $service_by = null;
        if ($request->has('user_id')){
            $user_id = (integer)$request->user_id;
            $service_by = Auth::user()->serviceid;
        }else{
            $user_id = Auth::user()->id;
        }

        $s_day = Carbon::parse($request->date)->format('D');
        $slot = AppointmentSlot::where('doctor_id', $request->doctor_id)->where('day', '=', $s_day)->first();

        $appointmentSchedule = AppointmentSchedule::create(array_merge($request->all(), ['user_id' => $user_id, 'doctor_id' => $slot->doctor_id, 'appointment_slot_id'=> $slot->id, 'service_by' => $service_by, 'is_emergency' => $request->is_emergency]));
        $appointmentSchedule->load('appointmentSlot')->load('doctor');
        $body = "Appointment Created For " . $appointmentSchedule->doctor->name . " At " . date('d/m/Y',strtotime($appointmentSchedule->date)) . " Scheduled at " . $appointmentSchedule->time;
        $bodyU = "Appointment Created For " . $appointmentSchedule->user->name . " At " . date('d/m/Y',strtotime($appointmentSchedule->date)) . " Scheduled at " . $appointmentSchedule->time;
        FileHelper::userNotify($user_id, "Appointment Created", $body);
        FileHelper::doctorNotify($request->doctor_id, "Appointment Created", $bodyU);

        // emergency sms
        if ($request->is_emergency == true){
            CommonHelper::sendSMSForNotification($appointmentSchedule->doctor->mobile, 'Emergency '.$bodyU);
        }

        return $this->jsonResponse($appointmentSchedule, "success");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppointmentSchedule
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointmentSchedule = AppointmentSchedule::findOrFail($id);
        $appointmentSchedule->load('doctor');
        return $this->jsonResponse($appointmentSchedule, "success");
    }

    public function showDoctor($id)
    {
        $appointmentSchedule = AppointmentSchedule::findOrFail($id);
        $appointmentSchedule->load('user');
        return $this->jsonResponse($appointmentSchedule, "success");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppointmentSchedule  $appointmentSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentScheduleRequest $request, $id)
    {
        $appointmentSchedule = AppointmentSchedule::findOrFail($id);
        $appointmentSchedule->update(array_merge($request->all(), ['user_id' => Auth::user()->id]));
        return $this->jsonResponse($appointmentSchedule, "success");
    }


    public function updateDoctor(AppointmentScheduleRequest $request, $id)
    {
        $appointmentSchedule = AppointmentSchedule::findOrFail($id);
        $appointmentSchedule->update($request->all());
        $appointmentSlot = AppointmentSlot::findOrFail($appointmentSchedule->appointment_slot_id);

        $notify = [
            "user_id" => $appointmentSchedule->user_id,
            "doctor_id" => $appointmentSchedule->doctor_id,
            "title" => "Your Appointment has been rescheduled",
            "body" => "New Appointment Slot from " . $appointmentSlot->start_time . " to " . $appointmentSlot->start_time . " at " . $appointmentSchedule->date
        ];

        $notifyUser = Notification::create(array_merge(["user_id" => $appointmentSchedule->user_id], ["doctor_id" => $appointmentSchedule->doctor_id], ["title" => "Your Appointment has been rescheduled"], ["body" => "New Appointment Slot from " . $appointmentSlot->start_time . " to " . $appointmentSlot->end_time . " at " . $appointmentSchedule->date]));

        // $notifyUser->user_id = $appointmentSchedule->user_id;
        // $notifyUser->doctor_id = $appointmentSchedule->doctor_id;
        // $notifyUser->title = "Your Appointment has been rescheduled";
        // $notifyUser->body = "New Appointment Slot from ".$appointmentSchedule->slot->start_time." to ".$appointmentSchedule->slot->start_time." at ".$appointmentSchedule->date;



        return $this->jsonResponse($appointmentSchedule, "success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppointmentSchedule  $appointmentSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointmentSchedule = AppointmentSchedule::findOrFail($id);
        $appointmentSchedule->delete();
        return $this->jsonResponse("Deleted", "success");
    }

    public function disable($id)
    {
        $appointmentSchedule = AppointmentSchedule::findOrFail($id);
        $appointmentSchedule->active = 0;
        $appointmentSchedule->save();
        return $this->jsonResponse($appointmentSchedule, "Disabled.");
    }

    public function disableDoctor($id)
    {
        $appointmentSchedule = AppointmentSchedule::findOrFail($id);
        $appointmentSchedule->active = 0;
        $appointmentSchedule->save();
        $notifyUser = Notification::create(array_merge(["user_id" => $appointmentSchedule->user_id], ["doctor_id" => $appointmentSchedule->doctor_id], ["title" => "Your Appointment has been canceled"], ["body" => "Your Appointment of date " . $appointmentSchedule->date . " has been canceled."]));

        return $this->jsonResponse($appointmentSchedule, "Disabled.");
    }

    public function done($id)
    {
        $appointmentSchedule = AppointmentSchedule::where('id', $id)->where('consult', 0)->first();
        $appointmentSchedule->consult = 1;
        $appointmentSchedule->save();

        $userWallet = UserWallet::where('user_id', $appointmentSchedule->user_id)->decrement('balance', 10);


        // $dWallet = drWallet::where('doctor_id',$appointmentSchedule->doctor_id)->increment('balance',10);

        $createLog = WalletTransactionLog::create(array_merge(["user_id" => $appointmentSchedule->user_id], ['type' => 'Fees'], ['amount' => 100], ['deposilte' => 0], ['comment' => 'Doctor`s Fee Given to ' . $appointmentSchedule->doctor_id]));
        $createLog = WalletTransactionLog::create(array_merge(["doctor_id" => $appointmentSchedule->doctor_id], ['type' => 'Fees'], ['amount' => 100], ['deposilte' => 1], ['comment' => 'Fees Received From ' . $appointmentSchedule->user_id]));

        $title = "Your Appointment has been Completed";
        $body = "Your Appointment Scheduled at " .  $appointmentSchedule->date . "is Now Complete.";


        FileHelper::userNotify($appointmentSchedule->user_id, $title, $body);
        FileHelper::doctorNotify($appointmentSchedule->doctor_id, $title, $body);

        return $this->jsonResponse($appointmentSchedule, "Disabled.");
    }
}
