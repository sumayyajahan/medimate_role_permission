<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class BkashRechargeRequest extends Model
{
    use LogsActivity, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'user_id' => 'int',
        'is_recharged' => 'int',
        'service_provider_id' => 'int',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class, 'service_provider_id');
    }
}
