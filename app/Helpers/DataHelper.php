<?php
/**
 * Created by Ariful Islam.
 * Organization : Pigeon Soft
 * Date: 05/06/2021
 * Time: 2:53 PM
 */


namespace App\Helpers;


use Carbon\Carbon;

class DataHelper
{
    public static function to_second($str_time)
    {
        $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);

        sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

        return $hours * 3600 + $minutes * 60 + $seconds;
    }

    public static function time_difference($from_time, $to_time)
    {
        $calc_date = Carbon::parse($from_time);
        $current_time = Carbon::parse($to_time);
        return $current_time->diffInMinutes($calc_date);
    }

    public static function insurance_status()
    {
        return array(
            0 => 'Applied',
            1 => 'Admin Accepted',
            2 => 'Admin Reject',
            3 => 'Pending',
            4 => 'Processing',
            5 => 'Company Rejected',
            6 => 'Active'
        );
    }

}
