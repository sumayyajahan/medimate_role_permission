<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use App\Http\Requests\InsuranceRequest;
use App\Helpers\FileHelper;
use Auth;

class InsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $insurances = Insurance::latest()->with('admin')->get();
        return view('admin.insurances', compact('insurances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.insurance_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InsuranceRequest $request)
    {

        $imageName = FileHelper::uploadImage($request);
        $insurance = Insurance::create(array_merge($request->all(), ['image' => $imageName, 'admin_id' => Auth::id()]));
        return back()->with('success', 'Successfully Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Insurance $insurance)
    {
        return view('admin.insurance_show', compact('insurance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Insurance $insurance)
    {
        return view('admin.insurance_edit', compact('insurance'));
    }

    /**
     *  the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InsuranceRequest $request, Insurance $insurance)
    {
        $imageName = FileHelper::uploadImage($request, $insurance);
        $insurance->fill(array_merge($request->all(), ['image' => $imageName]))->save();
        return back()->with('success', ' Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Insurance $insurance)
    {
        FileHelper::deleteImage($insurance);
        $insurance->delete();
        return back()->with('success', 'Successfully Deleted.');
    }
}
