<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use File;
use Image;
use Illuminate\Http\Request;



class ProfileController extends Controller
{

    public function profileView()
    {
        $user = Auth::user();
        return view('user.profile',compact('user'));
    }

    public function profileChange(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'name' => ['required', 'string', 'max:150'],
            'about' => ['nullable', 'string', 'max:65535'],
            'phone' => ['nullable'],
            'address' => ['nullable', 'string', 'max:150'],
            'image' => ['nullable', 'image','max:5000'],
        ]);

        $imageName = $user->image;
        if ($request->hasFile('image')) {
            if (File::exists('user_images/'.$user->image)) {
                File::delete('user_images/'.$user->image);
            }
            $image = $request->file('image');
            $imageName = time().uniqid().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(270, 340)->save('user_images/'.$imageName);
            $user->image = $imageName;
        }
        $user->fill(array_merge($request->all(), ['image' => $imageName]))->save();
        return back()->with('success', 'Update Successful.');

    }

     public function changePasswordView()
    {
        return view('user.change_password');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::find(Auth::id());
        if (Hash::check($request->oldpassword, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            return back()->with('success', 'Password Change Successful.');
        } else {
            return back()->with('error', 'Password Mismatch.');
        }
    }
}
