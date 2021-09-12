<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class Insurance extends Model
{

    use LogsActivity;

    protected $fillable = [
        'name',
        'contact_person_name',
        'contact_person_phone',
        'image',
        'admin_id',
        'status',
    ];

    protected $casts = [
        'admin_id' => 'int',
        'status' => 'int',
    ];

    protected static $logFillable = true;

    public function admin()
    {
        return $this->belongsTo(Admin::class)->select('name', 'id');
    }

    public static function get_name_by_id($id)
    {
        return Insurance::find($id)->name;
    }

}
