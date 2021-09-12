<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class DoctorSpecialization extends Model
{

    use LogsActivity, SoftDeletes;

    protected $fillable = ['doctor_id', 'specialization_id'];

    public $timestamps = False;

    protected static $logFillable = true;
    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    protected $casts = [
        'doctor_id' => 'int',
        'specialization_id' => 'int',

    ];
}
