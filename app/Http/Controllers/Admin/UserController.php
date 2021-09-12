<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use File;
use Str;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Helpers\FileHelper;
use App\Models\UserWallet;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->with('admin')->get();
        return view('admin.users', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {

        $imageName = FileHelper::uploadImage($request);
        $password = bcrypt($request->password);
        $relationship = strtolower($request->relationship);
        $userId = "";
        if ($relationship == "pet") {
            $userId = "MMPT";
        } elseif ($relationship == "cattle") {
            $userId = "MMCT";
        } elseif ($relationship == "other") {
            $userId = "MMOT";
        } else {
            $userId = "MMPA";
        }
        $userId = $userId . date('ymdHis') . rand(10, 99);
        $user = User::create(array_merge($request->all(), ['image' => $imageName, 'admin_id' => Auth::id(), 'password' => $password, 'view_password' => $request->password, 'userid' => $userId]));
        $user->referral_code = CommonHelper::createReferralCode($request->name);
        $user->save();
        // return $user;

        UserWallet::create(['user_id' => $user->id]);
        return back()->with('success', 'Successfully Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.user_show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user_edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $imageName = FileHelper::uploadImage($request, $user);
        $user->fill(array_merge($request->all(), ['image' => $imageName]))->save();
        return back()->with('success', 'Update Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // if (File::exists('images/' . $user->image)) {
        //     File::delete('images/' . $user->image);
        // }
        $user->delete();
        return back()->with('success', 'Successfully Deleted.');
    }

    public function trash()
    {
        $users = User::onlyTrashed()->with('admin')->get();
        return view('admin.users_trash', compact('users'));
    }


    public function forceDelete($id)
    {
        $user = User::withTrashed()->where('id', $id)->first();
        if (File::exists('images/' . $user->image)) {
            File::delete('images/' . $user->image);
        }
        $user->forceDelete();
        return back()->with('success', 'Permanent Delete Successfully.');
    }

    public function search(Request $request )
    {
        $user = User::where('userid',$request->userid)->firstOrFail();
        return view('admin.user_show', compact('user'));
         
    }
}
