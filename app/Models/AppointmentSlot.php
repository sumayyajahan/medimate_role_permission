<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
class AppointmentSlot extends Model
{
    use SoftDeletes,LogsActivity;
    protected $fillable = [
        'doctor_id',
        'start_time',
        'end_time',
        'day',
        'status',
        'time_slot',
    ];

    protected $casts = [
        'doctor_id' => 'int',
        'status' => 'int'
    ];

    public function getTimeSlotAttribute($value)
    {
        return unserialize($value);
    }


    protected static $logFillable = true;
    public function slot()
    {
        return $this->hasMany(AppointmentSchedule::class);
    }

    public function doctor()
    {
          return $this->belongsTo(Doctor::class);
    }
}
