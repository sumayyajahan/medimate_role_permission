<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class WalletTransactionLog extends Model
{

    use LogsActivity, SoftDeletes;

    protected $fillable = [
        'trx_id',
        'user_id',
        'doctor_id',
        'service_provider_id',
        'type',
        'amount',
        'deposit',
        'payment_gateway',
        'payment_note',
    ];

    protected $casts = [
        'user_id' => 'int',
        'doctor_id' => 'int',
        'service_provider_id' => 'int',
        'amount' => 'float',
        'deposit' => 'int',
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


    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }



    public function appointmentSchedule()
    {
        return $this->belongsTo(AppointmentSchedule::class);
    }
}
