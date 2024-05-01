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
                                          <th>ID</th>
                                          <th>Name</th>
                                          <th>Phone</th>
                                          <th>Message</th>
                                          <th>Products</th>
                                          <th>Sizes</th>
                                          <th>Price Ranges</th>
                                          <th>Status</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($preOrders as $row)
                                        <tr>
                                          <td>{{ $row->id }}</td>
                                          <td>{{ $row->name}}</td>
                                          <td>
                                              <a target="_blank" href="https://wa.me/+{{$row->phone}}">{{$row->phone}}</a>
                                            </td>
                                          <td>{{ $row->message}}</td>
                                          <td>
                                                <?php
                                                    $categoryId=explode(",",$row->product_id);
                                                    $categories=App\Model\Admin\Category::whereIn('id',$categoryId)->get();
                                                ?>
                                                @foreach($categories as $category)
                                                 {{$category->category_name}},
                                                @endforeach
                                          </td>
                                          <td>{{ $row->size}}</td>
                                          <td>
                                              <?php
                                                  $ranges=$row->range;
                                                  echo  $ranges = preg_replace('/(\d+)(\D+)(\d+)/', '$1-$3', $ranges);
                                              ?>
                                          </td>
                                           <td>
                                          	@if($row->status == 1)
                                          	 <a class="updateSectionStatus" href="javascript:void(0)" id="section-{{$row->id}}" section_id="{{$row->id}}">Active</a>
                                          	@else
                                          	 <a class="updateSectionStatus" href="javascript:void(0)" id="section-{{$row->id}}" section_id="{{$row->id}}">Inactive</a>
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
                url: '{{url("admin/status-preorder")}}',
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
     

    
    
    
   


