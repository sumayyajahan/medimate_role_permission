<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Image;
use File;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specializations = Specialization::all();
        return view('admin.specialization', compact('specializations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.specialization-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imageName = "";
        if ($request->hasFile('icon')) {

            $image = $request->file('icon');
            $imageName = 'specialization/' . time() . uniqid() . '.' . $image->getClientOriginalExtension();

            Image::make($image)->save($imageName);
        }
        Specialization::create(array_merge($request->all(), ['icon' => $imageName]));

        return redirect()->route('admin.specialization.index')->with('success', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $specialization = Specialization::findOrFail($id);
        return view('admin.specialization-edit', compact('specialization'));

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $specialization = Specialization::findOrFail($id);
        if ($request->hasFile('icon')) {
            $image = $request->file('icon');

            $image_Name = 'specialization/' . time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $imageName = ($specialization->icon == Null) ? $image_Name : $specialization->icon;

            Image::make($image)->save($imageName);
        }
        else{
            $imageName = $specialization->icon;
        }


        $specialization->name = $request->name;
        $specialization->priority = $request->priority;
        $specialization->icon = $imageName;
        $specialization->update();

        return redirect()->route('admin.specialization.index')->with('success', 'Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $specialization = Specialization::findOrFail($id);

        if (File::exists($specialization->icon)) File::delete($specialization->icon);
        $specialization->delete();

        return back()->with('success', 'Successfully Deleted');
    }
}
