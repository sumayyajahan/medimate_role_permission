<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Payment extends Model
{

    use LogsActivity, SoftDeletes;

    protected $guarded = [];
    protected static $logUnguarded = true;
}
