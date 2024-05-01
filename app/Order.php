<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
      public function products()
    {
        return $this->hasMany('App\OrderDetail','order_id','id');
    }
      public function shipping()
    {
        return $this->hasMany('App\ShippingAddress','order_id');
    }
     public function adminOrder()
    {
        return $this->belongsTo('App\DeliveryStuff','delivery_man');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    
    public static function getOrderDetails($order_id){
    	$getOrderDetails = Order::where('id',$order_id)->first();
    	return $getOrderDetails;
    }

}
