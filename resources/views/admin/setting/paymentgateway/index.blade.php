    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                    <div class="col-md-12">
                        <div class="orderListArea">
                            <div class="canvas_header">
                                <h2>{{$title}}</h2>
                                <a href="{{url('admin/payment-gateway-create-store')}}" class="btn btn-default btn-primary">Create Gateway 
                                </a>
                            </div>  
    
                            <!-- orders -->
                            <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                                <table class="dashboard_Order_status" id="datatable">
                                    <thead>
                                    <tr>
                                      <th class="wd-15p">Store Id/Client Id</th>
                                      <th class="wd-15p">Signature ID / Store password /Screte ID</th>
                                      <th class="wd-15p">Payment Method Name</th>
                                      <th class="wd-15p">Online Or Not</th>
                                      <th class="wd-20p">Action</th>
                                      <th class="wd-20p">Manage</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($payments as $row)
                                    <tr>
                                      <td>{{ Str::limit($row->store_id, 15) }}</td>
                                      <td>{{ Str::limit($row->signature_id, 32) }}</td>
                                      <td>{{ $row->type}}</td>
                                      <td>@if($row->live==1)
                                          <span style="color:green">Live</span>
                                          @else
                                           <span style="color:red">Sandbox</span>
                                          @endif
                                      </td>
                                      <td>
                                      	@if($row->status == 1)
                                          	 <a class="updateSectionStatus" href="javascript:void(0)" id="section-{{$row->id}}" section_id="{{$row->id}}">Active</a>
                                        @else
                                          	 <a class="updateSectionStatus" href="javascript:void(0)" id="section-{{$row->id}}" section_id="{{$row->id}}">Inactive</a>
                                        @endif
                                      </td>
                                      <td class="actionTableData">
                                      	<a href="{{url('admin/payment-gateway-create-store/'.$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
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
                url: '{{url("admin/status-paymentgateway-update")}}',
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
     

    
    
    
   



