<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClaimInsurance extends Model
{
    protected $table = 'claim_insurances';
    protected $fillable = [
        'enroll_id',
        'insurance_type',
        'claim_type',
        'member_id',
        'insured_name',
        'patient_name',
        'org_name',
        'org_mobile',
        'org_mobile_alt',
        'relation_with_insured',
        'hospital_name',
        'hospital_area',
        'admission_date',
        'discharge_date',
        'accommodation_charge',
        'doctor_fee',
        'test_cost',
        'medicine_cost',
        'surgical_cost',
        'ancillary_fee',
        'other_expenses',
        'discount',
        'claim_amount',
        'ac_name',
        'ac_no',
        'bank_name',
        'routing_number',
        'signature_employee',
        'signature_coordinator',
        'signature_officer',
        'is_checked',
    ];

    public static function has_claimed($enroll_id)
    {
        return ClaimInsurance::where('enroll_id', '=', $enroll_id)->exists();
    }

}
