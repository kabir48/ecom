    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                    <div class="col-md-12">
                        <div class="orderListArea">
                            <div class="canvas_header">
                                <h2>{{$title}}</h2>
                                <a href="{{url('admin/banner-create-store')}}" class="btn btn-default btn-primary">Create Category
                                </a>
                            </div>  
    
                            <!-- orders -->
                            <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                                <table class="dashboard_Order_status" id="datatable">
                                     <thead>
                                        <tr>
                                          <th>ID</th>
                                          <th>Title</th>
                                          <th>Sub Title</th>
                                          <th>Tag</th>
                                          <th>Banner</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($banners as $row)
                                        <tr>
                                          <td>{{ $row->id }}</td>
                                          <td>{{ $row->meta_title}}</td>
                                          <td>{{ $row->sub_title}}</td>
                                          <td>{{ $row->tag}}</td>
                                          <td style="padding:2px 10px;"><img src="{{URL::to('public/media/banner/'.$row->banner)}}" style="width:44px; height:44px;object-fit:fill"></td>
                                           <td>
                                          	@if($row->status == 1)
                                          	 <a class="updateSectionStatus" href="javascript:void(0)" id="section-{{$row->id}}" section_id="{{$row->id}}">Active</a>
                                          	@else
                                          	 <a class="updateSectionStatus" href="javascript:void(0)" id="section-{{$row->id}}" section_id="{{$row->id}}">Inactive</a>
                                          	@endif
                                          </td>
                                          <td style="padding: 10px !important;margin:0;display:flex !important;gap:10px">
                                          	<a href="{{ url('admin/banner-create-store/'.$row->id) }}" style="padding:4px 10px;" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                          	<a href="{{ url('admin/banner-banner-delete/'.$row->id) }}" style="padding:4px 10px;" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i></a>
                                          </td>
                                        </tr>
                                        @endforeach
                                      </tbody>
                                </table>
                            </div>
                        </div>
                    </div>  
                </div>  
            </div>  
        <main>
        
        <script type="text/javascript">
             $(function(){
                    'use strict';
            $(".updateSectionStatus").click(function(e){
              var status = $(this).text();
              var section_id = $(this).attr("section_id");
              $.ajax({
                type:'post',
                url: '{{url("admin/status-category-update")}}',
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
      
    @endsection
     

    
    
    
   


