<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Cashout extends Model
{

    use LogsActivity, SoftDeletes;

    protected $fillable = ['doctor_id', 'amount', 'note', 'mobile', 'status'];
    protected $casts = [
        'doctor_id' => 'int',
        'status' => 'int',
    ];


    protected static $logFillable = true;
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
