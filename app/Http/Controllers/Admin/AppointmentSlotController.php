<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\DataHelper;
use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\AppointmentSlot;
use App\Http\Requests\AppointmentSlotRequest;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentSlotController extends Controller
{
    public function index()
    {
        $appointmentSlots = AppointmentSlot::with('doctor')->get();
        return view('admin.appointment_slots', compact('appointmentSlots'));
    }


    public function getSlot($id)
    {
        $appointmentSlots = AppointmentSlot::where('doctor_id', $id)->get();
        return $appointmentSlots;
    }


    public function create()
    {
        $doctors = Doctor::orderBy('name')->get();
        return view('admin.appointment_slot_create', compact('doctors'));
    }


    public function store(AppointmentSlotRequest $request)
    {
        // return $request->all();
        $i = $j = 0;
        foreach ($request->day as $day) {
            $app = AppointmentSlot::where('day', $day)
                ->where(function ($query) use ($request) {
                    $query->where('start_time', '<=', $request->start_time)->orWhere('start_time', '<=', $request->end_time);
                })
                ->where(function ($query) use ($request) {
                    $query->where('end_time', '>=', $request->start_time)->orWhere('end_time', '>=', $request->end_time);
                })
                ->where('doctor_id', $request->doctor_id)
                ->where('status', 1)->get();

            if (count($app) > 0) {
                $i++;
            } else {
                $j++;

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

                $appointmentSlot = AppointmentSlot::create(array_merge($request->all(), ['day' => $day, 'time_slot' => serialize($time_slots)]));
                FileHelper::doctorNotify($appointmentSlot->doctor_id, "Appointment Slot.", "Appointment slot created.");
            }
        }
        return back()->with('success', 'Successfully Created.' . $j . ' slots')->with('error', 'Duplication ' . $i . ' slots');
    }


    public function show(AppointmentSlot $appointmentSlot)
    {
        return view('admin.appointment_slot_show', compact('appointmentSlot'));
    }


    public function edit(AppointmentSlot $appointmentSlot)
    {

        $doctors = Doctor::orderBy('name')->get();
        return view('admin.appointment_slot_edit', compact('appointmentSlot', 'doctors'));
    }


    public function update(AppointmentSlot $appointmentSlot, AppointmentSlotRequest $request)
    {

        $appointmentSlot->fill($request->all())->save();
        return back()->with('success', 'Successfully Updated.');
    }


    public function destroy(AppointmentSlot $appointmentSlot)
    {
        $appointmentSlot->delete();
        return back()->with('success', 'Successfully Deleted.');
    }

    public function appointmentSlotByDoctor(Request $request)
    {
        $appointmentSlots = AppointmentSlot::where('doctor_id', $request->doctorId)->where('day', $request->day)->where('status', 1)->get();
        $result[] = "<option value=''>--Select Appointment Slot--</option>";
        if (count($appointmentSlots) > 0) {
            foreach ($appointmentSlots as $appointmentSlot) {
                $result[] = "<option value='" . $appointmentSlot->id . "'>" . $appointmentSlot->day . " - From " . date('h:i a', strtotime($appointmentSlot->start_time)) . " to " . date('h:i a', strtotime($appointmentSlot->end_time)) . "</option>";
            }
        } else {
            $result[] = "<option disabled value=''>No Slot Found</option>";
        }
        return $result;
    }

    /**
     * get the day of appointments
     *
     * @param  Request $request
     * @return array
     */
    public function appointmentSlotByDoctorGetDate(Request $request)
    {
        $appointmentSlots = AppointmentSlot::where('doctor_id', $request->doctorId)->where('status', 1)->get();

        if (count($appointmentSlots) > 0) {
            foreach ($appointmentSlots as $appointmentSlot) {
                $result[] = $appointmentSlot->day;
            }
        } else {
            $result[] = NULL;
        }
        return $result;
    }
}
