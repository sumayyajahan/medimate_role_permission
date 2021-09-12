<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ReportPrescriptionRequest;
use App\Models\ReportPrescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class ReportPrescriptionController extends Controller
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
        $reportPrescriptions = ReportPrescription::where('user_id', Auth::id())->get();
        return $this->jsonResponse($reportPrescriptions, "success");
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReportPrescriptionRequest $request)
    {
        $fileName = FileHelper::uploadFile($request);
        $reportPrescription = ReportPrescription::create(array_merge($request->all(), ['user_id' => Auth::id(),'file' => $fileName]));
        return $this->jsonResponse($reportPrescription, "Create Successful.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReportPrescription  $reportPrescription
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reportPrescription = $this->getReportPrescription($id);
        return $this->jsonResponse($reportPrescription, "Success");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReportPrescription  $reportPrescription
     * @return \Illuminate\Http\Response
     */
    public function update(ReportPrescriptionRequest $request, $id)
    {
        $reportPrescription = $this->getReportPrescription($id);
        $fileName = FileHelper::uploadFile($request,$reportPrescription);
        $reportPrescription->update(array_merge($request->all(), ['user_id' => Auth::id(), 'file' => $fileName]));
        return $this->jsonResponse($reportPrescription, "Update Successful.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReportPrescription  $reportPrescription
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reportPrescription = $this->getReportPrescription($id);
        FileHelper::deleteFile($reportPrescription);
        $reportPrescription->delete();
        return $this->jsonResponse("Deleted", "Delete Successful.");
    }


    public function getReportPrescription($id)
    {
        $reportPrescription = ReportPrescription::where('id', $id)->where('user_id', Auth::id())->first();
        if ($reportPrescription) {
            return $reportPrescription;
        } else {
            return abort(404);
        }
    }



}
