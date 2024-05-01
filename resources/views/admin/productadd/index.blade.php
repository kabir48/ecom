    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
        <main class="ContentBody">
            <div class="row">
                    <div class="col-md-12">
                        <div class="orderListArea">
                            <div class="canvas_header">
                                <h2>{{$title}}</h2>
                                <a href="{{url('admin/add-edit-addproduct')}}" class="btn btn-default btn-primary">Create Adds
                                </a>
                            </div>  
    
                            <!-- orders -->
                            <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                                <table class="dashboard_Order_status" id="datatable">
                                   <thead>
                                        <tr>
                                          <th class="wd-15p">ID</th>
                                          <th class="wd-15p">Title</th>
                                          <th class="wd-15p">Add Image</th>
                                          <th class="wd-15p">Status</th>
                                          <th class="wd-20p">Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($data as $row)
                                        <tr>
                                          <td>{{ $row->id }}</td>
                                          <td>{{ $row->add_title}}</td>
                                          <td class="actionTableImageData"><img src="{{asset('public/media/addproduct/'.$row->image_one)}}"></td>
                                          <td>
                                          	@if($row->status == 1)
                                          	 <span class="badge badge-success">Send</span>
                                          	@else
                                          	<span class="badge badge-danger">Not Send</span>
                                          	@endif
                                          </td>
                                          <td class="actionTableData">
                                            @if($row->status == 0 && $row->location == "front")
                                          	<a title="send mail" href="{{ URL::to('admin/send-mail-individual/'.$row->id) }}" class="btn btn-sm btn-success"><i class="fa fa-envelope"></i></a>
                                          	@endif
                                          	<a title="edit" href="{{ URL::to('admin/add-edit-addproduct/'.$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                          	<a title="delete" href="{{ URL::to('admin/delete-addproduct/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i></a>
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
                url: '{{url("admin/status-faq-update")}}',
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
