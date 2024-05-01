    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row m-0">
                    <div class="col-md-12 p-0">
                        <div class="orderListArea">
                            <div class="canvas_header">
                                <h2>{{$title}}</h2>
                                <a href="{{url('admin/add-edit-category')}}" class="btn btn-default btn-primary">Create Category
                                </a>
                            </div>  
    
                            <!-- orders -->
                            <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                                <table class="dashboard_Order_status" id="datatable">
                                    <thead>
                                        <tr>
                                          <th>Category Name</th>
                                          <th>Section Name</th>
                                          <th>Parent Category</th>
                                          <th>Image</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($category as $row)
                                        @if(!isset($row->parentcategory->category_name))
                                        <?php
                                           $parent_category = "None";
                                        ?>
                                        @else
                                        <?php
                                            $parent_category = $row->parentcategory->category_name;
                                        ?>
                                        @endif
                                        <tr>
                                          <td>{{ $row->category_name }}</td>
                                           <td>{{ $row->section->name??"Please Add Section" }}</td>
                                          <td>{{ $parent_category }}</td>
                                          <td style="padding-top:0px;padding-bottom:0px;"><img src="{{asset('public/media/category/large/'.$row->image)}}" style="width:46px;height:46px;object-fit:fill;" title="{{ $row->category_name }}"></td>
                                            <td class='p-0'>
                                          	@if($row->status == 1)
                                          	 <a class="updateSectionStatus btn btn-success" style='padding:5px 10px' href="javascript:void(0)" id="section-{{$row->id}}" section_id="{{$row->id}}">Active</a>
                                          	@else
                                          	 <a class="updateSectionStatus btn btn-warning" style='padding:5px 10px' href="javascript:void(0)" id="section-{{$row->id}}" section_id="{{$row->id}}">Inactive</a>
                                          	@endif
                                          </td>
                                          <td class="d-flex">
                                          	<a href="{{ URL::to('admin/add-edit-category/'.$row->id) }}" style="padding: 0.4rem 0.8rem;margin-right:1rem;" class="btn btn-sm btn-info">Edit</a>
                                          	<button title="Delete" class="btn btn-danger btn-circle btn-sm" data-bs-toggle="modal" data-bs-target="#eligibleModal" onclick="eligibleView({{ $row->id }})" id="{{ $row->id }}" style="padding: 4px 1rem;"><i class="fas fa-trash"></i>
                                            </button
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
     

    
    
    
   

