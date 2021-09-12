<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function jsonResponse($data,$message)
    {
        return response()->json(['message' => $message,'data' => $data]);
    }

    public function json2($report,$epres)
    {
        return response()->json(['report' => $report, 'epres' => $epres]);
    }

    public function checkExist($data)
    {

    }

    public function jsonRes($data,$status)
    {
        return response()->json(['data' => $data],$status);

    }
}
