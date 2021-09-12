<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Models\AppointmentSchedule;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class BulkRescheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        foreach (json_decode($request->id) as $id) {
            $schedule = AppointmentSchedule::findOrFail($id);
            $check = $schedule->update([
                "reschedule_date" => $request->reschedule_date,
                "reschedule_slot_id" => $request->reschedule_slot_id,
                "active" => 0,
                "consult" => 9,
                "reschedule" => 10
            ]);
        }

        return $this->jsonRes("Request Successful",202);

    }


    public function disable(Request $request)
    {

        foreach (json_decode($request->id) as $id) {
            $schedule = AppointmentSchedule::findOrFail($id);
            $schedule->update([
                "active" => 0,
                "consult" => 9,
                "reschedule" => 20
            ]);
        }

        return $this->jsonRes("Cancel Request Successful",202);

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
