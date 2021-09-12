<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\ServiceProvider;
use File;
use Str;
use App\Http\Requests\ServiceProviderCreateRequest;
use App\Http\Requests\ServiceProviderUpdateRequest;
use App\Helpers\FileHelper;
use App\Models\ServiceProviderComission;
use App\Models\ServiceProviderWallet;
use Auth;

class ServiceProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceProviders = ServiceProvider::latest()->with('admin')->get();
        return view('admin.service_providers', compact('serviceProviders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.service_provider_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceProviderCreateRequest $request)
    {

        $imageName = FileHelper::uploadImage($request);
        $password = bcrypt($request->password);
        $serviceProviderId = "MMSP" . date('ymdHis') . rand(10, 99);
        $serviceProvider = ServiceProvider::create(array_merge($request->all(), ['image' => $imageName, 'admin_id' => Auth::id(), 'password' => $password, 'serviceid' => $serviceProviderId]));
        // $referralCode = Str::slug($request->name) . "-" . $serviceProvider->id;
        $serviceProvider->referral_code = CommonHelper::createReferralCode($request->name);
        $serviceProvider->save();
        // return $serviceProvider;

        ServiceProviderWallet::create(['service_provider_id' => $serviceProvider->id]);
        ServiceProviderComission::create(['service_provider_id' => $serviceProvider->id]);
        return back()->with('success', 'Successfully Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceProvider $serviceProvider)
    {
        return view('admin.service_provider_show', compact('serviceProvider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceProvider $serviceProvider)
    {
        // return $serviceProvider;
        return view('admin.service_provider_edit', compact('serviceProvider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceProviderUpdateRequest $request, ServiceProvider $serviceProvider)
    {
        $imageName = FileHelper::uploadImage($request, $serviceProvider);
        $serviceProvider->fill(array_merge($request->all(), ['image' => $imageName]))->save();
        return back()->with('success', 'Update Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceProvider $serviceProvider)
    {
        // if (File::exists('images/' . $serviceProvider->image)) {
        //     File::delete('images/' . $serviceProvider->image);
        // }
        $serviceProvider->delete();
        return back()->with('success', 'Successfully Deleted.');
    }

    public function trash()
    {
        $serviceProviders = ServiceProvider::onlyTrashed()->with('admin')->get();
        return view('admin.service_providers_trash', compact('serviceProviders'));
    }


    public function forceDelete($id)
    {
        $serviceProviders = ServiceProvider::withTrashed()->where('id', $id)->first();
        if (File::exists('images/' . $serviceProviders->image)) {
            File::delete('images/' . $serviceProviders->image);
        }
        $serviceProviders->forceDelete();
        return back()->with('success', 'Permanent Delete Successfully.');
    }
}
