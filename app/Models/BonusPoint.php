<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BonusPoint extends Model
{
    protected $table = 'bonus_points';
    protected $fillable = [
        'user_id',
        'package_id',
        'start_date',
        'expire_date',
        'got_point',
        'balance',
        'call_left',
    ];

    public static function get_balance_point($user_id)
    {
        $today = Carbon::today();
        $bonus = BonusPoint::where('user_id', $user_id)
            ->whereDate('start_date', '<=', $today)
            ->whereDate('expire_date', '>=', $today)
            ->latest()->first();

        return $bonus;

    }

    public static function deduct_balance_point($user_id, $amount)
    {
        $today = Carbon::today();
        $bonus = BonusPoint::where('user_id', $user_id)
            ->whereDate('start_date', '<=', $today)
            ->whereDate('expire_date', '>=', $today)
            ->first();

        $bonus->balance = $bonus->balance - $amount;
        $bonus->call_left = $bonus->call_left - 1;
        $bonus->save();

//        $pkg_amount = InsurancePackage::find($bonus->package_id)->point_per_call;
//        if ($amount <= $pkg_amount){
//
//
//            return true;
//        }else
//        {
//            return false;
//        }

        return true;



    }

    public static function send_bonus_point($user_id, $package_id, $activate_date=null)
    {
        if ($activate_date == null)
            $activate_date = Carbon::today();

        $pack = InsurancePackage::find($package_id);
        $start_date = Carbon::parse($activate_date);
        $expire_date = Carbon::parse($activate_date)->addDays(29);
        $duration = (integer)$pack->duration;
        $point = ((integer)$pack->video_call)*((integer)$pack->point_per_call);

        for ($i=1; $i<=$duration; $i++){

            $item = array(
                'user_id' => $user_id,
                'package_id' => $package_id,
                'start_date' => $start_date,
                'expire_date' => $expire_date,
                'got_point' => $point,
                'balance' => $point,
                'call_left' => $pack->video_call,
            );

//            return $item;

            BonusPoint::create($item);
            $start_date = $expire_date->addDay();
            $expire_date = Carbon::parse($start_date)->addDays(29);
        }

        return true;

    }



}
