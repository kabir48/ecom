<?php

namespace App\Http\Controllers;


use App\WishlistTable;
use Illuminate\Http\Request;
use Auth;
use Session;
class WishlistController extends Controller
{
    public function AddWishlist(Request $request)
    {
    	$wishlist_id=$request->wishlist_id;
          if(Auth::check()){
                if(WishlistTable::where('user_id',Auth::id())->where('wishlist_id',$wishlist_id)->exists()){
                    //already added
                    return response()->json(['status'=>'Product is Already added to wishlist']);
                }else{

                    $wishlist= new WishlistTable();
                    $wishlist->user_id=Auth::id();
                    $wishlist->wishlist_id=$wishlist_id;
                    $wishlist->save();
                    return response()->json(['status'=>'Product is added to wishlist']);
                }
           }else{
                return response()->json(['status' => 'At first to login your account']);

        }

    }

    public function getWishlist(){
        $wishlists=WishlistTable::with(['products'])->where('user_id',Auth::id())->get()->toArray();
        //echo "<pre>";print_r($wishlists);die;

        $meta_title = "Wish list,equickee";
        $meta_keywords = "wish list,online shop,products,dress,facewash,shampoo";
         $page_name="listing";
        return view('pages.wishlist',compact('wishlists','meta_title','meta_keywords','page_name'));
    }

    public function removeWishlist(Request $request){
        if(Auth::check()){
            $wish_id=$request->wish_id;
            if(WishlistTable::where('user_id',Auth::id())->where('id',$wish_id)->exists()){
                  $wishdel=WishlistTable::where('user_id',Auth::id())->where('id',$wish_id)->first();
                  $wishdel->delete();
                    return response()->json(['status' => 'Product Successfully Deleted!']);
            }else{
                  return response()->json(['status' => 'No Items Were Found']);
            }
        }

    }
}
