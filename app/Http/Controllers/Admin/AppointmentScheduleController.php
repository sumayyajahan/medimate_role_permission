<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\AppointmentSchedule;
use App\Http\Requests\AppointmentScheduleRequest;
use App\Models\AppointmentSlot;
use App\Models\Doctor;
use App\Models\User;

class AppointmentScheduleController extends Controller
{
    public function index()
    {
        $appointmentSchedules = AppointmentSchedule::orderBy('doctor_id')->with('doctor', 'user', 'appointmentSlot')->get();
        return view('admin.appointment_schedules', compact('appointmentSchedules'));
    }


    public function create()
    {
        $doctors = Doctor::doctors();
        $users = User::users();
        return view('admin.appointment_schedule_create', compact('doctors', 'users'));
    }


    public function store(AppointmentScheduleRequest $request)
    {
        // return $request->all();
        $request->merge([
            'active' => 7
        ]);
        $data = AppointmentSchedule::create($request->all());
        $body = "Appointment Created For " . $data->doctor->name . " At " . $data->date . " Scheduled at " . $data->appointmentSlot->start_time;
        $bodyU = "Appointment Created For " . $data->user->name . " At " . $data->date . " Scheduled at " . $data->appointmentSlot->start_time;
        FileHelper::userNotify($request->user_id, "Appointment Created", $body);
        FileHelper::doctorNotify($request->doctor_id, "Appointment Created", $bodyU);
        return back()->with('success', 'Successfully Created');
    }


    public function show(AppointmentSchedule $appointmentSchedule)
    {
        return view('admin.appointment_schedule_show', compact('appointmentSchedule'));
    }


    public function edit(AppointmentSchedule $appointmentSchedule)
    {
        $doctors = Doctor::doctors();
        $users = User::users();
        return view('admin.appointment_schedule_edit', compact('appointmentSchedule', 'doctors', 'users'));
    }


    public function update(AppointmentSchedule $appointmentSchedule, AppointmentScheduleRequest $request)
    {

        $appointmentSchedule->fill($request->all())->save();
        return back()->with('success', 'Successfully Updated.');
    }


    public function destroy(AppointmentSchedule $appointmentSchedule)
    {
        $appointmentSchedule->delete();
        return back()->with('success', 'Successfully Deleted.');
    }


    /**
     * show ing upcoming appointments
     *
     *  @return \Illuminate\Http\Response
     */
    public function upcoming()
    {
        $appointmentSchedules = AppointmentSchedule::where('date', '>=', date('Y-m-d'))->with('doctor', 'user', 'appointmentSlot')->get();
        return view('admin.appointment_schedule_upcoming', compact('appointmentSchedules'));
    }

    public function previous()
    {
        $appointmentSchedules = AppointmentSchedule::where('date', '<', date('Y-m-d'))->with('doctor', 'user', 'appointmentSlot')->get();
        return view('admin.appointment_schedule_previous', compact('appointmentSchedules'));
    }

    public function updateReschedule(AppointmentSchedule $appointmentSchedule)
    {
        $appointmentSchedule->active = 0;
        $appointmentSchedule->reschedule = 12;
        $appointmentSchedule->save();

        $doctors = Doctor::doctorsRe($appointmentSchedule->user_id);
        $users = User::usersRe($appointmentSchedule->doctor_id);
        // return view('admin.appointment_schedule_reschedule', compact('appointmentSchedule', 'doctors', 'users'));
        return view('admin.appointment_schedule_create', compact('doctors', 'users'));
    }

    public function cancelReschedule(AppointmentSchedule $appointmentSchedule)
    {
        $appointmentSchedule->reschedule = 30;
        $appointmentSchedule->save();
        return redirect()->route('admin.appointment-schedule.reschedule');
    }

    public function approveReschedule(AppointmentSchedule $appointmentSchedule)
    {
        $appointmentSchedule->active = 0;
        $appointmentSchedule->reschedule = 11;
        $appointmentSchedule->save();

        $newAppointmentSchedule = new AppointmentSchedule;

        $newAppointmentSchedule->user_id = $appointmentSchedule->user_id;
        $newAppointmentSchedule->doctor_id = $appointmentSchedule->doctor_id;
        $newAppointmentSchedule->appointment_slot_id = $appointmentSchedule->reschedule_slot_id;
        $newAppointmentSchedule->date = $appointmentSchedule->reschedule_date;
        $newAppointmentSchedule->save();

        return redirect()->route('admin.appointment-schedule.show', $newAppointmentSchedule->id);
    }


    /**
     * showing reschedules
     *
     *@return \Illuminate\Http\Response
     */
    public function reschedule()
    {
        $appointmentSchedules = AppointmentSchedule::where('reschedule', 10)->with('doctor', 'user', 'appointmentSlot', 'reAppointmentSlot')->get();
        return view('admin.appointment_reschedule', compact('appointmentSchedules'));
    }

    public function rescheduleForCancel()
    {
        $appointmentSchedules = AppointmentSchedule::where('reschedule', 20)->with('doctor', 'user', 'appointmentSlot')->get();
        return view('admin.appointment_reschedule_cancel', compact('appointmentSchedules'));
    }
}

/**
 * Reschedule -> 0 -> Not requested for Rescheduled
 *
 * Reschedule -> 10 -> Requested for Rescheduled to a particular Date & Time
 * Reschedule -> 11 -> Reschedule to the Date (Doctor assigned) Accepted by user
 * Reschedule -> 12 -> Reschedule to a Completely New Date (User assigned) {New Appointment}
 *
 * Reschedule -> 20 -> Requested for Cancel the Appointment
 *
 * Reschedule -> 30 -> USER Cancel the Appointment {either upon by doctor or user preference}
 *
 * If the user need the appointment rather than the doctor's preferable time slot OR
 *      Need Another doctor, Admin will set the Appointment on behalf of USER from admin Panel (Reschedule Code - 30)
 *
 */
