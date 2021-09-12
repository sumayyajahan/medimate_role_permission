<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use Auth;

class UserOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $user;

    public function __construct()
    {
        // Auth::user() = Auth::user();
    }

    public function index()
    {
        $userOrders = UserOrder::where('user_id', Auth::user()->id)->with('otcProduct', 'ePrescription', 'reportPrescription')->get();
        return $this->jsonResponse($userOrders, "success");
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $delivery = 'N/A';
        $user_id = null;
        $service_by = null;
        if ($request->has('user_id')){
            $patient = User::where('id', $request->user_id)->first();
            $delivery = $patient->address;
            $user_id = $patient->id;
            $service_by = Auth::user()->serviceid;
        }
        else{
            $delivery = Auth::user()->address ?? 'N/A';
            $user_id = Auth::user()->id;
        }

        $userOrder = UserOrder::create(array_merge($request->all(), ['delivery_address' => $delivery, 'user_id' => $user_id, 'service_by' => $service_by]));
        $title = "Your Order is Placed.";
        $body = "Your Order is Placed at " .  $userOrder->pharmacy->name . "with Order Id " . $userOrder->id;


        FileHelper::userNotify($userOrder->user_id, $title, $body);
        FileHelper::pharmacyNotify($userOrder->pharmacy_id, "New Order", "Order from " . $userOrder->user->name . ". Order Id " . $userOrder->id);
        return $this->jsonResponse($userOrder, "Create Successful.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserOrder  $userOrder
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userOrder = $this->getUserOrder($id);
        return $this->jsonResponse($userOrder, "Success");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserOrder  $userOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $userOrder = $this->getUserOrder($id);
        $userOrder->update(array_merge($request->all(), ['user_id' => Auth::user()->id]));
        return $this->jsonResponse($userOrder, "Update Successful.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserOrder  $userOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userOrder = $this->getUserOrder($id);
        $userOrder->delete();
        return $this->jsonResponse("Deleted", "Delete Successful.");
    }


    public function getUserOrder($id)
    {
        $userOrder = UserOrder::where('id', $id)->where('user_id', Auth::user()->id)->first();
        if ($userOrder) {
            return $userOrder;
        } else {
            return abort(404);
        }
    }
}
