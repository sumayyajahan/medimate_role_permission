<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class OtcProduct extends Model
{

    use LogsActivity, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'price' => 'float',
    ];
}
