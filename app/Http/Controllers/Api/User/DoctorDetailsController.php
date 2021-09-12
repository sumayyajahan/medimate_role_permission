<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\AppointmentSchedule;
use App\Models\AppointmentSlot;
use App\Models\Doctor;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorDetailsController extends Controller
{
    public function doctorList()
    {
        $doctors = Doctor::where('status', 1)
            ->with('visitingFee')
            ->with('appointmentSlot')
            ->get();
        return $this->jsonResponse($doctors, "Success - Doctor List");
    }

    public function search_doctor($keyword)
    {
        $doctors = Doctor::where('status', 1)
            ->orWhere('name', 'LIKE', '%'.$keyword.'%')
            ->orWhere('bmdc_reg', 'LIKE', '%'.$keyword.'%')
            ->orWhere('department', 'LIKE', '%'.$keyword.'%')
            ->orWhere('degree', 'LIKE', '%'.$keyword.'%')
            ->orWhere('designation', 'LIKE', '%'.$keyword.'%')
            ->orWhere('specialization', 'LIKE', '%'.$keyword.'%')
            ->with('visitingFee')
            ->with('appointmentSlot')
            ->get();
        return $this->jsonResponse($doctors, "Success - Doctor List");
    }

    public function doctorSpecialty($type)
    {
        $doctors = Doctor::where('status', 1)
            ->where('specialization','like','%'. $type.'%')
            ->with('visitingFee')
            ->with('appointmentSlot')
            ->get();
        return $this->jsonResponse($doctors, "Success - Doctor List for " . $type);
    }

    public function doctorS($type)
    {
        return 1;
        $doctors = Doctor::where('specialization', $type)->get();
        return $this->jsonResponse($doctors, "Success - Doctor List for " . $type);
    }

    public function doctor($id)
    {
        $doctor = Doctor::Where('id', $id)->with('appointmentSlot')->get();
        if (count($doctor) > 0) {
            return $this->jsonResponse($doctor, "Success - Doctor Details with Slot.");
        } else {
            abort(404, "Not Found");
        }
    }

    public function available_time($doctor_id, $user_date)
    {

        $date = Carbon::parse($user_date);
        $day_name = Carbon::parse($date)->format('D');

        $schedules = AppointmentSlot::where('doctor_id', $doctor_id)
            ->where('day', '=', $day_name)
            ->where('status', 1)
            ->get();

        $time_slots = [];

        if(!empty($schedules)) {
            foreach ($schedules as $schedule) {
                $all_time_slots = $schedule->time_slot;
                $appointed_slot = AppointmentSchedule::where('doctor_id', $doctor_id)
                    ->whereDate('date', $date)
                    ->pluck('time')->toArray();

                foreach ($all_time_slots as $time_slot) {
                    $data = array(
                        'slot_no' => (integer)$time_slot['slot_no'],
                        'time_slot' => $time_slot['time_slot'],
                        'is_available' => !(in_array($time_slot['time_slot'], $appointed_slot) == true),
                        'selected' => false,
                    );
                    array_push($time_slots, $data);
                }
            }
        }

        return $this->jsonResponse($time_slots, "Success - Slot Details found.");

    }

    public function doctor7slot($id)
    {
        $slots = AppointmentSlot::Where('doctor_id', $id)->get();
        if (count($slots) > 0) {

            $day = $nextDay = $slotsForDay = [];

            foreach ($slots as $key => $slot) {
                $day[$key] = $slot->day;
            }

            $days = array_unique($day);


            // return $days;
            $date = date('Y-m-d'); //today date
            $weekOfdays = array();
            $date = new DateTime($date);
            $date->modify('-1 day');


            for ($i = 1; $i <= 7; $i++) {
                $date->modify('+1 day');
                if (in_array($date->format('D'), $days)) {
                    $weekOfdays[] = $date->format('Y-m-d');
                } else $i--;
            }

            // return($weekOfdays);

            foreach ($weekOfdays as $key => $d) {
                $nextDay = date('D', strtotime($d));
                $slotsForDay[$d] =  AppointmentSlot::Where('doctor_id', $id)->where('day', $nextDay)->where('status', 1)->get();
            }

            return $slotsForDay;
        } else {
            abort(404, "Not Found");
        }
    }


    public function doctor30slot()
    {
        $id = Auth::id();
        $slots = AppointmentSlot::Where('doctor_id', $id)->get();
        if (count($slots) > 0) {

            $day = $nextDay = $slotsForDay = [];

            foreach ($slots as $key => $slot) {
                $day[$key] = $slot->day;
            }

            $days = array_unique($day);


            // return $days;
            $date = date('Y-m-d'); //today date
            $weekOfdays = array();
            $date = new DateTime($date);
            $date->modify('-5 day');

            for ($i = 1; $i <= 30; $i++) {
                $date->modify('+1 day');
                if (in_array($date->format('D'), $days)) {
                    $weekOfdays[] = $date->format('Y-m-d');
                } else $i--;
            }

            // return($weekOfdays);

            foreach ($weekOfdays as $key => $d) {
                $nextDay = date('D', strtotime($d));
                $slotsForDay[$d] =  AppointmentSlot::Where('doctor_id', $id)->where('day', $nextDay)->where('status', 1)->get();
            }

            return $slotsForDay;
        } else {
            abort(404, "Not Found");
        }
    }
}
