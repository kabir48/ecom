<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
            'brand_name', 'brand_logo'
        ];

         public function products(){
        return $this->hasMany('App\Product');
    }
    // public static function BrandDetails(){
    // 	$BrandDetails=Brand::select('id','brand_name','bangla_name')->where('select_type','Quickee')->orderBy('id','DESC')->get();
    //     //echo "<pre>";print_r($cateDetail);die;
    //         $BrandID=json_decode(json_encode($BrandDetails),true);
    //         return $BrandID;
    // }

    public static function brandDetail(){
        $brandDetail=Brand::select('id','brand_name','bangla_name','brand_logo','url')->orderBy('id','DESC')->where('status',1)->limit(12)->get();
       //echo "<pre>";print_r($cateDetail);die;
        $brandID=json_decode(json_encode($brandDetail),true);
        return $brandID;
    }

    public static function brandDetails($url){
        $brandDetails=Brand::select('id','brand_name','url','bangla_name')->where('url',$url)->first();
        $breadcumbs= '<a style="font-weight:600;color:#000;">'.$brandDetails['brand_name'].'</a>';
        
        $catIds=array();
        $catIds[]=$brandDetails['id'];
        //dd($catIds);die;
        return array('catIds'=>$catIds,'brandDetails'=>$brandDetails,'breadcumbs'=>$breadcumbs);
    }

}
