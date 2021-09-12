<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotificationForAll;
use Illuminate\Http\Request;

class AppNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = NotificationForAll::where('type', '=', 'app')->orderBy('id', 'DESC')->get();
        return view('admin.app_notify.index', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notify = NotificationForAll::where('type', '=', 'app')->latest()->first();
        if ($notify != null){
            $apple_build = $notify->apple_build;
            $android_build = $notify->build_number;
        }else{
            $apple_build = null;
            $android_build = null;
        }

        return view('admin.app_notify.create', compact('apple_build', 'android_build'));

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
        $input['type'] = 'app';
        try {
            NotificationForAll::create($input);
            return redirect()->route('admin.app-notify.index')->with('success', 'Created Successfully');
        }
        catch (\Exception $exception){
            return redirect()->route('admin.app-notify.index')->with('error', $exception->getMessage());
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
        $content = NotificationForAll::find($id);
        return view('admin.app_notify.edit', compact('content'));
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
        $content = NotificationForAll::findOrFail($id);
        $content->update($input);

        return redirect()->route('admin.app-notify.index')->with('success', 'Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $content = NotificationForAll::findOrFail($id);
        $content->delete();
        return back()->with('success', 'Successfully Deleted');
    }
}
