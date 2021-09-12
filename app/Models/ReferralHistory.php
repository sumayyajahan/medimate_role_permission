<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class ReferralHistory extends Model
{

    use LogsActivity, SoftDeletes;

    protected $fillable = [
        'user_id',
        'user_refer_by',
        'doctor_id',
        'doctor_refer_by',
        'service_provider_id',
        'service_provider_refer_by',
    ];

    protected $casts = [
        'user_id' => 'int',
        'user_refer_by' => 'int',
        'doctor_id' => 'int',
        'doctor_refer_by' => 'int',
        'service_provider_id' => 'int',
        'service_provider_refer_by' => 'int',
    ];

    protected static $logFillable = true;

    public function userNew()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userOld()
    {
        return $this->belongsTo(User::class, 'user_refer_by');
    }

    public function user()
    {
        return $this->belongsTo(User::class)->select('id', 'userid', 'name');;
    }

    public function userRefer()
    {
        return $this->belongsTo(User::class, 'user_refer_by')->select('id', 'userid', 'name');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class)->select('id', 'doctorid', 'name');;
    }

    public function doctorRefer()
    {
        return $this->belongsTo(Doctor::class, 'doctor_refer_by')->select('id', 'doctorid', 'name');;
    }

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class)->select('id', 'serviceid', 'name');;
    }

    public function serviceProviderRefer()
    {
        return $this->belongsTo(ServiceProvider::class, 'service_provider_refer_by')->select('id', 'serviceid', 'name');;
    }
}
