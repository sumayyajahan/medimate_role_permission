<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserOrder;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    public function pending(){

        $orders = UserOrder::whereIn('is_order', [1,7])->where('is_complete','!=',1)->get();
        return view('admin.manage-p-order',compact('orders'));

    }

    public function delivered(){

        $orders = UserOrder::where('is_complete',1)->get();
        return view('admin.manage-d-order',compact('orders'));

    }

    public function rejected()
    {
        $orders = UserOrder::where('is_accept_user', 9)->orWhere('is_order', 9)->orWhere('is_complete', 9)->get();
        return view('admin.manage-rej-order', compact('orders'));
    }

    public function approved()
    {
        $orders = UserOrder::where('is_accept_user', 1)->get();
        return view('admin.manage-apv-order', compact('orders'));
    }
}
