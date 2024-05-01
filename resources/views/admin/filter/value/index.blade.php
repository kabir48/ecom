    @extends('layouts.admin.main')
       @section('title',$title)
       @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                    <div class="col-md-12">
                        <div class="orderListArea">
                            <div class="canvas_header">
                                <h2>{{$title}}</h2>
                                <a href="{{url('admin/filter-value-create-store')}}" class="btn btn-default btn-primary">Create filter
                                </a>
                            </div>  
    
                            <!-- orders -->
                            <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                                <table class="dashboard_Order_status" id="datatable">
                                    <thead>
                                        <tr>
                                          <th>Filter Id</th>
                                          <th>Filter Value</th>
                                          <th>status</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($values as $row)
                                        <tr>
                                          <td>
                                            <?php
                                         
                                                 echo $getFilter=App\ProductFilter::getFilterName($row->filter_id);
                                              
                                            ?>
                                          </td>
                                          <td>{{ $row->filter_value}}</td>
                                          <td class="p-0">
                                          	@if($row->status == 1)
                                          	 <a class="updatevalueStatus btn btn-success" style='padding:5px 10px' href="javascript:void(0)" id="value-{{$row->id}}" value_id="{{$row->id}}">Active</a>
                                          	@else
                                          	 <a class="updatevalueStatus btn btn-warning" style='padding:5px 10px' href="javascript:void(0)" id="value-{{$row->id}}" value_id="{{$row->id}}">Inactive</a>
                                          	@endif
                                          </td>
                                          <td class="m-0">
                                          	<a href="{{url('admin/filter-value-create-store/'.$row->id) }}" style="padding:5px 10px" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
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
            $(".updatevalueStatus").click(function(e){
              var status = $(this).text();
              var value_id = $(this).attr("value_id");
              $.ajax({
                type:'post',
                url: '{{url("admin/status-filter-value-update")}}',
                data:{status:status,value_id:value_id},
                success:function(resp){
                    if(resp['status']==0){
                        $("#value-"+value_id).html("<a class='updatevalueStatus btn btn-warning' style='padding:5px 10px' href='javascript:(0)'>Inactive</a>");
                    }else if(resp['status']==1){
                        $("#value-"+value_id).html("<a class='updatevalueStatus btn btn-success' style='padding:5px 10px' href='javascript:(0)'>Active</a>");
                    }
            
                  },error:function(){
                      alert('Error')
                  }
               });
            $(this).css("padding", "0");
              });
              });
            
        </script>
      
    @endsection
     

    
    
    
   
