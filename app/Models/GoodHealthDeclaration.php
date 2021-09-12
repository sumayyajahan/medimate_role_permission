<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodHealthDeclaration extends Model
{
    protected $table = 'good_health_declarations';
    protected $fillable = [
       'enroll_id',
       'employer_name',
       'policy_holder_name',
       'designation',
       'pf_no',
       'current_address',
       'date_of_birth',
       'sex',
       'marital_status',
       'no_children',
       'mobile_no',
       'dependents',
       'coverage_for',
       'maternity_benefit',
       'twelve_a',
       'twelve_b',
       'twelve_c',
       'twelve_d',
       'twelve_e',
       'twelve_f',
       'thirteen_a',
       'thirteen_b',
       'thirteen_c',
       'thirteen_d',
       'thirteen_e',
       'thirteen_f',
       'signature',
       'date',
    ];

    public static function has_declaration_form($enroll_id)
    {
        $form = GoodHealthDeclaration::where('enroll_id', '=', $enroll_id)->first();
        if ($form != null)
            return "<a href='".url('health-statement-details', $form->id)."' target='_blank'>Open Form</a>";
        else
            return 'Not Submitted';
    }

}
