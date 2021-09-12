<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\FileHelper;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserProfileUpdateRequest;
use Defuse\Crypto\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    public function profile()
    {
         $user = Auth::user();
        return $this->jsonResponse($user, "success");
    }
    

    public function update(Request $request)
    {
        $user = Auth::user();
        $imageName = FileHelper::uploadImage($request, $user);
        $user->update(array_merge($request->all(), ['image' => $imageName]));
        return $this->jsonResponse($user, "success");
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
            $user->view_password = $request->password;
            $user->save();
            FileHelper::userNotify($user->id, "Password Changed.", "Your password has been changed successfully.");
            return response()->json("Password Changed.", 200);
        } else {
            return response()->json("Password Not Matched", 422);
        }
    }
}
