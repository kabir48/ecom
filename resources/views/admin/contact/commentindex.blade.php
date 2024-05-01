    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                    <div class="canvas_header">
                        <h2>{{$title}}</h2>
                    </div>  

                    <!-- orders -->
                    <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                        <table class="dashboard_Order_status" id="datatable">
                           <thead>
                            <tr>
                              <th class="wd-15p">Name</th>
                              <th class="wd-15p">User</th>
                              <th class="wd-15p">Message</th>
                              <th class="wd-15p">Replaied By</th>
                              <th class="wd-15p">Time</th>
                              <th class="wd-15p">Status</th>
                              <th class="wd-20p">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($comments as $row)
            
                              <td>{{ $row['product']['product_name']??""}} </td>
                              <td>{{ $row['users']['name']}}</td>
                              <td>{{ $row['comment']}}</td>
                              <td>
                                  <?php
                                      $productReplay=App\ProductReplay::with('admins')->where('comment_id',$row['id'])->first();
                                      $productReplayCount=App\ProductReplay::with('admins')->where('comment_id',$row['id'])->count();
                                  ?>
                                  {{$productReplay->comment_replay??"Yet To Replay"}} by ({{$productReplay->admins->name??""}}) 
                              </td>
                              <td>{{Carbon\Carbon::parse($row['created_at'])->diffForHumans()}}</td>
                               <td>
                                  	@if($row['status'] == 1)
                                  	 <a class="updateSectionStatus" href="javascript:void(0)" id="section-{{$row['id']}}" section_id="{{$row['id']}}">Active</a>
                                  	@else
                                  	 <a class="updateSectionStatus" href="javascript:void(0)" id="section-{{$row['id']}}" section_id="{{$row['id']}}">Inactive</a>
                                  	@endif
                                  </td>
                                <td>                  
                                    <a target=_blank href="{{url('admin/user-list-update/'.$row['id'])}}" class="btn btn-outline-primary btn-sm edit" title="Edit Details"><i class="fas fa-pencil-alt"></i></a>
                                  @if($productReplayCount>0)
                                  Sent Already
                                  @else
                                   <button title="Delete" class="btn btn-success btn-circle btn-sm" data-bs-toggle="modal" data-bs-target="#eligibleModal" onclick="eligibleView({{$row['id']}})" id="{{$row['id']}}"><i class="fas fa-comment"></i></button>
                                  @endif
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
                url: '{{url("admin/status-comment-update")}}',
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
                $.get('{{url('/admin/customer-comment-replay/') }}/'+id, function(data){
                    $('#eligibleView-modal-body').html(data);
                });
            }
        </script>
      
    @endsection

    
    
    
   
