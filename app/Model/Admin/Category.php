<?php

namespace App\Model\Admin;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'id';


    // public static function categoried(){
    //     $getCategories=Category::with('subcategories')->get();
    //     $getCategories=json_decode(json_encode($getCategories),true);
    //     return $getCategories;
    // }

    // public function products()
    // {
    //     return $this->hasMany('App\Model\Admin\Category', 'section_id')->where(['parent_id' => 'ROOT', 'status' => 1])->with('subcategories');
    // }

    public function subcategories(){
        return $this->hasMany('App\Model\Admin\Category','parent_id')->where('status',1);
    }
    public function section(){
        return $this->belongsTo('App\Section','section_id')->select('id','name');
    }
    public function parentcategory(){
        return $this->belongsTo('App\Model\Admin\Category','parent_id')->select('id','category_name');
    }


// public static function categoryDetails($url){
//     $categoryDetails=Category::select('id','category_name','url')->with('subcategories')->where('url',$url)->first()->toArray();

//     dd($categoryDetails);die;
// }
    public static function mainCategory(){
        $categoryID=Category::with('subcategories')->where('status','1')->where('parent_id',0)->get();
        $categoryID=json_decode(json_encode($categoryID),true);
        return $categoryID;
    
    }

//uploder screen
//moon shell bypass ank valo kaj
//ceo@arenawebsecurity
//temperdata er age u.php file ta upload

    public static function cateDetails($url){
        $cateDetails=Category::select('id','parent_id','category_name','url','bangla_name','image','section_id','font','style')->with(['subcategories'=>function($query){
        $query->select('id','parent_id','url','bangla_name','category_name','image','font','style')->where('status',1);
        }])->where('url',$url)->where('status','1')->first()->toArray();
        if($cateDetails['parent_id']==0){
            //only show main Category in breadcumb
          $breadcumbs= '<a style="font-weight:600;color:#000;text-transform:uppercase" href="'.url('category-products',$cateDetails['url']).'">'.$cateDetails['category_name'].'</a>';
          $breadcumb='<a style="font-weight:600;color:#000;text-transform:uppercase" href="'.url('category-products',$cateDetails['url']).'">'.$cateDetails['bangla_name'].'</a>';
        }else{
            //show main and subcategory in Breadcumb
    
            $parentCategory=Category::select('category_name','url','image','bangla_name','section_id')->where('id',$cateDetails['parent_id'])->first()->toArray();
            $breadcumbs= '<a style="font-weight:600;color:#000;text-transform:uppercase" href="'.url('category-products',$parentCategory['url']).'">'.$parentCategory['category_name'] .'&nbsp;&nbsp'.'|'.'&nbsp;&nbsp'.$cateDetails['category_name'].'</a>';
            $breadcumb='<a style="font-weight:600;color:#000;text-transform:uppercase" href="'.url('category-products',$cateDetails['url']).'">'.$parentCategory['bangla_name'] .'&nbsp;&nbsp'.'|'.'&nbsp;&nbsp' .$cateDetails['bangla_name'].'</a>';
        }
    
        //dd($categoryDetails);die;
        $catIds=array();
        $catIds[]=$cateDetails['id'];
        foreach($cateDetails['subcategories'] as $key => $subcat){
            $catIds[]= $subcat['id'];
        }
        //dd($catIds);die;
        return array('catIds'=>$catIds,'cateDetails'=>$cateDetails,'breadcumbs'=>$breadcumbs,'breadcumb'=>$breadcumb);
    }


    public static function cateDetail(){
        $cateDetail=Category::select('id','parent_id','category_name','url','image','bangla_name','section_id','font','style','category_discount')->where('status',1)->where('parent_id',0)->orderBy('id','DESC')->limit(4)->get();
       //echo "<pre>";print_r($cateDetail);die;
        $categoryID=json_decode(json_encode($cateDetail),true);
        return $categoryID;
    }

    
    public static function ladycateDetails($url){
        $ladycateDetails=Category::select('id','parent_id','category_name','url','bangla_name')->with(['subcategories'=>function($query){
        $query->select('id','parent_id','url','bangla_name','category_name')->where('status',1);
        }])->where('url',$url)->where('select_kinds','Ladystore')->first()->toArray();
        if($ladycateDetails['parent_id']==0){
            //only show main Category in breadcumb
          $breadcumbs='<a style="margin-bottom: 8px;font-weight:600;color:#0B7CBB;" href="'.url('ladystore',$ladycateDetails['url']).'">'.$ladycateDetails['category_name'].'</a>';
          $breadcumb='<a style="margin-bottom: 8px;font-weight:600;color:#0B7CBB;" href="'.url('ladystore',$ladycateDetails['url']).'">'.$ladycateDetails['bangla_name'].'</a>';
        }else{
            //show main and subcategory in Breadcumb
            $parentCategory=Category::select('category_name','url','bangla_name')->where('id',$ladycateDetails['parent_id'])->first()->toArray();
            $breadcumbs='<a style="font-weight:600;color:#0B7CBB;" href="'.url('ladystore',$parentCategory['url']).'">'.$parentCategory['category_name'].'</a>&nbsp;<a href="'.url('ladystore',$ladycateDetails['url']).'">'.$ladycateDetails['category_name'].'</a>';
            $breadcumb='<a style="font-weight:600;color:#0B7CBB;" href="'.url('ladystore',$parentCategory['url']).'">'.$parentCategory['bangla_name'].'</a>&nbsp;<a href="'.url('ladystore',$ladycateDetails['url']).'">'.$ladycateDetails['bangla_name'].'</a>';
        }
    
        //dd($categoryDetails);die;
        $catIds=array();
        $catIds[]=$ladycateDetails['id'];
        foreach($ladycateDetails['subcategories'] as $key => $subcat){
            $catIds[]= $subcat['id'];
        }
        //dd($catIds);die;
        return array('catIds'=>$catIds,'ladycateDetails'=>$ladycateDetails,'breadcumbs'=>$breadcumbs,'breadcumb'=>$breadcumb);
    }
    
    public static function getCategoryName($category_id){
        $getCategoryName=Category::select('category_name')->where('id',$category_id)->first();
        return $getCategoryName->category_name;
    }

}
