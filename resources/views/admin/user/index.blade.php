    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                    <div class="canvas_header">
                        <h2>{{$title}}</h2>
                        @if($camCount<1)
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#campModal" data-bs-whatever="@fat">Create Campaign</button>
                        @endif
                    </div>  

                    <!-- orders -->
                    <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                        <table class="dashboard_Order_status" id="datatable">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Online Status</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>  
                            <tbody  class="dashboard_Order_status_body">
                                @foreach($users as $key=>$user)
                                    <tr> 
                                         <td>{{$key+1}}</td>  
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>
                                           	@if($user->status == 1)
                                              	 <a class="updateSectionStatus" href="javascript:void(0)" id="section-{{$user->id}}" section_id="{{$user->id}}">Active</a>
                                            @else
                                              	 <a class="updateSectionStatus" href="javascript:void(0)" id="section-{{$user->id}}" section_id="{{$user->id}}">Inactive</a>
                                            @endif
                                        </td>
                                        <td>
                                             <?php
                                                $isOnline=App\User::onlineUser($user->id);
                                             ?>
                                             @if($isOnline)
                                             <span class="badge bg-success font-size-10">Online</span>
                                             @else
                                             <span class="badge bg-danger font-size-10">Offline</span>
                                             @endif
                                        </td>
                                         <td class="actionTableData">
                                             <a href="javascript:void(0)" class="confirmDelete btn btn-sm btn-danger" record="user-status" recordid="{{$user->id}}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                        <table class="dashboard_Order_status" id="datatable">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Note</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>  
                            <tbody  class="dashboard_Order_status_body">
                                @foreach($cams as $key=>$cam)
                                    <tr> 
                                         <td>{{$cam->id}}</td>  
                                        <td>{{$cam->title}} </td>
                                        <?php
                                            $next=Carbon\Carbon::now()->toDateString();
                                            // {{Carbon\Carbon::now()->toDateString()}}
                                        ?>
                                        <td>{!! Str::limit($cam->note,20) !!}</td>
                                        <td class="actionTableImageData">
                                            <img src="{{asset('public/media/post/'.$cam->image)}}" width="40">
                                        </td>
                                        <td>
                                           	@if($user->status == 1)
                                              	 <a class="updateCamStatus" href="javascript:void(0)" id="cam-{{$cam->id}}" cam_id="{{$cam->id}}">Active</a>
                                            @else
                                              	 <a class="updateCamStatus" href="javascript:void(0)" id="cam-{{$cam->id}}" cam_id="{{$cam->id}}">Inactive</a>
                                            @endif
                                        </td>
                                  
                                         <td class="actionTableData">
                                             <a href="javascript:void(0)" class="confirmDelete btn btn-sm btn-danger" record="cam-user" recordid="{{$cam->id}}"><i class="fa fa-trash"></i></a>
                                             <a href="{{url('admin/cam-send-offer/'.$cam->id)}}" class="badge bg-success d-flex align-items-center"><i class="fa fa-check"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>  
            </div>  
         <main>
        
        <!-- Modal for Eligible-->
        <div class="modal fade" id="campModal" tabindex="-1" aria-labelledby="campModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="campModalLabel">Campaign To user</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="post" action="{{url('admin/add-campaing')}}" enctype="multipart/form-data">
                    @csrf
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Title:</label>
                    <input type="text" name="title" class="form-control" id="recipient-name">
                  </div>
                  
                  <div class="mb-3">
                    <label for="message-text" class="col-form-label">Message:</label>
                    <textarea class="form-control" name="note" id="message-text"></textarea>
                  </div>
                  
                  <div class="mb-3">
                    <label for="message-text" class="col-form-label">Image:</label>
                    <input type="file" name="image" class="form-control" >
                  </div>
                     <div class="modal-footer">
                        
                        <button type="submit" class="btn btn-primary">Send</button>
                      </div>
                </form>
              </div>
           
            </div>
          </div>
        </div>
    
       <script type="text/javascript">
             $(function(){
                    'use strict';
            $(".updateSectionStatus").click(function(e){
              var status = $(this).text();
              var section_id = $(this).attr("section_id");
              $.ajax({
                type:'post',
                url: '{{url("admin/status-user-update")}}',
                data:{status:status,section_id:section_id},
                success:function(resp){
                    if(resp['status']==0){
                        $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:(0)'>Inactive</a>");
                    }else if(resp['status']==1){
                        $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:(0)'>Active</a>");
                    }
            
                  },error:function(){
                      alert('Error')
                  }
               });
            
              });
              });
            
        </script>
        
         <script type="text/javascript">
             $(function(){
                    'use strict';
            $(".updateCamStatus").click(function(e){
              var status = $(this).text();
              var cam_id = $(this).attr("cam_id");
              $.ajax({
                type:'post',
                url: '{{url("admin/status-cam-update")}}',
                data:{status:status,cam_id:cam_id},
                success:function(resp){
                    if(resp['status']==0){
                        $("#cam-"+cam_id).html("<a class='updateCamStatus' href='javascript:(0)'>Inactive</a>");
                    }else if(resp['status']==1){
                        $("#cam-"+cam_id).html("<a class='updateCamStatus' href='javascript:(0)'>Active</a>");
                    }
            
                  },error:function(){
                      alert('Error')
                  }
               });
            
              });
              });
            
        </script>
      
    @endsection
    
    
   