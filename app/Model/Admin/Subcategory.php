<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = [
            'catgory_id','subcategory_name',
        ];





    public function categories(){
    return $this->hasMany('App\Model\Admin\Subcategory','category_id')->where('status',1);
}


public static function cateDetails($url){
    $cateDetails=Subcategory::select('id','category_id','subcategory_name','url')->with(['categories'=>function($query){
$query->select('id','category_id','url','bangla_name')->where('status',1);
    }])->where('url',$url)->first()->toArray();
    if($cateDetails['category_id']==0){
      $breadcumbs='<a href="'.url($cateDetails['url']).'">'.$cateDetails['subcategory_name'].'</a>';
    }else{
        $parentCategory=Subcategory::select('subcategory_name','url')->where('id',$cateDetails['category_id'])->first()->toArray();
     $breadcumbs='<a href="'.url($parentCategory['url']).'">'.$parentCategory['subcategory_name'].'</a><a href="'.url($cateDetails['url']).'">'.$cateDetails['subcategory_name'].'</a>';
    }

    //dd($categoryDetails);die;
    $catIds=array();
    $catIds[]=$cateDetails['id'];
    foreach($cateDetails['categories'] as $key => $subcat){
        $catIds[]= $subcat['id'];
    }
    //dd($catIds);die;
    return array('catIds'=>$catIds,'cateDetails'=>$cateDetails,'breadcumbs'=>$breadcumbs);
}
}

// vido 76
