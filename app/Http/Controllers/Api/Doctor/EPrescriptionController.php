<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EPrescriptionRequest;
use App\Models\AppointmentSchedule;
use App\Models\EPrescription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EPrescriptionController extends Controller
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
        $ePrescriptions = EPrescription::where('doctor_id', $this->doctor->id)->with('doctor', 'user', 'appointmentSchedule')->get();
        return $this->jsonResponse($ePrescriptions, "success");
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EPrescriptionRequest $request)
    {
        $apps = AppointmentSchedule::findOrFail($request->appointment_schedule_id);
        $user_id = $apps->user_id;

        $checkPrescription = EPrescription::where('appointment_schedule_id', $request->appointment_schedule_id)->where('user_id', $user_id)->where('doctor_id', Auth::id())->first();
        if ($checkPrescription) {
            return response()->json('Prescription already created', 205);
        }

        $ePrescription = EPrescription::create(array_merge($request->all(), ['user_id' => $user_id, 'doctor_id' => Auth::id()]));
        $title = "Prescription Created.";
        $body = "Prescription create successful.";

        FileHelper::userNotify($user_id, $title, $body);
        FileHelper::doctorNotify($apps->doctor_id, $title, $body);
        return $this->jsonResponse($ePrescription, "Create Successful.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EPrescription  $ePrescription
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ePrescription = $this->getDoctorEprescription($id);
        return $this->jsonResponse($ePrescription, "Success");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EPrescription  $ePrescription
     * @return \Illuminate\Http\Response
     */
    public function update(EPrescriptionRequest $request, $id)
    {
        $ePrescription = $this->getDoctorEprescription($id);
        $ePrescription->update(array_merge($request->all(), ['doctor_id' => $this->doctor->id]));
        return $this->jsonResponse($ePrescription, "Update Successful.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EPrescription  $ePrescription
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ePrescription = $this->getDoctorEprescription($id);
        $ePrescription->delete();
        return $this->jsonResponse("Deleted", "Delete Successful.");
    }


    public function getDoctorEprescription($id)
    {
        $ePrescription = EPrescription::where('id', $id)->where('doctor_id', $this->doctor->id)->first();
        if ($ePrescription) {
            return $ePrescription;
        } else {
            return abort(404);
        }
    }
}
