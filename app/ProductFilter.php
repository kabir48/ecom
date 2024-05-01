<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Admin\Category;
use App\Product;
use App\AttributeProduct;
use App\Section;
use App\Color;
use App\Model\Admin\Brand;

class ProductFilter extends Model
{
    use HasFactory;
    
     public static function getFilterName($filter_id){
        $getFilterName=ProductFilter::select('filter_name')->where('id',$filter_id)->first();
        return $getFilterName->filter_name;
    }
    
    public function filter_values(){
        return $this->hasMany('App\ProductFilterValue','filter_id');
    }
    
    public static function productFilters(){
        $productFilters=ProductFilter::with(['filter_values'])->where('status',1)->get()->toArray();
        //dd($productFilters);
        return $productFilters;
    }
    
    public static function filterAvailable($filter_id,$category_id){
        $filterAvailable=ProductFilter::select('category_id')->where(['id'=>$filter_id,'status'=>1])->first()->toArray();
        $catIdArray=explode(',',$filterAvailable['category_id']);
        if(in_array($category_id,$catIdArray)){
            $available='Yes';
        }else{
            $available='No';
        }
        return $available;
    }
    
    public static function getSizes($url){
        $categoryDetails=Category::cateDetails($url);
        
        $getProductIds=Product::select('id')->whereIn('category_id',$categoryDetails['catIds'])->pluck('id')->toArray();
        $getProductSizes=AttributeProduct::select('weight_size')->whereIn('product_id',$getProductIds)->groupBy('weight_size')->pluck('weight_size')->toArray();
        //echo "<pre>";print_r($getProductSizes);die;
        return $getProductSizes;
    }
    
    public static function getColors($url){
        $categoryDetails=Category::cateDetails($url);
        $getProductIds=Product::with('color')->select('id')->whereIn('category_id',$categoryDetails['catIds'])->pluck('id')->toArray();
        $getColors=Product::with('color')->select('family_color')->whereIn('id',$getProductIds)->groupBy('family_color')->pluck('family_color')->toArray();
        //echo "<pre>";print_r($getColors);die;
        return $getColors;
    }
    
     public static function getBrands($url){
        $categoryDetails=Category::cateDetails($url);
        $getProductIds=Product::with('color')->select('id')->whereIn('category_id',$categoryDetails['catIds'])->pluck('id')->toArray();
        $brandIds=Product::select('brand_id')->whereIn('id',$getProductIds)->groupBy('brand_id')->pluck('brand_id')->toArray();
        $brandDetails=Brand::select('id','brand_name')->whereIn('id',$brandIds)->get()->toArray();
        //echo "<pre>";print_r($getColors);die;
        return $brandDetails;
    }
    
        // ===brand url====
     public static function getBrandSizes($url){
        $brandDetails=Brand::brandDetails($url);
        $getProductIds=Product::select('id')->whereIn('brand_id',$brandDetails['catIds'])->pluck('id')->toArray();
        $getProductBrandSizes=AttributeProduct::select('weight_size')->whereIn('product_id',$getProductIds)->groupBy('weight_size')->pluck('weight_size')->toArray();
        //echo "<pre>";print_r($getProductSizes);die;
        return $getProductBrandSizes;
    }
    
    
    public static function getbrandColors($url){
        $brandDetails=Brand::brandDetails($url);
        $getProductIds=Product::select('id')->whereIn('brand_id',$brandDetails['catIds'])->pluck('id')->toArray();
        $getBrandColors=Product::with('color')->select('family_color')->whereIn('id',$getProductIds)->groupBy('family_color')->pluck('family_color')->toArray();
        //echo "<pre>";print_r($getColors);die;
        return $getBrandColors;
    }
    
    // ==section url====//
      public static function getSectionSizes($url){
        $sectionDetails=Section::sectionDetails($url);
        $getProductIds=Product::select('id')->whereIn('section_id',$sectionDetails['sectionIds'])->pluck('id')->toArray();
        $getProductSectionSizes=AttributeProduct::select('weight_size')->whereIn('product_id',$getProductIds)->groupBy('weight_size')->pluck('weight_size')->toArray();
        //echo "<pre>";print_r($getProductSizes);die;
        return $getProductSectionSizes;
    }
    
    public static function getSectionColors($url){
        $sectionDetails=Section::sectionDetails($url);
        $getProductIds=Product::select('id')->whereIn('section_id',$sectionDetails['sectionIds'])->pluck('id')->toArray();
        $getSectionColors=Product::with('color')->select('family_color')->whereIn('id',$getProductIds)->groupBy('family_color')->pluck('family_color')->toArray();
        //echo "<pre>";print_r($getColors);die;
        return $getSectionColors;
    }
    
     public static function getSectionBrands($url){
         $sectionDetails=Section::sectionDetails($url);
        $getProductIds=Product::with('color')->select('id')->whereIn('section_id',$sectionDetails['sectionIds'])->pluck('id')->toArray();
        $brandIds=Product::select('brand_id')->whereIn('id',$getProductIds)->groupBy('brand_id')->pluck('brand_id')->toArray();
        $brandSectionDetails=Brand::select('id','brand_name')->whereIn('id',$brandIds)->get()->toArray();
        //echo "<pre>";print_r($getColors);die;
        return $brandSectionDetails;
    }
    
}
