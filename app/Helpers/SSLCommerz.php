<?php

namespace App\Helpers;

use App\Order;
use App\SslcommerzAccount;
use Exception;
use Illuminate\Support\Facades\Http;

class SSLCommerz  
{

       public static function InitiatePayment($Profile, $payable, $tran_id, $user_email): array
    {
        try {
            $ssl = SslcommerzAccount::first();
            //dd($ssl);
            $response = Http::asForm()->post($ssl->init_url, [
                "store_id" => $ssl->store_id,
                "store_passwd" => $ssl->store_passwd,
                "total_amount" => $payable,
                "currency" => $ssl->currency,
                "tran_id" => $tran_id,
                "success_url" => "$ssl->success_url?tran_id=$tran_id",
                "fail_url" => "$ssl->fail_url?tran_id=$tran_id",
                "cancel_url" => "$ssl->cancel_url?tran_id=$tran_id",
                "ipn_url" => $ssl->ipn_url,
                "cus_name" => $Profile->name,
                "cus_email" => $user_email,
                "cus_postcode" => "1200",
                "shipping_method" => "YES",
                "ship_name" => $Profile->name,
                "ship_add1" => $Profile->phone,
                "ship_add2" => $Profile->address,
                "ship_city" => $Profile->country,
                "ship_postcode" => "12000",
                "product_amount" => $payable,
            ]);
            return $response->json(); // Return the entire JSON response as an array
        } catch (Exception $e) {
            // Log the exception or handle it accordingly
            return ['error' => $e->getMessage()]; // Return an error array
        }
    }


    static function InitiateSuccess($tran_id,$order_id):int{
      try {
            // Update the order payment status and val_id
            $updatedRows = Order::where([
                'blnc_transection' => $tran_id,
            ])->update([
                'payment_status' => 'success',
                'val_id' => 0
            ]);
    
            if ($updatedRows > 0) {
                return 1; // Return 1 for success
            } else {
                return -1; // Return -1 to indicate no changes
            }
        } catch (Exception $e) {
            Log::error('Error in InitiateIPN: ' . $e->getMessage());
            return 0; // Return 0 for failure
        }
    }

    static function InitiateFail($tran_id,$order_id):int{
        Order::where(['blnc_transection'=>$tran_id,'val_id'=>0,'id'=>$order_id])->update(['payment_status'=>'Fail']);
        return 1;
    }

    static function InitiateCancel($tran_id,$order_id):int{
        Order::where(['blnc_transection'=>$tran_id,'val_id'=>0,'id'=>$order_id])->update(['payment_status'=>'Cancel']);
        return 1;
    }

    static function InitiateIPN($tran_id,$status,$val_id,$order_id):int{
        try {
            // Update the order payment status and val_id
            $updatedRows = Order::where([
                'blnc_transection' => $tran_id,
                'val_id' => 0,
                'id' => $order_id
            ])->update([
                'payment_status' => $status,
                'val_id' => $val_id
            ]);
    
            if ($updatedRows > 0) {
                return 1; // Return 1 for success
            } else {
                return -1; // Return -1 to indicate no changes
            }
        } catch (Exception $e) {
            Log::error('Error in InitiateIPN: ' . $e->getMessage());
            return 0; // Return 0 for failure
        }
    }
}
