<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class UserOrder extends Model
{

    use LogsActivity, SoftDeletes;

    protected $fillable = [
        'user_id',
        'pharmacy_id',
        'e_prescription_id',
        'prescription_product_name',
        'prescription_product_quantity',
        'otc_product_id',
        'otc_product_quantity',
        'state_tracking_id',
        'delivery_address',
        'payment_method',
        'amount',
        'is_accept_user',
        'is_order',
        'is_complete',
        'comment',
        'service_by',
    ];

    protected $casts = [
        'user_id' => 'int',
        'pharmacy_id' => 'int',
        'e_prescription_id' => 'int',
        'state_tracking_id' => 'int',
        'amount' => 'float',
        'is_accept_user' => 'int',
        'is_order' => 'int',
        'is_complete' => 'int',
    ];

    protected static $logFillable = true;

    public function otcProduct()
    {
        return $this->belongsTo(OtcProduct::class);
    }
    public function ePrescription()
    {
        return $this->belongsTo(EPrescription::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }

    public function state()
    {
        return $this->belongsTo(StateTracking::class, 'state_tracking_id');
    }
}
