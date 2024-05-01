@extends('layouts.admin.main')
       @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                    <div class="canvas_header">
                        <h2>{{$title}}</h2>
                        <a href="{{url('admin/user-list')}}" class="btn btn-default btn-primary">Back
                        </a>
                    </div>  

                    <!-- orders -->
                    <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                         <form method="post"  action="{{url('admin/user-list-update/'.$user->id)}}" enctype="multipart/form-data">
                            @csrf
                                        
                           <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Role Permission</label>
                                        <select name="role_id" class="form-control select2">
                                            <option>Select role</option>
                                            @foreach($roles as $role)
                                            <option value="{{$role->id}}" @if($user->role_id == $role->id) selected @endif>{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>     
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3 ajax-select mt-3 mt-lg-0">
                                        <label class="form-label">Name (Required)
                                        </label>    
                                         <input class="form-control" name="name" type="text" id="example-text-input" value="{{$user->name}}" placeholder="write name">  
                                    </div>
                                </div>  
                        
                                <div class="col-lg-6">
                                    <div class="mb-3 ajax-select mt-3 mt-lg-0">
                                        <label class="form-label">Email (Required)
                                        </label>    
                                         <input class="form-control" name="email" value="{{$user->email}}" type="email" id="example-text-input" placeholder="write email">             
                                    </div>
                                </div> 
                        
                                <div class="col-lg-6">
                                    <div class="mb-3 ajax-select mt-3 mt-lg-0">
                                        <label class="form-label">Phone (Required)
                                        </label>    
                                         <input class="form-control" name="phone" value="{{$user->phone}}" type="text" id="example-text-input" placeholder="write email">             
                                    </div>
                                </div> 
                        
                           
                               <div class="col-sm-6">
                                    <div class="mt-4">
                                        <input class="form-control form-control-lg" id="formFileLg" type="file" name="image_one">
                                    </div>
                                    @if($user->image_one)
                                    <img src="{{asset('public/media/admin/'.$user->image_one)}}" width="60">
                                    @endif
                                </div>     
                                            
                                <div class="row justify-content-end">
                                    <div class="col-sm-12">
                                        <div>
                                            <button type="submit" class="btn btn-primary w-md"> 
                                           Submit 
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                     <div class="col-md-12">
                    <div class="orderListArea">
                    <div class="canvas_header">
                        <h2>{{$title_two}}</h2>
                    </div>  

                    <!-- orders -->
                    <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                         <form method="post"  action="{{url('admin/user-list-password-change/'.$user->id)}}">
                            @csrf
                                        
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3 ajax-select mt-3 mt-lg-0">
                                        <label class="form-label">Old Password (Required)
                                        </label>    
                                         <input class="form-control" name="old_password" type="password" id="example-text-input" placeholder="write Old password">             
                                    </div>
                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="mb-3 ajax-select mt-3 mt-lg-0">
                                        <label class="form-label">New Password (Required)
                                        </label>    
                                         <input class="form-control" name="new_password" type="password" id="example-text-input" placeholder="write new password">             
                                    </div>
                                    @if ($errors->has('new_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('new_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="mb-3 ajax-select mt-3 mt-lg-0">
                                        <label class="form-label">Password (Required)
                                        </label>    
                                         <input class="form-control" name="confirm_password" type="password" id="example-text-input" placeholder="write Confirm password">             
                                    </div>
                                </div>
                                 
                                            
                                <div class="row justify-content-end">
                                    <div class="col-sm-12">
                                        <div>
                                            <button type="submit" class="btn btn-primary w-md"> 
                                           Submit 
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>  
         <main>
            <!-- Modal for Eligible-->
    @endsection
     
           
    
    
   
