<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;
use App\Sitesetting;
use App\PinCode;
use App\State;
use App\PaymentGateway;
use App\CurrencyConverter;
use Session;
use File;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        Session::put('page','setting');
        $title="Site Setting Lists";
    	$settinCount=Sitesetting::where('status',1)->count();
        $setting=Sitesetting::get();
    	return view('admin.setting.index',compact('setting','settinCount','title'));
    }

    public function store(Request $request,$id=null)
    {
        if($id==''){
         $title="Website Info";
         $message="Website information Created Successfully!";
         $info=new Sitesetting;
        }else{
            $title="Website Info";
         $message="Website information Updated Successfully!";
         $info=Sitesetting::find($id);
        }
        if($request->isMethod('post')){
        $data=$request->all();
            $info->phone_one=$data['phone_one'];
            $info->phone_two=$data['phone_two'];
            $info->email=$data['email'];
            $info->company_name=$data['company_name'];
            $info->keyword=$data['keyword'];
            $info->description=$data['description'];
            $info->short=$data['short'];
            $info->company_address=$data['company_address'];
            $info->facebook=$data['facebook'];
            $info->youtube=$data['youtube'];
            $info->instagram=$data['instagram'];
            $info->minimum_order=$data['minimum_order'];
            $info->maximum_order=$data['maximum_order'];
            $info->twitter=$data['twitter'];
            if($request->hasFile('logo')){
                if(!empty($info['logo'])){
                    $location='public/media/logo/'.$info['logo'];
                    $location_icon='public/media/logo/favicon/'.$info['logo'];
                    if(File::exists($location) || File::exists($location_icon)){
                        File::delete($location);
                        File::delete($location_icon);
                    }
                }
                $image_tmp = $request->file('logo');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName =rand(111,99999).'.'.$extension;
                    $path = 'public/media/logo/'.$imageName;
                    $path_icon = 'public/media/logo/favicon/'. $imageName;
                    Image::make($image_tmp)->resize(74,74)->save($path);
                    Image::make($image_tmp)->resize(32,33)->save($path_icon);
                    $info['logo'] = $imageName;
                }
            }
            
             if($request->hasFile('seo')){
                if(!empty($info['seo'])){
                    $location='public/media/logo/seo/'.$info['seo'];
                    if(File::exists($location) ){
                        File::delete($location);
                    }
                }
                $image_tmp = $request->file('seo');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName =rand(111,99999).'.'.$extension;
                    $path = 'public/media/logo/seo/'.$imageName;
                    Image::make($image_tmp)->resize(250,250)->save($path);
                    $info['seo'] = $imageName;
                }
            }

            $info->save();
            Session::flash('success',$message);
            return Redirect('admin/sitesetting-lists');
        }
        return view('admin.setting.create',compact('title','message','info'));
    }
    
    
     public function smtp()
    {
        Session::put('page','env');
        // $smtp=DB::table('smtp')->first();
        $title="Please Insert The Data Carefully, Dont Give Any Space";
        return view('admin.setting.smtp',compact('title'));
    }

    //smtp update in Env
    public function smtpUpdate(Request $request){

        foreach($request->types as $key=>$type){
            $this->updateEnvFile($type, $request[$type]);
        }
        $notification= 'SMTP Setting Updated!';
        Session::flash('success',$notification);
        return redirect()->back();
    }
    
     public function updateEnvFile($type, $val)
    {
        $path=base_path('.env');
        if (file_exists($path)) {
            if (strpos(file_get_contents($path), $type) >= 0) {
               file_put_contents($path, str_replace(
                    $type . '=' . env($type), $type . '=' . $val, file_get_contents($path)
                ));
            }else{
                file_put_contents($path,file_get_contents($path).$type.'='.$val);
            }
        }
    }
    
    public function gatewayIndex(){
        Session::put('page','gateway');
        $title="Payment Gateway Page (Please Buy store_id or signature_id or screate_id from the provider)";
        $payments=PaymentGateway::get();
        return view('admin.setting.paymentgateway.index',compact('title','payments'));
    }
    
    public function gatewayStoreUpdate(Request $request,$id=null){
        $title="Payment Gateway(Please Buy Store id, signature id, screte id from the provider)";
        if($id==''){
          $payment=new PaymentGateway();
          $title="Payment Gateway(Please Buy Store id, signature id, screte id from the provider)";  
        }else{
           $title="Payment Gateway(Please Buy Store id, signature id, screte id from the provider)"; 
           $payment=PaymentGateway::find($id);
        }
        if($request->isMethod('post')){
            $data=$request->all();
            $payment->title=$data['title'];
            $payment->store_id=$data['store_id'];
            $payment->signature_id=$data['signature_id'];
            $payment->type=$data['type'];
            $payment->live=$data['live'];
            $payment->save();
            $notification= 'Payment Gateway Updated!';
            Session::flash('success',$notification);
            return redirect('admin/payment-gateway-lists');
        }
        return view('admin.setting.paymentgateway.create',compact('title','payment'));
    }
    
    public function updateGateway(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status= 1;
            }
            PaymentGateway::where('id',$data['section_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
        }
    }

    
    public function getPinCode(){
        $pincodes=PinCode::where('status',1)->get();
        $title="Zip Codes";
        Session::put('page','code');
        return view('admin.zipcode.index',compact('title','pincodes'));
    }
    
    public function pinCodeStore(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            if(!empty($data['zip_code'])){
                foreach($data['zip_code'] as $i=>$row){
                    if(!empty($row)){
                        $code=new PinCode();
                        $code->zip_code=$row;
                        $code->place=$data['place'][$i];
                        $code->save();
                    }
                   
                }
                Session::flash('success','Added Successfully');
                return redirect()->back();
            }
        }
        $states=State::get()->toArray();
        $title="Zip Code Create And View";
        Session::put('page','zipcode');
        $zips=PinCode::where('status',1)->get()->toArray();
        return view('admin.zipcode.create',compact('title','states','zips'));
    }
    public function pinCodeUpdate(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
           if(isset($data['zipid'])) {
                foreach($data['zipid'] as $akey=>$attr){
                        if(!empty($attr)){
                            PinCode::where(['id'=>$data['zipid'][$akey]])->update(['zip_code'=>$data['zip_code'][$akey],'place'=>$data['place'][$akey]]);
                        }
                    } 
                Session::flash('success','Added Successfully');
                return redirect()->back();
           }
        }
    }
    
    public function updateZipCode(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status= 1;
            }
            PinCode::where('id',$data['zip_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'zip_id'=>$data['zip_id']]);
        }
    }
    
    public function zipCodeDelete($id){
        PinCode::find($id)->delete();
         Session::flash('success','Deleted Successfully');
                return redirect()->back();
        
    }
    // ====Currency Converter =====//
    public function currencyStore(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            foreach($data['currency_code'] as $key=>$value){
                if(!empty($value)){
                    $currency=new CurrencyConverter();
                    $currency->currency_code=$value;
                    $currency->exchange_rate=$data['exchange_rate'][$key];
                    $currency->save();
                }
            }
            Session::flash('success','Added Successfully');
            return redirect()->back();
        }
        $title="Curency Create And View";
        $currencies=CurrencyConverter::get()->toArray();
        return view('admin.currency.create',compact('title','currencies'));
    }
    
     public function currencyUpdate(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            if(isset($data['currencyid'])) {
               foreach($data['currencyid'] as $vkey=>$val){
                    if(!empty($val)){
                       CurrencyConverter::where(['id'=>$data['currencyid'][$vkey]])->update(['currency_code'=>$data['currency_code'][$vkey],'exchange_rate'=>$data['exchange_rate'][$vkey]]);
                    }
                }
                Session::flash('success','Added Successfully');
                return redirect()->back();  
            }
        }
     
    }
    
    public function updateCurrencyStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status= 1;
            }
            CurrencyConverter::where('id',$data['currency_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'currency_id'=>$data['currency_id']]);
        }
    }

}
