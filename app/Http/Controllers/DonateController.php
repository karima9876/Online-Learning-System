<?php

namespace App\Http\Controllers;
use App\Library\SslCommerz\SslCommerzNotification;
use App\User;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonateController extends Controller
{
    public function studentlist(){
        $users =User::orderBy('id','DESC')->role('student')->get();
        return view('donate.studentlist',compact('users'));
    }
    public function donate($id){
        $user =User::where('id', $id)->role('student')->first();
        return view('donate.donate',compact('user'));
    }

    public function donatePayment(Request $request,$id){
        //dd($request->all());
        $validator = \Validator::make($request->all(),[
            'sender_name'=>'required',
            'sender_address'=>'required',
            'sender_email'=>'required',
            'sender_cnumber'=>'required',
            'amount'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error_message','Unsuccessful,Please Fill All Field')
                ->withInput();
        }
        $user_info = User::where('id',$id)->first();
        if(!empty($request->payment_type) && $request->payment_type=='on') {
            $payment_type = 1;
        } else{
            $payment_type = 0;
        }

        $post_data = array();
        $post_data['total_amount'] = $request->amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $request->sender_name;
        $post_data['cus_email'] = $request->sender_email;
        $post_data['cus_add1'] = $request->sender_address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $request->sender_cnumber;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = $user_info->username;
        $post_data['ship_add1'] = $user_info->address;
        $post_data['ship_add2'] = "";
        $post_data['ship_city'] = "";
        $post_data['ship_state'] = "";
        $post_data['ship_postcode'] = "";
        $post_data['ship_phone'] = $user_info->cnumber;
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = $user_info->username;
        $post_data['product_category'] = "Donation";
        $post_data['product_profile'] = "student_donation";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "student id ".$user_info->student_id;
        $post_data['value_b'] = "";
        $post_data['value_c'] = "";
        $post_data['value_d'] = "";
        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('payments')
            ->where('txn_id', $post_data['tran_id'])
            ->updateOrInsert([
                'user_id' => $id,
                'student_id' => $user_info->student_id,
                'sender_name' => $post_data['cus_name'],
                'sender_email' => $post_data['cus_email'],
                'sender_cnumber' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'payment_type' => $payment_type,
                'sender_address' => $post_data['cus_add1'],
                'txn_id' => $post_data['tran_id'],
            ]);
        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function successPayment(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $sslc = new SslCommerzNotification();
        #Check order status in order tabel against the transaction id or order id.
        $order_detials = Payment::where('txn_id', $tran_id)->first();
        $order_detials->message_id = json_encode($request->all());
        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $order_detials->status = 'Processing';
                $user_info = User::where('id', $order_detials->user_id)->first();
                $user_info->balance = $user_info->balance + $amount;
                $user_info->save();
                $msg = "Payment is successfully Completed";
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            $msg = "Payment is successfully Completed";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            $msg = "Invalid Payment";
        }
        $order_detials->save();
        return redirect()->to('donate/'. $order_detials->user_id)->with('success_message', $msg);
    }

    public function failPayment(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $order_detials = Payment::where('txn_id', $tran_id)->first();
        $order_detials->message_id = json_encode($request->all());
        if ($order_detials->status == 'Pending') {
            $order_detials->status = 'Failed';
            $msg = "Payment is Falied";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            $msg = "Payment is already Successful";
        } else {
            $msg = "Payment is Invalid";
        }
        $order_detials->save();
        return redirect()->to('donate/'. $order_detials->user_id)->with('error_message', $msg);
    }

    public function cancelPayment(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = Payment::where('txn_id', $tran_id)->first();
        $order_detials->message_id = json_encode($request->all());
        if ($order_detials->status == 'Pending') {
            $order_detials->status = 'Canceled';
            $msg = "Payment is Cancelled";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            $msg = "Payment is already Successful";
        } else {
            $msg = "Payment is Invalid";
        }
        $order_detials->save();
        return redirect()->to('donate/'. $order_detials->user_id)->with('error_message', $msg);
    }
}
