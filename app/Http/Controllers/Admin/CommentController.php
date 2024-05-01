<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductComment;
use App\ProductReplay;
use App\Product;
use App\ProductRating;
use App\Admin;
use Auth;
use DB;
use Session;
class CommentController extends Controller
{
	 public function __construct()
    {
        $this->middleware('admin');
    }
    public function index(){
        Session::put('page','comment');
        $title="Product Comment List";
        $id=Product::pluck('id')->toArray();
        $comments = ProductComment::with(['users','product'])->whereIn('product_id',$id)->get()->toArray();
    	return view('admin.contact.commentindex',compact('comments','title'));
    }

    public function commentReplay(Request $request,$id=null){
        $comments = ProductComment::find($id);
	    if($request->isMethod('post')){
    		$data=$request->all();
    		$replay = new ProductReplay;
    		$user_id=Auth::guard('admin')->user()->id;
    		$replay->user_id=$user_id;
    		$replay->comment_id=$comments->id;
    		$replay->comment_replay=$data['comment_replay'];
    		$replay->save();
    	    Session::flash('success','Comment replay  Added Successfully');
            return Redirect('admin/comment-lists');
    	}
        $title = 'Apply Customer Replay';
    	return view('admin.contact.append',compact('title','comments'));

    }
    
     public function updateComment(Request $request){
            if($request->ajax()){
                $data = $request->all();
                if($data['status']=="Active"){
                    $status = 0;
                }else{
                    $status= 1;
                }
                ProductComment::where('id',$data['section_id'])->update(['status'=>$status]);
                return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
            }
    }
    
    
    public function ratingIndex(){
        Session::put('page','rating');
        $title="Rating Lists";
        $ratings=ProductRating::get();
        return view('admin.rating.index',compact('title','ratings'));
    }
    
    public function updateRating(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status= 1;
            }
            ProductRating::where('id',$data['section_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
        }
    }
    
    public function ratingDelete(Request $request,$id){
        $rating=ProductRating::find($id);
        if($request->isMethod('post')){
            $rating->delete();
            Session::flash('success','Deleted Successfully');
            return redirect('admin/rating-lists');
        }
        $title="Are You sure To Delete ?";
        return view('admin.rating.append.index',compact('title','rating'));
    }

}
