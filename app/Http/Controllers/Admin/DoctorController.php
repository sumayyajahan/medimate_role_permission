<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use File;
use App\Http\Requests\DoctorCreateRequest;
use App\Http\Requests\DoctorUpdateRequest;
use App\Helpers\FileHelper;
use App\Models\Admin;
use App\Models\DoctorSpecialization;
use App\Models\DoctorVisitCharge;
use App\Models\DoctorWallet;
use App\Models\Specialization;
use Auth;
use PhpParser\Node\Stmt\Foreach_;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::latest()->with('admin')->get();
        return view('admin.doctors', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specializations = Specialization::all();
        return view('admin.doctor_create', compact('specializations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoctorCreateRequest $request)
    {
        // return $request;
        $imageName = FileHelper::uploadImage($request);
        //$password = bcrypt($request->password);
        //$doctorId = "D" . date('ymdHis') . rand(10, 99);

        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        $input['doctorid'] = "D" . date('ymdHis') . rand(10, 99);
        $input['image']=$imageName;
        $input['admin_id'] = Admin::create([
            'name'=>$input['name'],
            'email'=>$input['email'],
            'mobile'=>$input['mobile'],
            'password'=>$input['password']
        ])->id;

        $doctor = Doctor::create($input);


        // $doctor = Doctor::create(array_merge($request->all(), ['image' => $imageName, 'admin_id' => Auth::id(), 'password' => $password, 'doctorid' => $doctorId]));
        $specializationDatabase = "";
        foreach ($request->specializations as $specialization) {
            DoctorSpecialization::create(['doctor_id' => $doctor->id, 'specialization_id' => $specialization]);
            $specializationTable = Specialization::find($specialization);
            $specializationDatabase .= $specializationTable->name.",";
        }
        $doctor->specialization = $specializationDatabase;
        $doctor->referral_code = CommonHelper::createReferralCode($request->name);
        $doctor->save();
        DoctorWallet::create(['doctor_id' => $doctor->id]);
        DoctorVisitCharge::create(['doctor_id' => $doctor->id]);
        return back()->with('success', 'Successfully Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        $specializations = Specialization::all();
        $docotrSpecializations = DoctorSpecialization::where('doctor_id', $doctor->id)->pluck('specialization_id')->toArray();
        return view('admin.doctor_show', compact('doctor', 'docotrSpecializations', 'specializations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        $specializations = Specialization::all();
        $docotrSpecializations = DoctorSpecialization::where('doctor_id', $doctor->id)->pluck('specialization_id')->toArray();

        return view('admin.doctor_edit', compact('doctor', 'specializations', 'docotrSpecializations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DoctorUpdateRequest $request, Doctor $doctor)
    {
        $imageName = FileHelper::uploadImage($request, $doctor);
        $doctor->fill(array_merge($request->all(), ['image' => $imageName]))->save();
        //delete previous
        $docotrSpecializations = DoctorSpecialization::where('doctor_id', $doctor->id)->get();
        foreach($docotrSpecializations as $docotrSpecialization){
            $docotrSpecialization->delete();
        }
        $specializationDatabase = "";
        foreach ($request->specializations as $specialization) {
            DoctorSpecialization::create(['doctor_id' => $doctor->id, 'specialization_id' => $specialization]);
            $specializationTable = Specialization::find($specialization);
            $specializationDatabase .= $specializationTable->name . ",";
        }
        $doctor->specialization = $specializationDatabase;

        if($doctor->wasChanged('status')){
            $message = null;
            if($doctor->status == 1){
               $message = "Congrats! your account has been Activated";
            }
            elseif($doctor->status == 0){
                $message = "Sorry! your account has been Deactivated";
            }
            CommonHelper::sendSMSForNotification($doctor->mobile, $message);
        }

        $doctor->save();
        return back()->with('success', 'Update Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        // if (File::exists('images/' . $doctor->image)) {
        //     File::delete('images/' . $doctor->image);
        // }
        $doctor->delete();

        return back()->with('success', 'Successfully Deleted.');
    }

    public function trash()
    {
        $doctors = Doctor::onlyTrashed()->with('admin')->get();
        return view('admin.doctors_trash', compact('doctors'));
    }


    public function forceDelete($id)
    {
        $doctor = Doctor::withTrashed()->where('id', $id)->first();
        if (File::exists('images/' . $doctor->image)) {
            File::delete('images/' . $doctor->image);
        }
        $doctor->forceDelete();
        return back()->with('success', 'Permanent Delete Successfully.');
    }
}
