<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class EPrescription extends Model
{

      use LogsActivity, SoftDeletes;

      protected $fillable = [
            'user_id',
            'doctor_id',
            'appointment_schedule_id',
            'cc',
            'oe',
            'advice',
            'rx',
      ];

      protected $casts = [
          'user_id' => 'int',
          'doctor_id' => 'int',
          'appointment_schedule_id' => 'int',

      ];

      protected static $logFillable = true;

      public function user()
      {
            return $this->belongsTo(User::class);
      }
      public function doctor()
      {
            return $this->belongsTo(Doctor::class);
      }

      public function appointmentSchedule()
      {
            return $this->belongsTo(AppointmentSchedule::class);
      }
}
