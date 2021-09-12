<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


use Spatie\Activitylog\Traits\LogsActivity;

class ContactFeedback extends Model
{

    use LogsActivity;

    protected $fillable = ['name', 'phone', 'email', 'message', 'feedback'];

    protected $casts = [
        'platform' => 'int',
    ];
    protected static $logFillable = true;
}
