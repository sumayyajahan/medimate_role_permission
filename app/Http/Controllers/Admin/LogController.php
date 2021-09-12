<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{    
    /**
     * Showing logs
     *
     * @return Response
     */
    public function logs()
    {
         $logs = Activity::latest()->get();
        return view('admin.logs', compact('logs'));
    }
}
