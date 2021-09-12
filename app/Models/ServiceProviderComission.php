<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class ServiceProviderComission extends Model
{

    use LogsActivity, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'service_provider_id' => 'int',
        'personal_recharge' => 'int',
        'family_recharge' => 'int',
        'patient_recharge' => 'int',
    ];
}
