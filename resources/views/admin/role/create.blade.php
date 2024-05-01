       @extends('layouts.admin.main')
       @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                    <div class="canvas_header">
                        <h2>{{$title}}</h2>
                        <a href="{{url('admin/role-lists')}}" class="btn btn-default btn-primary">Back
                        </a>
                    </div>  

                    <!-- orders -->
                    <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                          <form method="post" @if(empty($roles->id)) action="{{url('admin/role-create-store')}}" @else action="{{url('admin/role-create-store/'.$roles->id)}}" @endif>
                              @csrf
                                        
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3 ajax-select mt-3 mt-lg-0">
                                        <label class="form-label">Name (Required)
                                        </label>    
                                       <input name="name" type="text" class="form-control" id="horizontal-firstname-input" value="{{$roles->name}}" placeholder="Enter Role Name ">
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
            <main>
            <!-- Modal for Eligible-->
        @endsection
      
           
    
    
   

