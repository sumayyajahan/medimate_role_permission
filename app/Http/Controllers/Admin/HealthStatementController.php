<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UploadImage;
use App\Http\Controllers\Controller;
use App\Models\GoodHealthDeclaration;
use App\Models\InsuranceEnroll;
use Illuminate\Http\Request;

class HealthStatementController extends Controller
{
    public function open_health_form($enroll_id)
    {
        $enrollment_id = decrypt($enroll_id);
        $enroll = InsuranceEnroll::find($enrollment_id);

        return view('admin.claim_insurance.good_health_form', compact('enroll'));

    }

    public function show_health_form($id)
    {
        $form = GoodHealthDeclaration::find($id);
        return view('admin.claim_insurance.good_health_show', compact('form'));

    }

    public function save_health_form(Request $request)
    {
        $input = $request->all();

        if($request->hasFile('signature')) {
            $file=$request->file('signature');
            $input['signature'] = UploadImage::image_upload($file);
        }

        try {
            GoodHealthDeclaration::create($input);
            return "<br><h2 align='center'>Form Submitted Successfully!</h2>";
        }catch (\Exception $exception){
            return $exception->getMessage();
        }


    }
}
