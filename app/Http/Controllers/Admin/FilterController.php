<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\ProductFilter;
use App\ProductFilterValue;
use App\Section;
use DB;
use Illuminate\Support\Facades\View;

class FilterController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
   
    
    public function filterIndex(){
        Session::put('page','filter');
        $title="Product Filter View";
        $filters=ProductFilter::get();
        return view('admin.filter.index',compact('title','filters'));
    }
    
    public function filterStore(Request $request,$id=null){
        if($id==''){
            $title="Filter Create Page";
            $filter=new ProductFilter;
            $message="Filter Added";
            $catArr=array();
        }else{
            $title="Filter Updated Page";
            $filter=ProductFilter::find($id);
            $message="Filter Updated";
            $catArr=explode(',',$filter['category_id']);
        }
        if($request->isMethod('post')){
            $data=$request->all();
            $cat_id=implode(',',$data['category_id']);
            $filter->filter_name=$data['filter_name'];
            $filter->filter_column=$data['filter_column'];
            $filter->category_id=$cat_id;
            $filter->save();
            //Add Filter Coulmn in product Table
            if($id==''){
               DB::statement('Alter table products add '.$data['filter_column'].' varchar(255) after family_color');
            }
            Session::flash('success',$message);
            return redirect('admin/filter-lists');
        }
        $sections = Section::with('categories')->where('status',1)->get();
        return view('admin.filter.create',compact('title','filter','sections','catArr'));
    }
    public function updateStatusFilter(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status= 1;
            }
            ProductFilter::where('id',$data['filter_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'filter_id'=>$data['filter_id']]);
        }
    }  
    
    public function updateStatusFilterValue(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status= 1;
            }
            ProductFilterValue::where('id',$data['value_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'value_id'=>$data['value_id']]);
        }
    }
    
    // ====Filter Value List=====//
    public function filterValueIndex(){
        Session::put('page','value');
        $title="Product Filter View";
        $values=ProductFilterValue::get();
        return view('admin.filter.value.index',compact('title','values'));
    }
    
    
    public function filterValueStore(Request $request,$id=null){
        if($id==''){
            $title="Filter Value Page";
            $value=new ProductFilterValue;
            $message="Filter Added";
        }else{
            $title="Filter Value Page";
            $value=ProductFilterValue::find($id);
            $message="Filter Updated";
        }
        if($request->isMethod('post')){
            $data=$request->all();
            $value->filter_value=$data['filter_value'];
            $value->filter_id=$data['filter_id'];
            $value->save();
            return redirect('admin/filter-value-lists');
        }
        $filters = ProductFilter::where('status',1)->get();
        return view('admin.filter.value.create',compact('title','value','filters'));
    }
    
    public function categoryFilter(Request $request){
        if($request->ajax()) {
           $data=$request->all();
           $category_id=$data['category_id'];
           return response()->json(['view'=>(String)view::make('admin.product.category_filter')->with(compact('category_id'))]);
       }
    }
}
