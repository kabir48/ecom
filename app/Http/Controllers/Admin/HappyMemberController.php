<?php

namespace App\Http\Controllers\Admin;

use App\HappyMember;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
class HappyMemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function happyIndex(){
        $happies=HappyMember::with('users',)->where('status',1)->get()->toArray();
            //echo "<pre>";print_r($happies);die;
        //dd($happies);die;
        return view('admin.happymember.index',compact('happies'));
    }
    public function happyIndexInvoice($id){
        $row=HappyMember::with('users')->where('status', 1)->where('id',$id)->first()->toArray();

        return view('admin.happymember.invoice',compact('row'));
    }
}
