<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


use Spatie\Activitylog\Traits\LogsActivity;

class Feedback extends Model
{

    use LogsActivity;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'platform',
    ];

    protected $casts = [
        'platform' => 'int',
    ];

    protected static $logFillable = true;
}
