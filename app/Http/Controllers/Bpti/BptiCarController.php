<?php

namespace App\Http\Controllers\Bpti;

use App\BptiCar;
use App\about_bpti;
use App\BptiForm;
use App\BptiSupplier;
use App\FindBpti;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;

class BptiCarController extends Controller
{
       public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $tearm=BptiCar::where('status',1)->orderBY('id','ASC')->get()->toArray();
        //dd($tearm);die;
        return view('bpti.bpticars.index',compact('tearm'));
    }

    public function addEditBpti(Request $request, $id=null){
        if($id==""){
            $title="Add Bapti Cars Information";
            $bpti=new BptiCar;
            $message="BPTI Added Successfully!";

        }else{
            $title="Add Bapti Cars Information";
            $bpti=BptiCar::find($id);
            $message="BPTI UPDATED Successfully!";
        }
        if($request->isMethod('post')){
            $data=$request->all();
            $this->validate($request,[
                'car_name'=>'required',
                'car_name_bangla'=>'required',
                'brand_name'=>'required',
                'brand_name_bangla'=>'required',
                'selling_price'=>'required',
                'selling_price_bangla'=>'required',
                'model_no'=>'required',
                'selling_price_bangla'=>'required',
            ]);
            //echo"<pre>";print_r($data);die;
            $bpti->car_name=$data['car_name'];
            $bpti->manager_id=$data['manager_id'];
            $bpti->car_name_bangla=$data['car_name_bangla'];
            $bpti->brand_name=$data['brand_name'];
            $bpti->brand_name_bangla=$data['brand_name_bangla'];
            $bpti->selling_price=$data['selling_price'];
            $bpti->selling_price_bangla=$data['selling_price_bangla'];
            $bpti->model_no=$data['model_no'];
            $bpti->model_no_bangla=$data['model_no_bangla'];
            $bpti->year=$data['year'];
            $bpti->year_bangla=$data['year_bangla'];
            $bpti->color=$data['color'];
            $bpti->color_bangla=$data['color_bangla'];
            $bpti->engine_capacity=$data['engine_capacity'];
            $bpti->engine_capacity_bangla=$data['engine_capacity_bangla'];
            $bpti->model_type=$data['model_type'];
            $bpti->model_type_bangla=$data['model_type_bangla'];
            $bpti->mileage=$data['mileage'];
            $bpti->condition_type=$data['condition_type'];
            $bpti->condition_bangla=$data['condition_bangla'];
            $bpti->mileage_bangla=$data['mileage_bangla'];
            $bpti->description=$data['description'];
            $bpti->description_bangla=$data['description_bangla'];
            $bpti->status=1;
            // Upload Image
            if($request->hasFile('image_one')){
            	$image_tmp = $request->file('image_one');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $image_name=$image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
	                $imageName =$image_name.'-'.rand(111,99999).'.'.$extension;
                    $bpticar_path = 'public/media/bptibanner/'.$imageName;
     				Image::make($image_tmp)->resize(870,290)->save($bpticar_path);
     				$bpti->image_one = $imageName;
                }
            }
              if($request->hasFile('image_two')){
            	$image_tmp = $request->file('image_two');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $image_name=$image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
	                $imageName =$image_name.'-'.rand(111,99999).'.'.$extension;
                    $bpticar_path_small = 'public/media/bpticar/'.$imageName;
     				Image::make($image_tmp)->resize(63,61)->save($bpticar_path_small);
     				$bpti->image_two = $imageName;
                }
            }
             if($request->hasFile('image_three')){
            	$image_tmp = $request->file('image_three');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $image_name=$image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
	                $imageName =$image_name.'-'.rand(111,99999).'.'.$extension;
                    $bpticar_path_large = 'public/media/bpticarlarge/'.$imageName;
     				Image::make($image_tmp)->resize(230,300)->save($bpticar_path_large);
     				$bpti->image_three = $imageName;
                }
            }
            if($request->hasFile('image_four')){
            	$image_tmp = $request->file('image_four');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $image_name=$image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
	                $imageName =$image_name.'-'.rand(111,99999).'.'.$extension;
                    $bpticar_path_home = 'public/media/home/'.$imageName;
     				Image::make($image_tmp)->resize(230,300)->save($bpticar_path_home);
     				$bpti->image_four = $imageName;
                }
            }
            $bpti->save();
            $notification=array(
                 'messege'=>$message,
                 'alert-type'=>'success'
                       );
            return Redirect()->route('bpti.index-cars')->with($notification);

        }

        $manager=BptiSupplier::where('status',1)->get();
        return view('bpti.bpticars.create',compact('title','bpti','manager'));

    }
      public function updateBpti(Request $request){
            if($request->ajax()){
                $data = $request->all();
                if($data['status']=="Active"){
                    $status = 0;
                }else{
                    $status= 1;
                }
                BptiCar::where('id',$data['section_id'])->update(['status'=>$status]);
                return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
            }
    }
      public function updateBptiStock(Request $request){
            if($request->ajax()){
                $data = $request->all();
                if($data['stock']=="Active"){
                    $stock = 0;
                }else{
                    $stock= 1;
                }
                BptiCar::where('id',$data['stock_id'])->update(['stock'=>$stock]);
                return response()->json(['stock'=>$stock,'stock_id'=>$data['stock_id']]);
            }
    }

    public function bptiIndex(){
        $tearm=BptiSupplier::where('status',1)->get();
        return view('bpti.bpticars.bpti_stuff',compact('tearm'));
    }
    public function addEditBptiStuff(Request $request,$id=null){

        if($id==""){
            $title="Add BaptiStuff Information";
            $stuff=new BptiSupplier;
            $message="BPTI Stuff Added Successfully!";

        }else{
            $title="Updated BaptiStuff  Information";
            $stuff=BptiSupplier::find($id);
            $message="BPTI UPDATED Successfully!";
        }
        if($request->isMethod('post')){
            $data=$request->all();
            $this->validate($request,[
                'name'=>'required',
                'email'=>'required',
                'phone'=>'required',
                'address'=>'required',
            ]);
            //echo"<pre>";print_r($data);die;
            $stuff->name=$data['name'];
            $stuff->email=$data['email'];
            $stuff->phone=$data['phone'];
            $stuff->phone_one=$data['phone_one'];
            $stuff->address=$data['address'];
            $stuff->status=1;
            $stuff->save();
            $notification=array(
                 'messege'=>$message,
                 'alert-type'=>'success'
                       );
        return Redirect()->route('bpti.index-stuff')->with($notification);
    }

    return view('bpti.bpticars.bpticreate',compact('title','stuff'));

  }
  public function BptiInfoView(){
      $customerQuery=BptiForm::where('status',1)->get();
      return view('bpti.bpticars.formindex',compact('customerQuery'));
  }
    public function BptiInfoDelete($id){
        BptiForm::find($id)->delete();
        $message="Information Deleted Successfully!";
        $notification=array(
                 'messege'=>$message,
                 'alert-type'=>'success'
                       );
        return Redirect()->back()->with($notification);

  }


  public function bptiIndexcar(){
       $carquery=FindBpti::where('status',1)->get();
       return view('bpti.bpticars.findcar',compact('carquery'));
  }

  public function addEditBptiCar(Request $request,$id=null){
      if($id==""){
          $title='Add Bpti Car Query Information';
          $message="Successfully Add Query Successfully!";
          $carquery=new FindBpti;
      }else{
          $title='Updated Bpti Car Query Information';
          $message="Successfully Update Query Successfully!";
          $carquery=FindBpti::find($id);
      }
      if($request->isMethod('post')){
          $data=$request->all();
          $carquery->brand_name=$data['brand_name'];
          $carquery->model_no=$data['model_no'];
          $carquery->status=1;
          $carquery->save();
          $notification=array(
                 'messege'=>$message,
                 'alert-type'=>'success'
                       );
        return Redirect()->back()->with($notification);

  }
  if($id!=''){
    return view('bpti.bpticars.findcaredit',compact('title','carquery'));
  }

 }
 public function bptiIndexAbout(){
  $about=about_bpti::where('status',1)->get();

  return view('bpti.bpticars.aboutindex',compact('about'));
 }
 public function addEditAbout(Request $request,$id=null){

  if($id==''){
    $title="About part page";
    $message="Successfull About pages created!";
    $about=new about_bpti;
  }else{
     $title="About part page for update";
     $message="Successfull About pages Updated!";
     $about=about_bpti::find($id);
  }
  if($request->isMethod('post')){
    $data=$request->all();
    $about->name=$data['name'];
    $about->name_bangla=$data['name_bangla'];
    $about->detail=$data['detail'];
    $about->detail_bangla=$data['detail_bangla'];
       if($request->hasFile('image')){
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111,99999).'.'.$extension;
                    $large_image_path = 'public/media/bpti/large'.'/'.$fileName;
                    $medium_image_path = 'public/media/bpti/medium'.'/'.$fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(230, 300)->save($medium_image_path);
                    $about->image = $fileName;

                }
            }
            $about->save();
             $notification=array(
                 'messege'=>$message,
                 'alert-type'=>'success'
                       );
             return Redirect('bpti/bpti-car-about')->with($notification);
          }
          return view('bpti.bpticars.aboutcreate',compact('title','about'));
      }
}
