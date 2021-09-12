<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PharmacySalesman;
use App\Http\Requests\PharmacySalesmanCreateRequest;
use App\Http\Requests\PharmacySalesmanUpdateRequest;
use App\Helpers\FileHelper;
use App\Models\Pharmacy;
use Auth;

class PharmacySalesmanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pharmacySalesmans = PharmacySalesman::latest()->with('admin','pharmacy')->get();
        return view('admin.pharmacy_salesmans', compact('pharmacySalesmans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pharmacies = Pharmacy::orderBy('name')->get();
        return view('admin.pharmacy_salesman_create',compact('pharmacies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PharmacySalesmanCreateRequest $request)
    {

        $imageName = FileHelper::uploadImage($request);
        $password = bcrypt($request->password);
        $pharmacySalesman = PharmacySalesman::create(array_merge($request->all(), ['image' => $imageName, 'admin_id' => Auth::id(), 'password' => $password]));
        
        return back()->with('success', 'Successfully Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PharmacySalesman $pharmacySalesman)
    {

        $pharmacies = Pharmacy::orderBy('name')->get();
        return view('admin.pharmacy_salesman_show', compact('pharmacySalesman', 'pharmacies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PharmacySalesman $pharmacySalesman)
    {

        $pharmacies = Pharmacy::orderBy('name')->get();
        return view('admin.pharmacy_salesman_edit', compact('pharmacySalesman', 'pharmacies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PharmacySalesmanUpdateRequest $request, PharmacySalesman $pharmacySalesman)
    {
        $imageName = FileHelper::uploadImage($request, $pharmacySalesman);
        $pharmacySalesman->fill(array_merge($request->all(), ['image' => $imageName]))->save();
        return back()->with('success', 'Update Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PharmacySalesman $pharmacySalesman)
    {
        FileHelper::deleteImage($pharmacySalesman);
        $pharmacySalesman->delete();
        return back()->with('success', 'Successfully Deleted.');
    }
}
