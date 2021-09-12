<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelper;
use App\Helpers\UploadImage;
use App\Http\Controllers\Controller;
use App\Models\ClaimInsurance;
use App\Models\InsuranceEnroll;
use Illuminate\Http\Request;

class ClaimInsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = ClaimInsurance::orderBy('id')->get();
        return view('admin.claim_insurance.index', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $enroll = InsuranceEnroll::find($id);
        return view('admin.claim_insurance.create', compact('enroll'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $enroll_id = $input['enroll_id'];

        if($request->hasFile('signature_employee')) {
            $file=$request->file('signature_employee');
            $input['signature_employee'] = UploadImage::image_upload($file);
        }

        if($request->hasFile('signature_coordinator')) {
            $file=$request->file('signature_coordinator');
            $input['signature_coordinator'] = UploadImage::image_upload($file);
        }

        if($request->hasFile('signature_officer')) {
            $file=$request->file('signature_officer');
            $input['signature_officer'] = UploadImage::image_upload($file);
        }


        try {
            ClaimInsurance::create($input);
            $user_id = InsuranceEnroll::find($enroll_id)->user_id;
            FileHelper::userNotify($user_id, "Insurance Claim.","Insurance Claim form submitted.");
            return "<h2 align='center'>Your Request has been accepted</h2>";
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $claim = ClaimInsurance::find($id);
        return view('admin.claim_insurance.show', compact('claim'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
