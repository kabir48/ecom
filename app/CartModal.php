<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use Auth;
use Session;
use App\Product;

class CartModal extends Model
{
public static function userCartItems(){
        if(Auth::check()){
            $userCartItems=CartModal::with(['product'=>function($query){
                $query->select('id','product_name','product_code','image_one','product_name_bangla','selling_price','product_weight');
            }])->where('user_id',Auth::user()->id)->orderBy('id','DESC')->get()->toArray();

        }else{
          $userCartItems=CartModal::with(['product'=>function($query){
                $query->select('id','product_name','product_code','image_one','product_name_bangla','selling_price','product_weight');
            }])->where('session_id',Session::get('session_id'))->orderBy('id','DESC')->get()->toArray();
        }
        return $userCartItems;
    }
    public function product(){
        return $this->belongsTo('App\Product','product_id');
    }
    public static function getProductAttrPrice($product_id,$weight_size){
        $attrPrice=AttributeProduct::select('price')->where(['product_id'=>$product_id,'weight_size'=>$weight_size])->first()->toArray();
        return $attrPrice['price'];
    }

}
