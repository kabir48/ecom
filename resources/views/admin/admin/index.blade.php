       @extends('layouts.admin.main')
       @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                    <div class="canvas_header">
                        <h2>{{$title}}</h2>
                        <a href="{{url('admin/user-list-create')}}" class="btn btn-default btn-primary">Create User
                        </a>
                    </div>  

                    <!-- orders -->
                    <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                        <table class="dashboard_Order_status" id="datatable">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Photo</th>
                                    <th>Role Name</th>
                                    <th>Status</th>
                                    <th>Manage<span type="button" class="AscDecTriggerBtn"><img src="{{asset('public/backend/asset/img/arrowdownup.png')}}" alt=""></span>
                                    </th>
                                </tr>
                            </thead>  
                            <tbody  class="dashboard_Order_status_body">
                                @foreach($admins as $key=>$admin)
                                    <tr> 
                                         <td>{{$key+1}}</td>  
                                        <td>{{$admin->name}}</td>
                                        <td>{{$admin->email}}</td>
                                        <td>{{$admin->phone}}</td>
                                        <td>
                                        @if($admin->image_one)
                                        <img src="{{asset('public/media/admin/'.$admin->image_one)}}" width="50">
                                        @else
                                        no data
                                        @endif
                                        </td>
                                        <td>{{$admin->role->name??""}}</td>
                                        <td>
                                            @if($admin->status==1)
                                                <span class="badge bg-success font-size-10">Active
                                                </span>
                                            @else 
                                                <span class="badge bg-danger font-size-10">Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td>  
                                        
                                        
                                            <a target=_blank href="{{url('admin/user-list-update/'.$admin->id)}}" style="padding: 0.4rem 0.8rem;" class="btn btn-outline-primary btn-sm edit" title="Edit Details">
                                        <i class="fas fa-pencil-alt"></i>
                                            </a>
                                         @if(Auth::guard('admin')->user()->role_id=='1')       
                                            <a href="{{url('admin/user-list-check/'.$admin->id)}}" style="padding: 0.4rem 0.8rem;" class="btn btn-outline-success btn-sm edit" title="check">
                                        <i class="fas fa-check"></i>
                                            </a>
                                            
                                            <button title="Delete" style="padding: 0.4rem 0.8rem;" class="btn btn-danger btn-circle btn-sm" data-bs-toggle="modal" data-bs-target="#eligibleModal" onclick="eligibleView({{ $admin->id }})" id="{{ $admin->id }}"><i class="fas fa-trash"></i>
                                            </button>
                                                
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
        
        
           
     
      
    @endsection
     
        <script type="text/javascript">
            function eligibleView(id){
                if(!$('#modal-eligible').hasClass('modal-dialog')){
                    $('#modal-eligible').addClass('modal-dialog');
                }
                $('#eligibleView-modal-body').html(null);
                $('#eligibleModal').modal();
                $.get('{{url('/admin/user-list-delete/') }}/'+id, function(data){
                    $('#eligibleView-modal-body').html(data);
                });
            }
        </script>
    
    
    
   