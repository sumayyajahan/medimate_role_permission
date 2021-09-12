<?php

namespace App\Helpers;



class AdminHelper
{        
    /**
     * middleware for authentication
     *
     * @param  Object $class
     * @return void
     */
    public static function middleware($class)
    {
        $class->middleware('preventBackHistory');
        $class->middleware('auth:admin');
    }

}