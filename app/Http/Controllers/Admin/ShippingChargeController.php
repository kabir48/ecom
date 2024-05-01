<?php

namespace App\Http\Controllers\Admin;
use DB;
use Session;
use App\Country;
use App\ShippingCharge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShippingChargeController extends Controller
{
       public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        Session::put('page','Shipping Charges');
        $title="Shipping Charges";
        $charges=ShippingCharge::with(['countryName'])->get()->toArray();
        //dd($charge);die;
        return view('admin.charge.charge',compact('charges','title'));
    }
    public function storeCharge(Request $request,$id=null){
        if($id==''){
            $title='Add Shipping Charges';
            $message="Successfully Shipping Charges Added";
            $charge=new ShippingCharge;
        }else{
            $title='Updated Shipping Charges';
            $message="Successfully Shipping Charges Updated";
            $charge=ShippingCharge::find($id);
        }
        
        if($request->isMethod('post')){
            $data=$request->all();
            $charge->country=$data['country'];
            $charge->zero=$data['zero'];
            $charge->fivehundred=$data['fivehundred'];
            $charge->onethousand=$data['onethousand'];
            $charge->twothousand=$data['twothousand'];
            $charge->above=$data['above'];
            $charge->status=1;
            $charge->save();
           Session::flash('success',$message);
            return Redirect('admin/shipping-charge-lists');
        }
        
        $countries=Country::get();
        return view('admin.charge.create',compact('title','charge','countries'));
    }
    
    public function updateCharge(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status= 1;
            }
            ShippingCharge::where('id',$data['section_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
        }
    }

   
}
