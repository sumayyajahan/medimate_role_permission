<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class AppointmentSchedule extends Model
{
    use LogsActivity, SoftDeletes;
    protected $fillable = [
        'user_id',
        'doctor_id',
        'appointment_slot_id',
        'date',
        'reschedule_date',
        'reschedule_slot_id',
        'active',
        'consult',
        'reschedule',
        'service_by',
        'is_emergency',
        'time_slot_no',
        'time'
    ];

    protected $casts = [
        'user_id' => 'int',
        'doctor_id' => 'int',
        'appointment_slot_id' => 'int',
        'active' => 'int',
        'consult' => 'int',
        'reschedule' => 'int',
        'time_slot_no' => 'int',
        'is_emergency' => 'boolean',
    ];


    protected static $logFillable = true;

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointmentSlot()
    {
        return $this->belongsTo(AppointmentSlot::class, 'appointment_slot_id');
    }
    public function appointmentSlotForNotification()
    {
        return $this->belongsTo(AppointmentSlot::class, 'appointment_slot_id')->where('start_time', '=', date('H:i', strtotime('+20 minutes', strtotime(now()))));
    }

    public function reAppointmentSlot()
    {
        return $this->belongsTo(AppointmentSlot::class, 'reschedule_slot_id');
    }
}
