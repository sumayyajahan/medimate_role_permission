<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


use phpDocumentor\Reflection\Types\AbstractList;
use Spatie\Activitylog\Traits\LogsActivity;

class InsurancePackage extends Model
{

    use LogsActivity;

    protected $fillable = [
        'insurance_id',
        'admin_id',
        'type',
        'name',
        'amount',
        'duration',
        'video_call',
        'diagnostic_discount',
        'hospital_discount',
        'insurance',
        'emergency_medical',
        'hospitalization',
        'accidental_death',
        'terms_url',
        'point_per_call',
    ];

    protected $casts = [
        'insurance_id' => 'int',
        'admin_id' => 'int',
        'amount' => 'float',
        'duration' => 'int',
    ];

    protected static $logFillable = true;

    public function admin()
    {
        return $this->belongsTo(Admin::class)->select('name', 'id');
    }
    public function insurance()
    {
        return $this->belongsTo(Insurance::class, 'insurance_id', 'id');
//        return $this->belongsTo(Insurance::class)->select('name', 'id');
    }


    public static function get_package_benefits($id, $expiry=null)
    {
        $pack = InsurancePackage::find($id);
        $duration = '';
        if($expiry != null){
            $duration = $expiry;
        }else{
            $duration = $pack->duration. ' Months';
        }

        $details = <<<EOD
<table style='font-family:"Century Gothic", Courier'>
<tr>
<th>
Package
</th>
<th>
Validity
</th>
</tr>
<tr>
<td>
$pack->name
</td>
<td>
$duration
</td>
</tr>
</table>
<p><b>Benefits/Coverage</b></p>
<p><b>Consultation</b></p><p>
EOD;
        if ($pack->video_call !=null){
            $details .= <<<EOD
- $pack->video_call Video call per month <br>
EOD;
        }
        if ($pack->diagnostic_discount  !=null){
            $details .= <<<EOD
- $pack->diagnostic_discount % Off Diagnostic Services <br>
EOD;
        }

        if ($pack->hospital_discount  !=null){
            $details .= <<<EOD
- $pack->hospital_discount % Off Hospital Services <br>
EOD;
        }

        $details .= <<<EOD
</p>
<p><b>Health Coverage</b></p><p>
EOD;

        if ($pack->insurance  !=null){
            $details .= <<<EOD
- BDT $pack->insurance Life Insurance Coverage <br>
EOD;
        }

        if ($pack->emergency_medical  !=null){
            $details .= <<<EOD
- BDT $pack->emergency_medical for Emergency Medical Care (Anual) <br>
EOD;
        }

        if ($pack->hospitalization  !=null){
            $details .= <<<EOD
- BDT $pack->hospitalization for Hospitalization <br>
EOD;
        }


        if ($pack->accidental_death  !=null){
            $details .= <<<EOD
- $pack->accidental_death<br>
EOD;
        }

        $details .= <<<EOD
</p>
<p><b>Premium</b></p>
<p> $pack->amount Taka per month </p>
EOD;

        return $details;
    }

}
