<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Notification extends Model
{

    use LogsActivity, SoftDeletes;

    protected $fillable = [
        'user_id',
        'doctor_id',
        'pharmacy_id',
        'service_provider_id',
        'type',
        'title',
        'body',
    ];

    protected $casts = [
        'user_id' => 'int',
        'doctor_id' => 'int',
        'pharmacy_id' => 'int',
        'service_provider_id' => 'int',
    ];

    protected static $logFillable = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }
    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class, 'pharmacy_id', 'id');
    }
    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class, 'service_provider_id', 'id');
    }
}
