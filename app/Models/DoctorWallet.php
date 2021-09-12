<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class DoctorWallet extends Model
{

    use LogsActivity, SoftDeletes;

    protected $fillable = ['doctor_id', 'balance'];

    protected $casts = [
        'doctor_id' => 'int',
        'balance' => 'float',
    ];

    protected static $logFillable = true;
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
