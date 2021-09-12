<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class ServiceProviderWallet extends Model
{

    use LogsActivity, SoftDeletes;

    protected $fillable = ['service_provider_id', 'balance'];

    protected $casts = [
        'service_provider_id' => 'int',
        'balance' => 'int',
    ];

    protected static $logFillable = true;

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
