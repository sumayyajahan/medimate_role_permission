<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralPoint extends Model
{
    protected $fillable = [
        'user_refer_to',
        'user_refer_by',
        'doctor_refer_to',
        'doctor_refer_by',
        'service_refer_to',
        'service_refer_by',
    ];

    protected $casts = [
        'user_refer_to' => 'int',
        'user_refer_by' => 'int',
        'doctor_refer_to' => 'int',
        'doctor_refer_by' => 'int',
        'service_refer_to' => 'int',
        'service_refer_by' => 'int',
    ];
}
