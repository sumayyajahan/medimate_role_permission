<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class DoctorVisitCharge extends Model
{

    use LogsActivity, SoftDeletes;

    protected $guarded = [];
    protected static $logUnguarded = true;

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    protected $casts = [
        'doctor_id' => 'int',
        'visit_charge' => 'float',
        'commission' => 'float',
    ];
}
