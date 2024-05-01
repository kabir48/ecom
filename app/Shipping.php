<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public static function deliveryAddresses(){
        $user_id=Auth::user()->id;
        $deliveryAddresses = Shipping::where('user_id',$user_id)->get()->toArray();
        //dd($deliveryAddresses);
        return $deliveryAddresses;
    }

}
