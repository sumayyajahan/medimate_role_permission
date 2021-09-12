<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Specialization extends Model
{

    use LogsActivity;

    protected $guarded = [];
    protected static $logUnguarded = true;

    protected $casts = [
        'priority' => 'int',
        'status' => 'int',
    ];
}
