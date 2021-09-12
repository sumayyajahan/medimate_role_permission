<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorVisitCharge;
use Illuminate\Http\Request;

class DoctorVisitChargeController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('admin.visit-charge', compact('doctors'));
    }

    public function show($id)
    {
        $doctor = DoctorVisitCharge::where('doctor_id', $id)->first();
        return $doctor;
    }


    public function store(Request $request)
    {
        $doctor = DoctorVisitCharge::where('doctor_id', $request->doctor_id)->first();
        if ($doctor) {
            $doctor->visit_charge = $request->visit_charge;
            $doctor->commission = $request->commission;
            $doctor->save();
        } else {
            $doctorVisitCharge = new DoctorVisitCharge();
            $doctorVisitCharge->doctor_id = $request->doctor_id;
            $doctorVisitCharge->visit_charge = $request->visit_charge;
            $doctorVisitCharge->commission = $request->commission;
            $doctorVisitCharge->save();
        }

        FileHelper::doctorNotify($request->doctor_id, "Visiting Charge.", "Visiting charge changed.");
        return back()->with('success', 'Update Charges Successful');
    }
}
