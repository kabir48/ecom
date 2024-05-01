<?php

namespace App;
use Auth;
use Session;
use App\Model\Admin\Brand;
use App\Model\Admin\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function brand(){
        return $this->belongsTo('App\Model\Admin\Brand','brand_id');
    }
    public function category(){
        return $this->belongsTo('App\Model\Admin\Category','category_id','id');
    }
     public function subcategory(){
        return $this->belongsTo('App\Model\Admin\Subcategory','subcategory_id');
    }
     public function section(){
        return $this->belongsTo('App\Section','section_id');
    } 
    public function occasion(){
        return $this->belongsTo('App\OccasionalEvent','occasional');
    }
    
     public function attributes(){
        return $this->hasMany('App\AttributeProduct');
    }
    public function orderDetail()
    {
        return $this->hasMany('App\OrderDetail');
    }
    public static function mainProduct(){
    $categoryID=Product::with('category')->where('select_type','Quickee')->get();
    $categoryID=json_decode(json_encode($categoryID),true);
    //echo"<pre>";print_r($categoryID);die;
    return $categoryID;

}
public static function productFilters(){

        $productFilters['selectArrayLady']=array('Long Sleeve','Half Sleeve','SleeveLess');
        $productFilters['selectArrayStyle']=array('3-pics','4-pics','unstitch','shari');
        $productFilters['selectArrayFabric']=array('Cotton','silk','Polyester','Nylon','Velvet','Others');
        return $productFilters;
  }

  public static function getProductdiscount($product_id){
      $proDiscount=Product::select('selling_price','discount_price','category_id','product_name_bangla','product_quantity')->where('id',$product_id)->first()->toArray();
      //echo"<pre>";print_r($proDiscount);die;
      $catDetails=Category::select('category_discount')->where('id',$proDiscount['category_id'])->first()->toArray();
      //echo"<pre>";print_r($catDetails);die;
      if($proDiscount['discount_price']>0){
          $discounted_price=$proDiscount['selling_price'] - ($proDiscount['selling_price']*$proDiscount['discount_price']/100);

      }else if($catDetails['category_discount']>0){
          $discounted_price=$proDiscount['selling_price'] - ($proDiscount['selling_price']*$catDetails['category_discount']/100);

      }else{
          $discounted_price=0;
      }
      return $discounted_price;
  }

    public static function getDiscountedAttrPrice($product_id,$weight_size){
      
       $proAttrPrice=AttributeProduct::where(['product_id'=>$product_id,'weight_size'=>$weight_size])->first()->toArray();
      // echo"<pre>";print_r($proAttrPrice);die;
     //dd($proAttrPrice);
      $proDiscount=Product::select('discount_price','category_id','product_name_bangla')->where('id',$product_id)->first()->toArray();
      //echo"<pre>";print_r($proDiscount);die;
      $catDetails=Category::select('category_discount')->where('id',$proDiscount['category_id'])->first()->toArray();

       if($proDiscount['discount_price']>0){
          $final_price=$proAttrPrice['price'] - ($proAttrPrice['price']*$proDiscount['discount_price']/100);
          $discount=$proAttrPrice['price']-$final_price;


      }else if($catDetails['category_discount']>0){
          $final_price=$proAttrPrice['price'] - ($proAttrPrice['price']*$catDetails['category_discount']/100);
          $discount=$proAttrPrice['price']-$final_price;

      }else{
          $final_price=$proAttrPrice['price'];
          $discount=0;
      }

      //echo"<pre>";print_r($total);die;
      return array('selling_price'=>$proAttrPrice['price'],'final_price'=>$final_price,'discount'=>$discount,);
    }
   public static function getDiscountedAttrPriceSize($product_id, $weight_size)
{
    // Fetch attribute price
    $proAttrPrice = AttributeProduct::where(['product_id' => $product_id, 'weight_size' => $weight_size])->first();

    if (!$proAttrPrice) {
        // Handle the case where no record is found for the given conditions
        return null; // Or return an appropriate value or throw an exception
    }

    $proAttrPriceArray = $proAttrPrice->toArray();

    // Fetch product discount information
    $proDiscount = Product::select('discount_price', 'category_id', 'product_name_bangla')->where('id', $product_id)->first();

    if (!$proDiscount) {
        // Handle the case where no record is found for the given conditions
        return null; // Or return an appropriate value or throw an exception
    }

    $proDiscountArray = $proDiscount->toArray();

    // Fetch category discount information
    $catDetails = Category::select('category_discount')->where('id', $proDiscountArray['category_id'])->first();

    if (!$catDetails) {
        // Handle the case where no record is found for the given conditions
        return null; // Or return an appropriate value or throw an exception
    }

    $catDetailsArray = $catDetails->toArray();

    // Calculate final price and discount
    if ($proDiscountArray['discount_price'] > 0) {
        $final_price = $proAttrPriceArray['price'] - ($proAttrPriceArray['price'] * $proDiscountArray['discount_price'] / 100);
        $discount = $proAttrPriceArray['price'] - $final_price;
    } elseif ($catDetailsArray['category_discount'] > 0) {
        $final_price = $proAttrPriceArray['price'] - ($proAttrPriceArray['price'] * $catDetailsArray['category_discount'] / 100);
        $discount = $proAttrPriceArray['price'] - $final_price;
    } else {
        $final_price = $proAttrPriceArray['price'];
        $discount = 0;
    }

    return array(
        'selling_price' => $proAttrPriceArray['price'],
        'final_price' => $final_price,
        'discount' => $discount,
    );
}

  public static function getProductImage($product_id){
      $getProductImage=Product::select('image_one')->where('id',$product_id)->first()->toArray();
      return $getProductImage['image_one'];

  }

// public static function brandFilters(){
//         $brand=Brand::get();
//         $brand=json_decode(json_encode($brand),true);
//     //echo"<pre>";print_r($categoryID);die;
//         return $brand;
//   }

  public static function getProductStock($product_id,$weight_size){
        $getProductStock=AttributeProduct::select('stock')->where(['product_id'=>$product_id,'weight_size'=>$weight_size])->first();
        return $getProductStock->stock;
    }
     public static function deleteCartProduct($product_id,$user_id){
        CartModal::where(['product_id'=>$product_id,'user_id'=>$user_id])->delete();
    }
    public static function getProductStatus($product_id){
        $getProductStatus=Product::select('status')->where('id',$product_id)->first();
        return $getProductStatus->status;
    }

     public static function getAttributeCount($product_id,$weight_size){
        $getAttributeCount =AttributeProduct::select('status')->where(['product_id'=>$product_id,'weight_size'=>$weight_size])->first();
        return $getAttributeCount->status;
    }
     public static function getCategoryStatus($category_id){
        $getCategoryStatus = Category::select('status')->where('id',$category_id)->first();
        return $getCategoryStatus->status;
    }


//for wishlist only
      public static function getProductdiscounts($wishlist_id){
      $proDiscount=Product::select('selling_price','discount_price','category_id','product_name_bangla')->where('id',$wishlist_id)->first()->toArray();
      //echo"<pre>";print_r($proDiscount);die;
      $catDetails=Category::select('category_discount')->where('id',$proDiscount['category_id'])->first()->toArray();
      if($proDiscount['discount_price']>0){
          $discounted_price=$proDiscount['selling_price'] - ($proDiscount['selling_price']*$proDiscount['discount_price']/100);

      }else if($catDetails['category_discount']>0){
          $discounted_price=$proDiscount['selling_price'] - ($proDiscount['selling_price']*$catDetails['category_discount']/100);

      }else{
          $discounted_price=0;
      }
      return $discounted_price;
  }
  
  public function images(){
      return $this->hasMany('App\ProductImage','product_id');
  }
  
   public function abouts(){
      return $this->hasMany('App\AboutProduct','product_id');
  }
  
   public function faqs(){
      return $this->hasMany('App\ProductFaq','product_id');
  }
  
   public function color(){
        return $this->belongsTo('App\Color','family_color');
    }
    
    public static function isNewProduct($product_id){
        $productId=Product::select('id')->where('status',1)->orderby('id','DESC')->limit(3)->pluck('id');
        $productId =json_decode(json_encode($productId),true);
        if(in_array($product_id,$productId)){
           $isNewProduct ="Yes";
        }else{
           $isNewProduct ="No";
        }
        return $isNewProduct;
    }
  
 


}
