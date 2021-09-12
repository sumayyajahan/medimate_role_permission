<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class NotificationForAll extends Model
{

    use LogsActivity;

    protected $fillable = [
        'type',
        'title',
        'body',
        'can_access_app',
        'build_number',
        'apple_build',
        'has_button',
        'button_text',
        'button_url',
        'expiry_date',
    ];

    protected $casts = [
        'can_access_app' => 'boolean',
        'has_button' => 'boolean',
        'expiry_date' => 'datetime',
    ];

    protected static $logFillable = true;
}
