<?php

namespace App\Http\Controllers\Admin;

use DB;
use Image;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Session;
use Carbon\Carbon;
use App\User;
use Mail;
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function addeditCampain(Request $request,$id=null)
    {
        if($id==''){
            $message="Add Partner List Successfully!";
            $post=new Post;
        }else{
             $message="Update Partner List Successfully!";
             $post=Post::find($id);
        }
        if($request->isMethod('post')){
            $data=$request->all();
              if($request->hasFile('image')){
                  if(!empty($post['image'])){
                      $location="public/media/post/".$post['image'];
                        if(File::exists($location)){
                          File::delete($location);
                        }
                    }
            	$image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
	                $imageName =rand(111,99999).'.'.$extension;
                    $path = 'public/media/post/'.$imageName;
     				Image::make($image_tmp)->resize(300,300)->save($path,60);
     				$post['image'] = $imageName;
                }
            }
            $post->title=$data['title'];
            $post->note=$data['note'];
            $post->date=Carbon::now()->toDateString();
            $post->save();
            Session::flash('success',$message);
            return redirect()->back();
        }

    }

    public function index()
    {
        $countPost=Post::where('status',1)->count();
        //echo ($countPost);die;
    	$post=DB::table('posts')->get();
    	return view('admin.blog.index',compact('post','countPost'));
    }

    public function delete($id)
    {
    	$post=Post::find($id);
    	$location="public/media/post/".$post['image'];
            if(File::exists($location)){
                File::delete($location);
            }
        $post->delete();    
    	Session::flash('success','Deleted Succesfully');
        return Redirect()->back();
    }
    
    public function sentUser($id){
       	$post=Post::find($id);
       	if($post){
       	    $getUser=User::where('status',1)->get()->toArray();
       	     $sitesetting=DB::table('sitesettings')->where('status',1)->first();
       	    foreach($getUser as $user){
       	        $email = $user['email'];
       	        $name=$user['name'];
                $messageData=[
                    'name'=>$user['name'],
                    'sitesetting'=>$sitesetting,
                    'post'=>$post
                ];
                Mail::send('emails.cam',$messageData,function($message) use ($email,$name){
                    $message->to($email)->subject($name.' Have a Look!!'); });
               	} 
       	    }
           	
           	Session::flash('success','Post Submitted');
            return redirect()->back();
       	
    }

}
