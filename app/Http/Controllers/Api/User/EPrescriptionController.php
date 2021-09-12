<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\EPrescription;
use App\Models\ReportPrescription;
use Illuminate\Support\Facades\Auth;

class EPrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $user;

    public function __construct()
    {
//        $this->user = Auth::user();
    }

    public function all()
    {
        $ePrescriptions = EPrescription::where('user_id', Auth::id())->with('doctor', 'appointmentSchedule')->get();
        return $this->jsonResponse($ePrescriptions, "success");
    }

    public function order($id)
    {
        $arr = array();
        $p = EPrescription::findOrFail($id);
        $ePrescription = EPrescription::where('id', $id)->with('doctor', 'appointmentSchedule')->first();
        $rxRow = explode('+', $ePrescription->rx);
        foreach ($rxRow as $rx) {
            $a = explode(',', $rx);
            array_push($arr, $a);
        }

        return $arr;
    }

    /**
     * single e prescription view
     *
     * @param  int $id
     * @return Response
     */
    public function single($id)
    {
         $p = EPrescription::findOrFail($id);
        $ePrescription = EPrescription::where('id', $id)->with('doctor', 'appointmentSchedule')->first();
        $rxRow = explode('+', $ePrescription->rx);
         $complaintAndHistory = explode('|', $ePrescription->cc);

        return view('prescription.index', compact('ePrescription', 'rxRow', 'complaintAndHistory'));
        // return $this->jsonResponse($ePrescription, "Success");
    }


    /**
     * single  prescription view
     *
     * @param  int $id
     * @return Response
     */
    public function singleApp($id)
    {
        $ePrescription = EPrescription::where('appointment_schedule_id', $id)->with('doctor', 'appointmentSchedule', 'user')->get();

        if (count($ePrescription) == NULL) {
            abort(404);
        } else {
            $ePrescription = $ePrescription[0];
            $rxRow = explode('+', $ePrescription->rx);
            $complaintAndHistory = explode('|', $ePrescription->cc);

            return view('prescription.index', compact('ePrescription', 'rxRow', 'complaintAndHistory'));
        }
    }

    public function getDoctorEprescription($id)
    {
        $ePrescription = EPrescription::where('id', $id)->with('doctor', 'appointmentSchedule')->first();
        if ($ePrescription) {
            return $ePrescription;
        } else {
            return abort(404);
        }
    }

    /**
     * get all e prescription if a user
     *
     * @param  int $id
     * @return Response
     */
    public function allerp($id)
    {
        $ePrescription = EPrescription::where('user_id', $id)->with('doctor', 'appointmentSchedule')->get();
        $rPrescription = ReportPrescription::where('user_id', $id)->get();
        if ($ePrescription || $rPrescription) {
            return $this->json2($rPrescription, $ePrescription);
        } else {
            return abort(404);
        }
    }
}
