<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


use Spatie\Activitylog\Traits\LogsActivity;

class InsuranceEnroll extends Model
{

    use LogsActivity;

    protected $fillable = [
        'insurance_id',
        'insurance_package_id',
        'user_id',
        'type',
        'name',
        'date_of_birth',
        'gender',
        'marital_status',
        'nominee_name',
        'nominee_number',
        'nominee_relation',
        'nid_no',
        'nid_front',
        'nid_back',
        'comment',
        'status',
        'is_approved',
        'activation_date',
        'form_url',
    ];

    protected $casts = [
        'insurance_id' => 'int',
        'insurance_package_id' => 'int',
        'user_id' => 'int',
        'status' => 'int',
        'is_approved' => 'int',
    ];


    protected static $logFillable = true;

    public function insurance()
    {
        return $this->belongsTo(Insurance::class, 'insurance_id');
    }

    public function insurancePackage()
    {
        return $this->belongsTo(InsurancePackage::class, 'insurance_package_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
