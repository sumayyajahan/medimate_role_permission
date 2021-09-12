<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorSpecialization;
use App\Models\DoctorVisitCharge;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function profile()
    {
        $doctor = Doctor::where('id',auth()->id())->with('visitingFee')->first();
        // $doctor = $doctor->visitingFee;
        return $this->jsonResponse($doctor, "success");
    }

    public function update(Request $request)
    {
        // return $request->specializations;
        $doctor = Auth::user();
        $imageName = FileHelper::uploadImage($request, $doctor);
        $doctor->fill(array_merge($request->all(), ['image' => $imageName]))->save();

        if($request->visit_charge){
            $visitingFee = DoctorVisitCharge::where('doctor_id',$doctor->id)->first();
            $visitingFee->visit_charge = $request->visit_charge;
            $visitingFee->save();
        }

        if (is_array($request->specializations)) {
            //delete previous
            $docotrSpecializations = DoctorSpecialization::where('doctor_id', $doctor->id)->get();
            foreach ($docotrSpecializations as $docotrSpecialization) {
                $docotrSpecialization->delete();
            }
            $specializationDatabase = "";

            foreach ($request->specializations as $specialization) {
                $specializationTable = Specialization::findOrFail($specialization);
                DoctorSpecialization::create(['doctor_id' => $doctor->id, 'specialization_id' => $specialization]);
                $specializationDatabase .= $specializationTable->name . ",";
            }
            $doctor->specialization = $specializationDatabase;
            $doctor->save();
        }
        return $this->jsonResponse($doctor, "success");
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = Auth::user();
        if (Hash::check($request->oldpassword, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json("Password Changed.", 200);
        } else {
            FileHelper::doctorNotify($user->id,"Password Changed.","Your password has been changed successfully.");
            return response()->json("Password Not Matched", 422);
        }
    }
}
