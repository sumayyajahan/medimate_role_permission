<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use App\Models\Admin;
use App\Http\Requests\PharmacyCreateRequest;
use App\Http\Requests\PharmacyUpdateRequest;
use App\Helpers\FileHelper;
use Auth;
use File;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pharmacies = Pharmacy::latest()->with('admin')->get();
        return view('admin.pharmacies', compact('pharmacies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pharmacy_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PharmacyCreateRequest $request)
    {

        $imageName = FileHelper::uploadImage($request);
        //$password = bcrypt($request->password);
        //$pharmaid = "MMPH" . date('ymdHis') . rand(10, 99);
        //$pharmacy = Pharmacy::create(array_merge($request->all(), ['image' => $imageName, 'admin_id' => Auth::id(), 'pharmaid'=> $pharmaid, 'password' => $password]));
        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        $input['pharmaid'] = "MMPH" . date('ymdHis') . rand(10, 99);
        $input['image']=$imageName;
        $input['admin_id'] = Admin::create([
            'name'=>$input['name'],
            'email'=>$input['email'],
            'mobile'=>$input['mobile'],
            'password'=>$input['password']
        ])->id;

        $pharmacy = Pharmacy::create($input);
        $pharmacy->save();


        return back()->with('success', 'Successfully Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pharmacy $pharmacy)
    {
        return view('admin.pharmacy_show', compact('pharmacy'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pharmacy $pharmacy)
    {
        return view('admin.pharmacy_edit', compact('pharmacy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PharmacyUpdateRequest $request, Pharmacy $pharmacy)
    {
        $imageName = FileHelper::uploadImage($request, $pharmacy);
        $pharmacy->fill(array_merge($request->all(), ['image' => $imageName]))->save();
        return back()->with('success', 'Update Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pharmacy $pharmacy)
    {
        // FileHelper::deleteImage($pharmacy);
        $pharmacy->delete();
        return back()->with('success', 'Successfully Deleted.');
    }


    public function trash()
    {
        $pharmacies = Pharmacy::onlyTrashed()->with('admin')->get();
        return view('admin.pharmacies_trash', compact('pharmacies'));
    }


    public function forceDelete($id)
    {
        $pharmacy = Pharmacy::withTrashed()->where('id', $id)->first();
        if (File::exists('images/' . $pharmacy->image)) {
            File::delete('images/' . $pharmacy->image);
        }
        $pharmacy->forceDelete();
        return back()->with('success', 'Permanent Delete Successfully.');
    }
}
