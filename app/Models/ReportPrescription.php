<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class ReportPrescription extends Model
{

    use LogsActivity, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'file',
        'ref_doctor',
    ];

    protected $casts = [
        'user_id' => 'int',
    ];

    protected static $logFillable = true;
}
