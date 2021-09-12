<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Controller;
use App\Models\CommonSetting;
use App\Models\DoctorSpecialization;
use App\Models\EPrescription;
use App\Models\LoginActivity;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Twilio\Rest\Client;

class CommonController extends Controller
{
    /**
     * get login activities
     *
     * @param  Request $request
     * @return json
     */
    public function loginActivity(Request $request)
    {
        $insertArray = [
            "login_user_id" => $request->id,
            "type" => $request->user_type,
            "start" => $request->start,
            "end" => date('Y-m-d h:i:s a')
        ];

        LoginActivity::create($insertArray)->save();

        return $this->jsonRes($insertArray, 200);
    }

    public function commonDoc($docType)
    {
        $docType = CommonSetting::where('docName', $docType)->pluck('details')->first();
        if ($docType) {
            # code...
            return $this->jsonRes($docType, 200);
        } else {
            abort(404);
        }
    }

    /**
     * get the specialization
     *
     * @return Response
     */
    public function specialization()
    {
        $sp = Specialization::orderBy('priority', 'asc')->get();
        return $sp;
    }

    public function specializationWithDoctor()
    {
        $doctorSpecializations = DoctorSpecialization::distinct('specialization_id')->pluck('specialization_id');
        return $specializations = Specialization::whereIn('id', $doctorSpecializations)->orderBy('priority', 'asc')->get();
    }

    /**
     * sendSMS to local
     *
     * @param  string $contact
     * @param  string $msg
     * @return json
     */
    public function sendSMS($contact, $msg)
    {
        if (preg_match('/^\+?(88)?0?1[3456789][0-9]{8}\b/', $contact)) {
            $url = "https://esms.mimsms.com/smsapi?api_key=C20080066040da9a0ab5b3.00415555&type=text&contacts=" . $contact . "&senderid=MediMate&msg=" . $msg . "";
            return Redirect::to($url);
        } else {
            $account_sid = "AC0ff1285ceac79337f5f9281c9d95bd93";
            $auth_token = "7cce2b69c0f95828af0a21140d98aebc";
            $twilio_number = "+12676333011";
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($contact, ['from' => $twilio_number, 'body' => $msg]);
            return $this->jsonRes('Sms sennd From Twilio.', 200);
        }
    }

    /**
     * sendSMS to international
     *
     * @param  string $contact
     * @param  string $msg
     * @return json
     */
    public function sendSMSIntl($contact, $msg)
    {
        $account_sid = "AC0ff1285ceac79337f5f9281c9d95bd93";
        $auth_token = "7cce2b69c0f95828af0a21140d98aebc";
        $twilio_number = "+12676333011";
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($contact, ['from' => $twilio_number, 'body' => $msg]);
        return $this->jsonRes('Sms sennd From Twilio.', 200);
    }

    public function medimateImage()
    {
        return "medimate-images/cover.jpeg";
    }

    public function get_e_prescription($id)
    {
        $p = EPrescription::findOrFail($id);
        $ePrescription = EPrescription::where('id', $id)->with('doctor', 'appointmentSchedule')->first();
        $rxRow = explode('+', $ePrescription->rx);
        $complaintAndHistory = explode('|', $ePrescription->cc);

        $data = array($ePrescription, $rxRow, $complaintAndHistory);

//        return view('prescription.index', compact('ePrescription', 'rxRow', 'complaintAndHistory'));
        return response()->json($data, 200);
    }

}
