<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InsurancePackage;
use Auth;
use App\Http\Requests\InsurancePackageRequest;
use App\Models\Insurance;

class InsurancePackageController extends Controller
{

    public function index()
    {
        $insurancePackages = InsurancePackage::latest()->with('admin', 'insurance')->get();
        return view('admin.insurance_packages', compact('insurancePackages'));
    }


    public function create()
    {
        $insurances = Insurance::orderBy('name')->get();
        return view('admin.insurance_package_create', compact('insurances'));
    }

    
    public function store(InsurancePackageRequest $request)
    {
        InsurancePackage::create(array_merge($request->all(), ['admin_id' => Auth::id()]));
        return back()->with('success', 'Successfully Created');
    }


    public function show(InsurancePackage $insurancePackage)
    {
        return view('admin.insurance_package_show', compact('insurancePackage'));
    }


    public function edit(InsurancePackage $insurancePackage)
    {

        $insurances = Insurance::orderBy('name')->get();
        return view('admin.insurance_package_edit', compact('insurancePackage', 'insurances'));
    }


    public function update(InsurancePackage $insurancePackage, InsurancePackageRequest $request)
    {

        $insurancePackage->fill($request->all())->save();
        return back()->with('success', 'Successfully Updated.');
    }


    public function destroy(InsurancePackage $insurancePackage)
    {
        $insurancePackage->delete();
        return back()->with('success', 'Successfully Deleted.');
    }
}
