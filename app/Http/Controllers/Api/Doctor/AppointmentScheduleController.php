<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AppointmentScheduleRequest;
use App\Models\AppointmentSchedule;
use App\Models\AppointmentSlot;
use App\Models\BonusPoint;
use App\Models\DoctorVisitCharge;
use App\Models\DoctorWallet;
use App\Models\EPrescription;
use App\Models\Notification;
use App\Models\UserWallet;
use App\Models\WalletTransactionLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AppointmentScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $doctor;

    public function __construct()
    {
        $this->doctor = Auth::user();
    }

    public function index()
    {
        $appointmentSchedules = AppointmentSchedule::with('user')->where('doctor_id', Auth::id())->get();
        // $appointmentSchedules = 1;
        return $this->jsonResponse($appointmentSchedules, "success");
    }


    /**
     * get the patient queue for a doctor
     *
     * @param  Request $request
     * @return Response
     */
    public function queue(Request $request)
    {
        // return Auth::id();
        $aDate = $request->date;
        $appointmentSchedules = AppointmentSchedule::with('user')
            ->where('date', $aDate)
            ->where('doctor_id', Auth::id())
            ->where('consult', 0)
            ->where(function ($query){
                $query->where('active',1)->orWhere('active',7);
            })
            ->get();

        //call cost calculations
        $all = array();
        foreach ($appointmentSchedules as $appointment) {
            $a = DoctorVisitCharge::where('doctor_id', $appointment->doctor_id)->first();
            $appointmentCost = $a->visit_charge + $a->commission;
            $userWallet = UserWallet::where('user_id', $appointment->user_id)->first();
            $userBonus = BonusPoint::get_balance_point($appointment->user_id);
            $eligible_point = (integer)$userBonus->balance/(integer)$userBonus->call_left;
            $userBalance = $userWallet->balance;
            if ($appointmentCost <= $eligible_point || $appointmentCost <= $userBalance) {
                $appointment->call = 1;
            } else {
                $appointment->call = 0;
            }
            array_push($all, $appointment);
        }

        $ePrescription = NULL;
        if(count($appointmentSchedules)>0){
            $ePrescription = EPrescription::select('id','user_id')->whereIn('appointment_schedule_id', $appointmentSchedules[0])->get();
        }

        return response()->json(['ePrescription' => $ePrescription, 'appointmentSchedules'=> $appointmentSchedules],200);
        // return $this->jsonResponse($appointmentSchedules, "success");
    }

    /**
     * get the history of consult
     *
     * @return Response
     */
    public function history()
    {
        $appointmentSchedules = AppointmentSchedule::with('user')
            ->where('consult', 1)
            ->where('doctor_id', Auth::id())
            ->get();

        $all = array();

        foreach ($appointmentSchedules as $appointment) {
            $appointment->call = 0;
            array_push($all, $appointment);
        }

        return $this->jsonResponse($all, "success");
    }



    public function show($id)
    {
        $appointmentSchedule = AppointmentSchedule::findOrFail($id);
        $appointmentSchedule->load('doctor');
        return $this->jsonResponse($appointmentSchedule, "success");
    }



    public function update(AppointmentScheduleRequest $request, $id)
    {
        $appointmentSchedule = AppointmentSchedule::findOrFail($id);
        $appointmentSchedule->update($request->all());
        $appointmentSlot = AppointmentSlot::findOrFail($appointmentSchedule->appointment_slot_id);


        $title = "Your Appointment has been rescheduled.";
        $body = "New Appointment Slot from " . date('h:i a', strtotime($appointmentSlot->start_time)) . " to " . date('h:i a', strtotime($appointmentSlot->end_time)) . " at " . date('d-m-Y', strtotime($appointmentSchedule->date));


        FileHelper::userNotify($$appointmentSchedule->user_id, $title, $body);
        FileHelper::doctorNotify($$appointmentSchedule->doctor_id, $title, $body);


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

    /**
     * change the Active status to ongoing
     *
     * @param  int $id
     * @return Response
     */
    public function changeActive($id)
    {
        $appointmentSchedule = AppointmentSchedule::findOrFail($id);
        $appointmentSchedule->active = 5; //ongoing
        $appointmentSchedule->save();
        return $this->jsonResponse("Ongoing", "success");
    }

    /**
     * appointemtn has been disable
     *
     * @param  int $id
     * @return Response
     */
    public function disable($id)
    {
        $appointmentSchedule = AppointmentSchedule::findOrFail($id);
        $appointmentSchedule->active = 0;
        $appointmentSchedule->save();

        $title = "Your Appointment has been Canceled.";
        $body = "Your Appointment Scheduled at " .  date('d-m-Y', strtotime($appointmentSchedule->date)) . " is Canceled.";


        FileHelper::userNotify($$appointmentSchedule->user_id, $title, $body);
        FileHelper::doctorNotify($$appointmentSchedule->doctor_id, $title, $body);

        return $this->jsonResponse($appointmentSchedule, "Disabled.");
    }

    /**
     * appointment successful
     *
     * @param  int $id
     * @return Response
     */
    public function done($id)
    {
        // checking if prescription is created or not
        $ePrescription = EPrescription::where('appointment_schedule_id', $id)->first();
        if ($ePrescription) {

            $appointmentSchedule = AppointmentSchedule::where('id', $id)->where('consult', 0)->first();
            $appointmentSchedule->consult = 1;
            $appointmentSchedule->save();

            $a = DoctorVisitCharge::where('doctor_id', $appointmentSchedule->doctor_id)->first();
            $appointmentCost = $a->visit_charge + $a->commission;

            $trx_id1 = uniqid();
            $trx_id2 = uniqid();
            $trx_id3 = uniqid();

            $title = "Your Appointment has been Completed";
            $body = "Your Appointment Scheduled at " . date('d-m-Y', strtotime($appointmentSchedule->date)) . " is Now Completed.";

            // bonus point here
            $userBonus = BonusPoint::get_balance_point($appointmentSchedule->user_id);
            $eligible_point = (integer)$userBonus->balance/(integer)$userBonus->call_left;
            if ($eligible_point >= $appointmentCost){
                BonusPoint::deduct_balance_point($appointmentSchedule->user_id, $appointmentCost);
                WalletTransactionLog::create(array_merge(["trx_id" => $trx_id1], ["payment_gateway" => "Medimate-Bonus"], ["user_id" => $appointmentSchedule->user_id], ['type' => 'Visiting Charge'], ['amount' => $appointmentCost], ['deposit' => 0], ['payment_note' => 'Doctor`s Fee Given to ' . $appointmentSchedule->doctor_id. 'from Bonus Point']));

                FileHelper::userNotify($appointmentSchedule->user_id, $title . " and point Deducted", $body . " and " . $appointmentCost . " points deducted from your Bonus.");

            }
            else{
                UserWallet::where('user_id', $appointmentSchedule->user_id)->decrement('balance', $appointmentCost);
                WalletTransactionLog::create(array_merge(["trx_id" => $trx_id1], ["payment_gateway" => "Medimate-Wallet"], ["user_id" => $appointmentSchedule->user_id], ['type' => 'Visiting Charge'], ['amount' => $appointmentCost], ['deposit' => 0], ['payment_note' => 'Doctor`s Fee Given to ' . $appointmentSchedule->doctor_id]));

                FileHelper::userNotify($appointmentSchedule->user_id, $title . " and point Deducted", $body . " and " . $appointmentCost . " points deducted from your account.");
            }

            DoctorWallet::where('doctor_id', $appointmentSchedule->doctor_id)->increment('balance', $a->visit_charge);

            WalletTransactionLog::create(array_merge(["trx_id" => $trx_id2], ["payment_gateway" => "Medimate-Wallet"], ["doctor_id" => $appointmentSchedule->doctor_id], ['type' => 'Visiting Charge'], ['amount' => $a->visit_charge], ['deposit' => 1], ['payment_note' => 'Fees Received From ' . $appointmentSchedule->user_id]));

            WalletTransactionLog::create(array_merge(["trx_id" => $trx_id3], ["payment_gateway" => "Medimate-Wallet"], ['type' => 'Visiting Charge Medimate Commission'], ['amount' => $a->commission], ['deposit' => 2], ['payment_note' => 'Fees Received For Appointment  ' . $appointmentSchedule->id]));


            FileHelper::doctorNotify($appointmentSchedule->doctor_id, $title . " and point Added", $body . " and " . $a->visit_charge . " points added to your account.");

            // FileHelper::doctorNotify($appointmentSchedule->doctor_id, $title, $body);

            return $this->jsonResponse($appointmentSchedule, "Appointment Done.");
        } else {
            return response()->json(['message' => 'Prescription not created.'], 401);
        }
    }
}
