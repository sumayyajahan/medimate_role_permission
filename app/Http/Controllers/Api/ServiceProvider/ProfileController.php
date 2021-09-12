<?php

namespace App\Http\Controllers\Api\ServiceProvider;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ServiceProfileUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class ProfileController extends Controller
{

    public function profile()
    {
        $service_provider = Auth::user();
        return $this->jsonResponse($service_provider, "success");
    }

    public function update(ServiceProfileUpdateRequest $request)
    {
        $service_provider = Auth::user();
        $imageName = FileHelper::uploadImage($request, $service_provider);
        $service_provider->fill(array_merge($request->all(), ['image' => $imageName]))->save();
        return $this->jsonResponse($service_provider, "success");
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $service_provider = Auth::user();
        // $users = User::where('mobile',$service_provider->mobile)->get();
        if (Hash::check($request->oldpassword, $service_provider->password)) {
            $service_provider->password = Hash::make($request->password);
            $service_provider->save();
            FileHelper::serviceNotify($service_provider->id, "Password Changed.", "Your password has been changed successfully.");
            return response()->json("Password Changed.", 200);
        } else {
            return response()->json("Password Not Matched", 422);
        }
    }
}
