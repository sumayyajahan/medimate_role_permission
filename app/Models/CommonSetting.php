<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class CommonSetting extends Model
{

    use LogsActivity;

    protected $guarded = [];
    protected static $logUnguarded = true;
}
