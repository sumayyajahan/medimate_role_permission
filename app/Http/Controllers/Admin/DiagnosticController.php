<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Diagnostic;
use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;

class DiagnosticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = Diagnostic::all();
        return view('admin.diagnostic.index', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = Division::select('name', 'id')->orderBy('name', 'ASC')->get();
        return view('admin.diagnostic.create', compact('districts'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        try {
            Diagnostic::create($input);
            return redirect()->route('admin.diagnostic.index')->with('success', 'Created Successfully');
        }
        catch (\Exception $exception){
            return redirect()->route('admin.diagnostic.index')->with('error', $exception->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content = Diagnostic::findOrFail($id);
        $districts = Division::where('id', '!=', $content->district_id)
            ->select('name', 'id')->orderBy('name', 'ASC')->get();
        return view('admin.diagnostic.edit', compact('content', 'districts'));
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
        $input = $request->all();
        $content = Diagnostic::findOrFail($id);
        $content->update($input);

        return redirect()->route('admin.diagnostic.index')->with('success', 'Edited Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $content = Diagnostic::findOrFail($id);
        $content->delete();
        return back()->with('success', 'Successfully Deleted');
    }
}
