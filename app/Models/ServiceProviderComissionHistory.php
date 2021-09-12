<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class ServiceProviderComissionHistory extends Model
{

    use LogsActivity, SoftDeletes;

    protected $fillable = [
        'service_provider_id',
        'user_id',
        'type',
        'recharge_amount',
        'comission_amount',
        'comission_percentage',
    ];

    protected $casts = [
        'service_provider_id' => 'int',
        'user_id' => 'int',
        'recharge_amount' => 'float',
        'comission_amount' => 'float',
        'comission_percentage' => 'int',
    ];

    protected static $logFillable = true;

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
