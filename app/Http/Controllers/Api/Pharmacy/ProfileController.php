<?php

namespace App\Http\Controllers\Api\Pharmacy;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PharmacyProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class ProfileController extends Controller
{

    public function profile()
    {
        $pharmacy = Auth::user();
        return $this->jsonResponse($pharmacy, "success");
    }

    public function update(Request $request)
    {
        $pharmacy = Auth::user();
        $imageName = FileHelper::uploadImage($request, $pharmacy);
        $pharmacy->fill(array_merge($request->all(), ['image' => $imageName]))->save();
        return $this->jsonResponse($pharmacy, "success");
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $pharmacy = Auth::user();
        if (Hash::check($request->oldpassword, $pharmacy->password)) {
            $pharmacy->password = Hash::make($request->password);
            $pharmacy->save();

            FileHelper::pharmacyNotify($pharmacy->id, "Password Changed.", "Your password has been changed successfully.");
            return response()->json("Password Changed.", 200);
        } else {
            return response()->json("Password Not Matched", 422);
        }
    }
}
