    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                    <div class="col-md-12">
                        <div class="orderListArea">
                            <div class="canvas_header">
                                <h2>{{$title}}</h2>
                                <a href="{{url('admin/coupon-store-update')}}" class="btn btn-default btn-primary">Create Coupon
                                </a>
                            </div>  
    
                            <!-- orders -->
                            <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                                <table class="dashboard_Order_status" id="datatable">
                                    <thead>
                                        <tr>
                                          <th>ID</th>
                                          <th>Coupon Code</th>
                                          <th>Coupon Type</th>
                                          <th>Amount</th>
                                          <th>Users</th>
                                          <th>Expiry Date</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($coupons as $row)
                                        <tr>
                                          <td>{{ $row['id']}}</td>
                                          <td>{{ $row['coupon_code'] }}</td>
                                          <td>{{ $row['coupon_type'] }}</td>
                                          <td>{{ $row['amount'] }}
                                              @if($row['amount_type']=="Percentage")
                                              %
                                              @else
                                              Taka
                                              @endif
                                          </td>
                                          <td style="display:inline-block">
                                              {{ $row['users']}}
                                          </td>
                                          <td>{{ $row['expiry_date'] }}</td>
                        
                                            <td class='p-0'>
                                          	@if($row['status'] == 1)
                                          	 <a class="updateSectionStatus btn btn-success" style='padding:5px 10px' href="javascript:void(0)" id="section-{{$row['id']}}" section_id="{{$row['id']}}">Active</a>
                                          	@else
                                          	 <a class="updateSectionStatus btn btn-warning" style='padding:5px 10px' href="javascript:void(0)" id="section-{{$row['id']}}" section_id="{{$row['id']}}">Inactive</a>
                                          	@endif
                                          </td>
                                          <td class="actionTableData">
                                          	<a href="{{ URL::to('admin/coupon-store-update/'.$row['id']) }}" class="btn btn-sm btn-info">edit</a>
                                          	<a href="{{ URL::to('admin/coupon-delete-/'.$row['id']) }}" class="btn btn-sm btn-danger" id="delete">delete</a>
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
     

    
    
    
   


