<?php

namespace App\Http\Controllers\Api;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return response()->json(['user' => $user],200);
    }

    public function update(UserUpdateRequest $request)
    {

        $user = Auth::user();
        $imageName = FileHelper::updateImage($request, $user);
        $user->fill(array_merge($request->all(), ['image' => $imageName]))->save();
        return response()->json(['user' => $user,'success' => true]);
    }

    public function destroy()
    {
        //
    }
}
