<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    protected $table = 'ambulances';
    protected $fillable = [
        'name',
        'address',
        'phone',
        'district_id',
    ];

    protected $casts = [
        'district_id' => 'int'
    ];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'district_id', 'id');
    }
}
