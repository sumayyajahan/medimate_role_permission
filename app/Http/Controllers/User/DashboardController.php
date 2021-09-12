<?php

namespace App\Http\Controllers\User;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WalletTransactionLog;
use Illuminate\Support\Facades\Hash;
use Auth;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function ajaxTQ($id){
        $data = WalletTransactionLog::where('trx_id', $id)->first();
        return $data;
    }


}
