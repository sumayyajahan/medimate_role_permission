<?php

namespace App\Http\Controllers\Api\Pharmacy;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use Auth;

class UserOrderController extends Controller
{
    /**
     * get all orders
     *
     * @return Response
     */
    public function orders()
    {
        $orders = UserOrder::where('pharmacy_id', Auth::id())->whereIn('is_order',[1,7])->where('is_complete','!=', 1)->get();
        return $this->jsonResponse($orders, 'Success - Order List');
    }
    /**
     * get single Order
     *
     * @param  Request $request
     * @return Response
     */
    public function singleOrder(Request $request)
    {
        $this->validate($request, [
            'order_id' => 'required'
        ]);

        $order = UserOrder::where('id', $request->order_id)->with('user')->first();

        return $this->jsonResponse($order, 'Success - Single Order');
    }
    
    public function completeOrder(Request $request)
    {
        $this->validate($request, [
            'order_id' => 'required'
        ]);

        $order = UserOrder::findOrFail($request->order_id);
        $order->is_complete = 1;
        $order->is_order = 2;
        $order->save();

        $title = "Your Order is Delivered.";
        $body = "Your Order has been delivered successfully at " . date('d/m/Y h:i:s a');


        FileHelper::userNotify($order->user_id, $title, $body);
        FileHelper::pharmacyNotify($order->pharmacy_id, $title, $body);

        return $this->jsonResponse($order, 'Success - Complete Order');
    }
    public function acceptOrder(Request $request)
    {
        $this->validate($request, [
            'order_id' => 'required'
        ]);

        $order = UserOrder::findOrFail($request->order_id);
        $order->is_accept_user = 1;
        $order->save();
        $title = "Order Accepted.";
        $body = "Order accept successful.";
        FileHelper::userNotify($order->user_id, $title, $body);
        FileHelper::pharmacyNotify($order->pharmacy_id, $title, $body);

        return $this->jsonResponse($order, 'Success - Order Accepted');
    }
    public function rejectOrder(Request $request)
    {
        $this->validate($request, [
            'order_id' => 'required'
        ]);

        $order = UserOrder::findOrFail($request->order_id);
        $order->is_accept_user = 9;
        $order->is_complete = 9;
        $order->is_order = 9;
        $order->save();
        $title = "Order cancel.";
        $body = "Order has been cancelled.";
        FileHelper::userNotify($order->user_id, $title, $body);
        FileHelper::pharmacyNotify($order->pharmacy_id, $title, $body);
        return $this->jsonResponse($order, 'Order Rejected');
    }
    public function viewCompleteOrders()
    {
        $orders = UserOrder::where('pharmacy_id', Auth::id())->where('is_complete', 1)->with('user')->get();
        return $this->jsonResponse($orders, 'Success - Complete Order List');
    }

    public function updateOrderPrice(Request $request){
        $this->validate($request, [
            'order_id' => 'required',
            'amount' => 'required'
        ]);

        $order = UserOrder::where('order_id',$request->order_id)->where('pharmacy_id', Auth::id())->where('is_accept_user', 1)->get();
        $order->amount = floatval($request->amount);
        $order->save();
        return $this->jsonResponse($order, 'Success - Order Amount Added');
    }
}
