<?php

namespace App\Http\Controllers\Payment;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;

use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\ServiceProvider;
use App\Models\ServiceProviderWallet;
use App\Models\User;
use App\Models\UserWallet;
use App\Models\WalletTransactionLog;

class SslCommerzPaymentController extends Controller
{
    
    /**
     * patient orecharge their wallet by sslcz
     *
     * @param  int $uid
     * @param  int $amount
     * @return void
     */
    public function recharge($uid, $amount)
    {
        $user = User::findOrFail($uid);

        $post_data = array();
        $post_data['total_amount'] = $amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $user->name;
        $post_data['cus_email'] = $user->email ?? 'No Email Found';
        $post_data['cus_add1'] = $user->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $user->mobile;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Medimate";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Service";
        $post_data['product_category'] = "Recharge";
        $post_data['product_profile'] = "Point Balance";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = $user->id;
        $post_data['value_b'] = $user->userid;
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "user";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('payments')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    /**
     * service provider recharge their wallet by sslcz
     *
     * @param  int $uid
     * @param  int $amount
     * @return void
     */
    public function serviceRecharge($uid, $amount)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.


        $user = ServiceProvider::findOrFail($uid);

        $post_data = array();
        $post_data['total_amount'] = $amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $user->name;
        $post_data['cus_email'] = $user->email ?? 'No Email Found';
        $post_data['cus_add1'] = $user->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $user->mobile;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Medimate";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Service";
        $post_data['product_category'] = "Recharge";
        $post_data['product_profile'] = "Point Balance";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = $user->id;
        $post_data['value_b'] = $user->serviceid;
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "service";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('payments')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    // 
    /**
     * payment success BOTH For Service and User    
     *
     * @param  Request $request
     * @return void
     */
    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $user_id = $request->input('value_a');
        $userOrservice = $request->input('value_d');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('payments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($tran_id, $amount, $currency, $request->all());

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('payments')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                $walletLog = new WalletTransactionLog();

                $body = $amount . " Points Added to your Account. Trx ID (SSLCommerz) - " . $walletLog->trx_id;

                if ($userOrservice == "user") {
                    $userWallet = UserWallet::where('user_id', $user_id)->first();
                    $userWallet->balance += floatval($amount);
                    $userWallet->save();
                    $walletLog->user_id = $user_id;

                    FileHelper::userNotify($user_id, "Balance Recharge Successful", $body);
                } elseif ($userOrservice == "service") {
                    $serviceWallet = ServiceProviderWallet::where('service_provider_id', $user_id)->first();
                    $serviceWallet->balance += floatval($amount);
                    $serviceWallet->save();
                    $walletLog->service_provider_id = $user_id;

                    FileHelper::serviceNotify($user_id, "Balance Recharge Successful", $body);
                }



                $walletLog->trx_id = $tran_id;
                $walletLog->type = "Point Recharge";
                $walletLog->amount = $amount;
                $walletLog->deposit = 1;
                $walletLog->payment_gateway = 'SSLCommerz';
                $walletLog->payment_note = $request->input('card_type');

                $walletLog->save();



                return view('payment.success');
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $update_product = DB::table('payments')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);
                echo "<br>validation Fail";
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            return view('payment.success');
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            return view('payment.fail');
        }
    }
    
    /**
     * Payment fail
     *
     * @param  Request $request
     * @return void
     */
    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('payments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('payments')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            return view('payment.fail');
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            return view('payment.success');
        } else {
            return view('payment.fail');
        }
    }
    
    /**
     * payment cancel
     *
     * @param  Request $request
     * @return void
     */
    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('payments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('payments')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            return view('payment.fail');
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            return view('payment.success');
        } else {
            return view('payment.fail');
        }
    }
}
