<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class LoginActivity extends Model
{

    use LogsActivity;

    protected $fillable = [
        'login_user_id',
        'type',
        'start',
        'end',
    ];

    protected $casts = [
        'login_user_id' => 'int',
    ];

    protected static $logFillable = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'login_user_id', 'id');
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'login_user_id', 'id');
    }
}
