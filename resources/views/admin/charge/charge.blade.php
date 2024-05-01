    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                    <div class="col-md-12">
                        <div class="orderListArea">
                            <div class="canvas_header">
                                <h2>{{$title}}</h2>
                                <a href="{{url('admin/shipping-charge-create-store')}}" class="btn btn-default btn-primary">Create Shipping Charges
                                </a>
                            </div>  
    
                            <!-- orders -->
                            <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                                <table class="dashboard_Order_status" id="datatable">
                                    <thead>
                                        <tr>
                                          <th class="wd-15p">ID</th>
                                          <th class="wd-15p">Country Name</th>
                                          <th class="wd-15p">(0-500)gram</th>
                                          <th class="wd-15p">(501-1000)gram</th>
                                          <th class="wd-15p">(1000-1500)gram</th>
                                          <th class="wd-15p">(1500-2000)gram</th>
                                          <th class="wd-15p">(2000-above)gram</th>
                                          <th class="wd-15p">status</th>
                                          <th class="wd-20p">Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($charges as $row)
                                        <tr>
                                          <td>{{$row['id'] }}</td>
                                          <td>{{$row['country']}}</td>
                                          <td>TK.{{$row['zero']}}</td>
                                          <td>TK.{{$row['fivehundred']}}</td>
                                          <td>TK.{{$row['onethousand']}}</td>
                                          <td>TK.{{$row['twothousand']}}</td>
                                          <td>TK.{{$row['above']}}</td>
                                          <td class='p-0'>
                                            @if($row['status'] == 1)
                                          	 <a class="updateSectionStatus btn btn-success" style='padding:5px 10px' href="javascript:void(0)" id="section-{{$row['id']}}" section_id="{{$row['id']}}">Active</a>
                                          	@else
                                          	 <a class="updateSectionStatus btn btn-warning" style='padding:5px 10px' href="javascript:void(0)" id="section-{{$row['id']}}" section_id="{{$row['id']}}">Inactive</a>
                                          	@endif
                                          </td>
                                          <td class="actionTableData">
                                          	<a href="{{ URL::to('admin/shipping-charge-create-store/'.$row['id']) }}" class="btn btn-sm btn-info">edit</a>
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
                url: '{{url("admin/status-shippingcharge-update")}}',
                data:{status:status,section_id:section_id},
                success:function(resp){
                    if(resp['status']==0){
                        $("#section-"+section_id).html("<a class='updateSectionStatus btn btn-warning' style='padding:5px 10px' href='javascript:(0)'>Inactive</a>");
                    }else if(resp['status']==1){
                        $("#section-"+section_id).html("<a class='updateSectionStatus btn btn-success' style='padding:5px 10px' href='javascript:(0)'>Active</a>");
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
     

    
    
    
   




