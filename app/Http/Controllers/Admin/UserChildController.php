<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserChildController extends Controller
{    
    /**
     * get the child of a specific user
     *
     * @param  int $id
     * @return Response
     */
    public function child($id)
    {
        $childs = User::where('parent_id', $id)->get();
        return view('admin.user_child', compact('childs'));
    }
    public function create($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user_child_create', compact('user'));
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user_child_edit', compact('user'));
    }
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'mobile' => 'required|unique:users',
            'email' => 'nullable|unique:users'
        ]);
        $user = User::findOrFail($id);
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->parent_id = NULL;
        $user->save();
        Session::flash('success', 'Child Separated Successful.');
        return redirect()->route('admin.user.index');
    }
}
