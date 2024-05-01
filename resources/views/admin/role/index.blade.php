    @extends('layouts.admin.main')
    @section('admin_content')
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                    <div class="canvas_header">
                        <h2>{{$title}}</h2>
                        <a href="{{url('admin/role-create-store')}}" class="btn btn-default btn-primary">Create Roles
                        </a>
                    </div>  

                    <!-- orders -->
                    <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                        <table class="dashboard_Order_status" id="datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Manage<span type="button" class="AscDecTriggerBtn"><img src="{{asset('public/backend/asset/img/arrowdownup.png')}}" alt=""></span>
                                    </th>
                                </tr>
                            </thead>  
                            <tbody>
                               @foreach($roles as $role)
                                    <tr>
                                        <td>{{$role->name}}</td>
                                        <td>
                                            <a target="_blank" href="{{url('admin/role-create-store/'.$role->id)}}" class="btn btn-secondary btn-sm edit" title="Edit">
                                           <i class="fas fa-pencil-alt"></i>
                                            </a>
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
    @endsection
     
    
    
    
   
