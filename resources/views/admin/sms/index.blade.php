    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                    <div class="col-md-12">
                        <div class="orderListArea">
                            <div class="canvas_header">
                                <h2>{{$title}}</h2>
                                <a href="{{url('admin/smsgateway-create-store')}}" class="btn btn-default btn-primary">Create SMS Gateway
                                </a>
                            </div>  
    
                            <!-- orders -->
                            <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                                <table class="dashboard_Order_status" id="datatable">
                                    <thead>
                                        <tr>
                                          <th>Title</th>
                                          <th>Api Key/Token/UserId</th>
                                          <th>Client/Password</th>
                                          <th>Sender Id</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($gateways as $row)
                                     
                                        <tr>
                                          <td>{{ $row->title }}</td>
                                          <td>{{ $row->api_key }}</td>
                                           <td>{{ $row->client_id }}</td>
                                          <td>{{$row->sender_id }}</td>
                                            <td>
                                          	@if($row->status == 1)
                                          	 <a class="updateSectionStatus" href="javascript:void(0)" id="section-{{$row->id}}" section_id="{{$row->id}}">Active</a>
                                          	@else
                                          	 <a class="updateSectionStatus" href="javascript:void(0)" id="section-{{$row->id}}" section_id="{{$row->id}}">Inactive</a>
                                          	@endif
                                          </td>
                                          <td class="actionTableData">
                                          	<a href="{{ url('admin/smsgateway-create-store/'.$row->id) }}" class="btn btn-sm btn-info">Edit</a>
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
             
                  
        <!-- Modal for Eligible-->
        
        <div class="modal fade" id="eligibleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document" id="modal-eligible">
            <div class="modal-content">
              <div class="modal-body" id="eligibleView-modal-body">
                 
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
        
        
        <script type="text/javascript">
            function eligibleView(id){
                if(!$('#modal-eligible').hasClass('modal-dialog')){
                    $('#modal-eligible').addClass('modal-dialog');
                }
                $('#eligibleView-modal-body').html(null);
                $('#eligibleModal').modal();
                $.get('{{url('/admin/category-delete/') }}/'+id, function(data){
                    $('#eligibleView-modal-body').html(data);
                });
            }
        </script>
      
    @endsection
     

    
    
    
   

