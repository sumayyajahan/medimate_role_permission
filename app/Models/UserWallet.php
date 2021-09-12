<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class UserWallet extends Model
{

    use LogsActivity, SoftDeletes;

    protected $fillable = ['user_id', 'balance'];

    protected $casts = [
        'user_id' => 'int',
        'balance' => 'float',
    ];


    protected static $logFillable = true;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
