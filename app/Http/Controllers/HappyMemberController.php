<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HappyMember;
use App\Sitesetting;
use App\Product;
use Auth;
use Session;
class HappyMemberController extends Controller
{
    public function indexMember(){
        $sitesetting=Sitesetting::where('status',1)->first();
        $hopp= HappyMember::where('status',1)->first();
        return view('pages.happymember.form',compact('sitesetting','hopp'));
    }
    public function happyMember(Request $request){

        $happy=new HappyMember;
        if($request->isMethod('post')){

            $data = $request->all();
            if ($request['product_one']) {
                $product_one = $data['product_one'];

            } else {
                $product_one = "NULL";
            }

            $user_id=Auth::user()->id;
            $happy->user_id=$user_id;
            $happy->product_one=$product_one;
            $happy->product_two=$data['product_two'];
            $happy->product_three=$data['product_three'];
            $happy->product_four=$data['product_four'];
            $happy->product_five=$data['product_five'];
            $happy->product_six=$data['product_six'];
            $happy->product_seven=$data['product_seven'];
            $happy->product_eight=$data['product_eight'];
            $happy->quantity_one=$data['quantity_one'];
            $happy->quantity_two=$data['quantity_two'];
            $happy->quantity_three=$data['quantity_three'];
            $happy->quantity_four = $data['quantity_four'];
            $happy->quantity_five=$data['quantity_five'];
            $happy->quantity_six=$data['quantity_six'];
            $happy->quantity_seven=$data['quantity_seven'];
            $happy->quantity_eight=$data['quantity_eight'];
            $happy->status=1;
            $happy->save();
            Session::flash('success','Your Voucher Item Has Been Added');
            return redirect()->back();

        }

        return view('pages.happymember.form',compact('happ'));
    }


    public function indexMemberPrint(){
        //$product_id=Product::where('select_type','Quickee')->pluck('id');
        $happies = HappyMember::where('user_id',Auth::user()->id)->where('status', 1)->get()->toArray();
        //dd($happies);die;
        return view('pages.happymember.invoice',compact('happies'));

    }

}
