<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceProvider;
use App\Models\ServiceProviderComission;
use Illuminate\Http\Request;

class ComissionController extends Controller
{
    public function comissions()
    {
        $service_providers = ServiceProvider::all();
        return view('admin.comissions', compact('service_providers'));
    }

    public function update($id, Request $request)
    {
        $comission = ServiceProviderComission::findOrFail($id);
        $comission->amount = $request->amount;
        $comission->save();
        return back()->with('success', 'Update Successful.');
    }


    public function store(Request $request)
    {
        $comission = ServiceProviderComission::where('service_provider_id',$request->service_provider_id)->first();
        $comission->personal_recharge = $request->personal_recharge;
        $comission->patient_recharge = $request->patient_recharge;
        $comission->family_recharge = $request->family_recharge;
        $comission->save();
        return back()->with('success', 'Update Successful.');
    }

    public function ajax($id){
        $comission = ServiceProviderComission::where('service_provider_id', $id)->first();
        return $comission;

    }


}
