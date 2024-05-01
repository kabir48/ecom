    @extends('layouts.admin.main')
       @section('title',$title)
       @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                    <div class="col-md-12">
                        <div class="orderListArea">
                            <div class="canvas_header">
                                <h2>{{$title}}</h2>
                                <a href="{{url('admin/filter-create-store')}}" class="btn btn-default btn-primary">Create filter
                                </a>
                            </div>  
    
                            <!-- orders -->
                            <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                                <table class="dashboard_Order_status" id="datatable">
                                    <thead>
                                        <tr>
                                          <th>Category Id</th>
                                          <th>Filter Name</th>
                                          <th>Filter Column</th>
                                          <th>status</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($filters as $row)
                                        <tr>
                                            
                                          <td><?php
                                               $catNames=explode(",",$row->category_id);
                                               foreach($catNames as $name){
                                                   $getName=App\Model\Admin\Category::getCategoryName($name);
                                                   echo $getName ." ";
                                               }
                                            ?></td>
                                          <td>{{ $row->filter_name}}</td>
                                          <td>{{ $row->filter_column}}</td>
                                          <td class="p-0">
                                          	@if($row->status == 1)
                                          	 <a class="updatefilterStatus btn btn-success" style='padding:5px 10px' href="javascript:void(0)" id="filter-{{$row->id}}" filter_id="{{$row->id}}">Active</a>
                                          	@else
                                          	 <a class="updatefilterStatus btn btn-warning" style='padding:5px 10px' href="javascript:void(0)" id="filter-{{$row->id}}" filter_id="{{$row->id}}">Inactive</a>
                                          	@endif
                                          </td>
                                          <td>
                                          	<a href="{{url('admin/filter-create-store/'.$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
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
            $(".updatefilterStatus").click(function(e){
              var status = $(this).text();
              var filter_id = $(this).attr("filter_id");
              $.ajax({
                type:'post',
                url: '{{url("admin/status-filter-update")}}',
                data:{status:status,filter_id:filter_id},
                success:function(resp){
                    if(resp['status']==0){
                        $("#filter-"+filter_id).html("<a class='updatefilterStatus btn btn-warning' style='padding:5px 10px' href='javascript:(0)'>Inactive</a>");
                    }else if(resp['status']==1){
                        $("#filter-"+filter_id).html("<a class='updatefilterStatus btn btn-success' style='padding:5px 10px' href='javascript:(0)'>Active</a>");
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
     

    
    
    
   
