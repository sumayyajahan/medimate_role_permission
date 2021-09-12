<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Helpers\DataHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AppointmentSlotRequest;
use App\Models\AppointmentSchedule;
use App\Models\AppointmentSlot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentSlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $doctor;

    public function __construct()
    {
        $this->doctor = Auth::user();
    }

    public function index()
    {
        $appointmentSlots = AppointmentSlot::where('doctor_id', $this->doctor->id)->get();
        return $this->jsonResponse($appointmentSlots, "success");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentSlotRequest $request)
    {

        foreach ($request->day as $day) {
            $app = AppointmentSlot::where('day', $day)
                ->where(function ($query) use ($request) {
                    $query->where('start_time', '<=', $request->start_time)->orWhere('start_time', '<=', $request->end_time);
                })
                ->where(function ($query) use ($request) {
                    $query->where('end_time', '>=', $request->start_time)->orWhere('end_time', '>=', $request->end_time);
                })
                ->where('doctor_id', Auth::id())
                ->where('status', 1)->get();

            if (count($app) > 0) {
            } else {

                // slot code start
                $start_time = $request->start_time;
                $end_time = $request->end_time;
                $per_patient_time = 10; // per patient 10 minutes
                $total_time = DataHelper::time_difference($start_time, $end_time);
                $total_slot = $total_time/$per_patient_time;

                $time_slots = [];


                for ($i=1; $i<=$total_slot; $i++){
                    $item = array(
                        'slot_no' => $i,
                        'time_slot' => Carbon::parse($start_time)->format('h:i A')
                    );

                    array_push($time_slots, $item);
                    $start_time = Carbon::parse($start_time)->addMinutes($per_patient_time);
                }
                // slot code end

                AppointmentSlot::create(array_merge($request->all(), ['doctor_id' => Auth::id(), 'day' => $day, 'time_slot' => serialize($time_slots)]));
            }
        }

        return $this->jsonRes("Success", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppointmentSlot  $appointmentSlot
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointmentSlot = AppointmentSlot::findOrFail($id);
        return $this->jsonResponse($appointmentSlot, "success");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppointmentSlot  $appointmentSlot
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentSlotRequest $request, $id)
    {
        $appointmentSlot = AppointmentSlot::findOrFail($id);
        $appointmentSlot->update(array_merge($request->all(), ['doctor_id' => $this->doctor->id]));
        return $this->jsonResponse($appointmentSlot, "success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppointmentSlot  $appointmentSlot
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointmentSlot = AppointmentSlot::findOrFail($id);
        $appointmentSlot->delete();
        return $this->jsonResponse("Deleted", "success");
    }

    public function disable($id)
    {
        $appointmentSlot = AppointmentSlot::findOrFail($id);
        $appointmentSlot->status = 0;
        $appointmentSlot->save();
        return $this->jsonResponse($appointmentSlot, "Disabled.");
    }

    /**
     * get the users of an specific appointment slot
     *
     * @param  Request $request
     * @return Response
     */
    public function userByAppointmentSlot(Request $request)
    {
        $appointmentSchedule = AppointmentSchedule::where('doctor_id', auth()->id())->where('appointment_slot_id', $request->appointment_slot_id)->with('user')->get();
        return $this->jsonResponse($appointmentSchedule, "Success.");
    }
}
