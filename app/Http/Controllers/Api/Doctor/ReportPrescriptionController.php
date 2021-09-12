<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ReportPrescriptionController extends Controller
{
    /**
     * get the prescription of an user
     *
     * @param  int $userId
     * @return Response
     */
    public function userReportPrescription($userId)
    {
        $userReportPrescription = User::where('id', $userId)->with('reportPrescription')->first();
        return $this->jsonResponse($userReportPrescription, "User with Previous Report or Prescription");
    }
}
