<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\CommonHelper;
use App\Helpers\DataHelper;
use App\Helpers\FileHelper;
use App\Helpers\UploadImage;
use App\Http\Controllers\Controller;
use App\Mail\SendGoodHealthMail;
use App\Models\ClaimInsurance;
use App\Models\GoodHealthDeclaration;
use App\Models\Insurance;
use App\Models\InsuranceEnroll;
use App\Models\InsurancePackage;
use Carbon\Carbon;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InsuranceEnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $insurance_enrolls = InsuranceEnroll::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
        $enrolls = array();
        foreach ($insurance_enrolls as $enroll){

            if ($enroll->activation_date != null){
                $expire_date = Carbon::parse($enroll->activation_date)->addMonths($enroll->insurancePackage->duration);
                $diff = $expire_date->diffInDays(Carbon::today());
                $will_expire = $expire_date->format('M d, Y').' ('.$diff.' Days Left)';
            }
            else{
                $will_expire = "Inactive";
            }

            $benefits = InsurancePackage::get_package_benefits($enroll->insurance_package_id, $will_expire);
            if (ClaimInsurance::has_claimed($enroll->id) == true)
            {
                $benefits .="<br><b>You have already submitted insurance claim form</b>";
            }


            $item = array(
                'enroll_id' => (string)$enroll->id,
                'user_id' => (string)$enroll->user_id,
                'package_name' => $enroll->insurancePackage->name,
                'expiry_date' => $will_expire,
                'status' => DataHelper::insurance_status()[$enroll->status],
                'benefits' => $benefits,
                'claim_url' => \url('claim-insurance', $enroll->id),
                'form_submitted' => GoodHealthDeclaration::has_declaration_form($enroll->id),
                'form_url' => $enroll->form_url,
            );
            array_push($enrolls, $item);

        }

        return $this->jsonRes($enrolls, 200);
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
        $user = Auth::user();
        $input['user_id'] = $user->id;

        if($request->hasFile('nid_front')) {
            $file=$request->file('nid_front');
            $input['nid_front'] = UploadImage::image_upload($file);
        }
        if($request->hasFile('nid_back')) {
            $file=$request->file('nid_back');
            $input['nid_back'] = UploadImage::image_upload($file);
        }

//        return response()->json($input);

        $enroll = InsuranceEnroll::create($input);


        $form_url = \url('health-statement-form', encrypt($enroll->id));
        $cuttly_api = config('app.cuttly_api');
        $json = file_get_contents("https://cutt.ly/api/api.php?key=$cuttly_api&short=$form_url");
        $data = json_decode($json, true);
        $short_url = $data['url']['shortLink'];

        $enroll->form_url = $short_url;
        $enroll->save();

        FileHelper::userNotify(Auth::id(), "Insurance Apply.","Insurance applied successful.");

        $msg = 'Please fill out the form to confirm your insurance submission. Form link '.$short_url;
        FileHelper::userNotify(Auth::id(), "Insurance Health Form.",$msg);

        CommonHelper::sendSMSForNotification($user->mobile, 'Hello, '.$msg);

        return response()->json(['message'=>'Your Request is Successful, Our Agent will contact you soon. '.$msg], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $insurance = InsuranceEnroll::findOrFail($id);
        // return $insurance->is_approved;
        if ($insurance->is_approved == 0) {
            # code...
            $insurance->status = 9;
            $insurance->save();

            return $this->jsonRes($insurance,202);
        }
        else {
            return $this->jsonRes('Already in Process',401);
        }

    }

    /**
     * view the insurance list .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewInsurance()
    {
        $insurance = Insurance::where('status', 1)->get();
        if (count($insurance) == 0) abort(410);
        return $this->jsonRes($insurance, 200);
    }
    public function viewInsurancePkg($id)
    {
        $insurancePkg = InsurancePackage::findOrFail($id);
        return $this->jsonRes($insurancePkg->all(), 200);
    }

    /**
     * get the insurance package by type
     *
     * @param  string $type
     * @return Response
     */
    public function viewInsurancePkgType($type)
    {
        $insurancePkgs = InsurancePackage::where('type', $type)->with('insurance')->get();

        $packages = array();
        foreach ($insurancePkgs as $pack){
            $item = array(
                'insurance_package_id' => (string)$pack->id,
                'insurance_id' => (string)$pack->insurance_id,
                'name' => $pack->name,
                'type' => $pack->type,
                'validity' => $pack->duration.' Months',
                'premium' => 'BDT '.$pack->amount.'/Month',
                'benefits' => InsurancePackage::get_package_benefits($pack->id),
                'has_terms' => false,
                'terms_url' => $pack->terms_url != null ? $pack->terms_url : 'https://medimate.health/terms-condition',
            );

            array_push($packages, $item);

        }


        return $this->jsonRes($packages, 200);
    }
}
