<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Country;
class ShippingCharge extends Model
{
    public function countryName(){
        return $this->belongsTo('App\Country','country');
    }
    public static function getShippingCharges($total_selling,$country){
        $shippingDetail=ShippingCharge::where('country',$country)->first()->toArray();
        //echo "<pre>"; print_r($shippingDetail); die;
        if($total_selling>0){
        	 if($total_selling>0 && $total_selling<=500){
        	 	$shipping_charges=$shippingDetail['zero'];

        	 }
        	  else if($total_selling>501 && $total_selling<=1000){
        	 	$shipping_charges=$shippingDetail['fivehundred'];

        	 }  else if($total_selling>1001 && $total_selling<=1500){
        	 	$shipping_charges=$shippingDetail['onethousand'];

        	 }  else if($total_selling>1501 && $total_selling<=2000){
        	 	$shipping_charges=$shippingDetail['twothousand'];

        	 } else if($total_selling>2001){
        	 	$shipping_charges=$shippingDetail['above'];

        	 }else{
                $shipping_charges=0;
        	 }


        }else{
        	$shipping_charges=0;
        }
        return $shipping_charges;

    }
}
