<?php

namespace App\Http\Controllers\Api\Salesman;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreckRequest;
use App\Http\Requests\Api\UserProfileCreateRequest;
use App\Http\Requests\Api\UserProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function profile() {
        $user = Auth::user();
        return $this->jsonResponse($user,"success");
    }

    public function update(UserProfileUpdateRequest $request)
    {
        $user = Auth::user();
        $imageName = FileHelper::uploadImage($request, $user);
        $user->fill(array_merge($request->all(), ['image' => $imageName]))->save();
        return $this->jsonResponse($user, "success");
    }

}
