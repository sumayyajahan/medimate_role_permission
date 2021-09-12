<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class BulkReschedule extends Model
{
    use LogsActivity, SoftDeletes;

    protected $fillable = [''];

    protected static $logFillable = true;

    protected $casts = [
        'appointment_schedule_id' => 'int',
        'doctor_id' => 'int',
    ];
}
