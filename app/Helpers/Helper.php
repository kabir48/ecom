<?php

use App\CartModal;
use App\CurrencyConverter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\VisitorIp;
use Illuminate\Support\Facades\Log;

function totalCartIteams(){
    if(Auth::check()){
        $user_id=Auth::user()->id;
        $totalCartIteams=CartModal::where('user_id',$user_id)->sum('quantity');
    }else{
        $session_id=Session::get('session_id');
        $totalCartIteams=CartModal::where('session_id',$session_id)->sum('quantity');
    }
    return $totalCartIteams;
}

    function userCartItems(){
        if(Auth::check()){
            $userCartItems=CartModal::with(['product'=>function($query){
                $query->select('id','product_name','product_code','image_one','brand_id','product_color','product_name_bangla','selling_price','product_weight');
            }])->where('user_id',Auth::user()->id)->orderBy('id','DESC')->get()->toArray();

        }else{
          $userCartItems=CartModal::with(['product'=>function($query){
                $query->select('id','product_name','product_code','image_one','brand_id','product_color','product_name_bangla','selling_price','product_weight');
            }])->where('session_id',Session::get('session_id'))->orderBy('id','DESC')->get()->toArray();
        }
        return $userCartItems;
    }
    
    function getIp(){
        $clientIP = \Request::ip();
        $getIp=geoip()->getLocation($clientIP=null);
        return $getIp;
    }
    
    function currencyConvert(){
        $currencyConvert=CurrencyConverter::where('status',1)->first();
        return $currencyConvert;
    }
    
     function totalVisitor(){
         $totalVisitor=VisitorIp::count();
         return $totalVisitor;
    }
    
     function todayVisitor(){
        $toDay=Carbon::now()->format('Y-m-d');
        $todayVisitor=VisitorIp::where('date',$toDay)->count();
       return $todayVisitor;
    }
    
   
    
    function convertToBanglaNumber($number)
       {
        $englishNumbers = range(0, 9);
        $banglaNumbers = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];

        return str_replace($englishNumbers, $banglaNumbers, $number);
    }
    
    function pregName($pregName){
        $name=preg_replace('/\s+/', ' ', $pregName);
        return $name;
    }
       