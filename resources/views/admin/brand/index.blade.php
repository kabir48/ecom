    @extends('layouts.admin.main')
       @section('title',$title)
       @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                    <div class="col-md-12">
                        <div class="orderListArea">
                            <div class="canvas_header">
                                <h2>{{$title}}</h2>
                                <a href="{{url('admin/brand-create-store')}}" class="btn btn-default btn-primary">Create brand
                                </a>
                            </div>  
    
                            <!-- orders -->
                            <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                                <table class="dashboard_Order_status" id="datatable">
                                    <thead>
                                        <tr>
                                          <th>Name_en</th>
                                          <th>Name_bn</th>
                                          <th>Brand Logo</th>
                                          <th>status</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($brands as $row)
                                        <tr>
                                          <td>{{ $row->brand_name}}</td>
                                          <td>{{ $row->bangla_name}}</td>
                                          <td style="padding:3px"><img src="{{asset('public/media/brand/'.$row->brand_logo) }}" style="width:44px;height:44px;object-fit:contain;"></td>
                                          <td class="p-0">
                                          	@if($row->status == 1)
                                          	 <a class="updatebrandStatus btn btn-success" style="padding:5px 10px" href="javascript:void(0)" id="brand-{{$row->id}}" brand_id="{{$row->id}}">Active</a>
                                          	@else
                                          	 <a class="updatebrandStatus btn btn-warning" style="padding:5px 10px" href="javascript:void(0)" id="brand-{{$row->id}}" brand_id="{{$row->id}}">Inactive</a>
                                          	@endif
                                          </td>
                                          <td style="padding:2px 10px;margin:0px">
                                          	<a href="{{url('admin/brand-create-store/'.$row->id) }}" style="padding:5px 10px" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
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
            $(".updatebrandStatus").click(function(e){
              var status = $(this).text();
              var brand_id = $(this).attr("brand_id");
              $.ajax({
                type:'post',
                url: '{{url("admin/status-brand-update")}}',
                data:{status:status,brand_id:brand_id},
                success:function(resp){
                    if(resp['status']==0){
                        $("#brand-"+brand_id).html("<a class='updatebrandStatus btn btn-warning' style='padding:5px 10px' href='javascript:(0)'>Inactive</a>");
                    }else if(resp['status']==1){
                        $("#brand-"+brand_id).html("<a class='updatebrandStatus btn btn-success' style='padding:5px 10px' href='javascript:(0)'>Active</a>");
                    }
            
                  },error:function(){
                      alert('Error')
                  }
               });
                $(this).css('padding','0');
              });
              });
            
        </script>
      
    @endsection
     

    
    
    
   
