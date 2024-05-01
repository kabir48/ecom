    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                    <div class="col-md-12">
                        <div class="orderListArea">
                            <div class="canvas_header">
                                <h2>{{$title}}</h2>
                                <a href="{{url('admin/page-builder-create-store')}}" class="btn btn-default btn-primary">Create Page
                                </a>
                            </div>  
    
                            <!-- orders -->
                            <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                                <table class="dashboard_Order_status" id="datatable">
                                   <thead>
                                    <tr>
                                      <th class="wd-15p">ID</th>
                                      <th class="wd-15p">Section Part</th>
                                      <th class="wd-15p">Sub Title</th>
                                      <th class="wd-15p">Banner</th>
                                      <th class="wd-15p">Status</th>
                                      <th class="wd-20p">Action</th>
                                    </tr>
                                  </thead>
                                <tbody>
                                    @foreach($pages as $row)
                                    <tr>
                                      <td>{{ $row->id }}</td>
                                      <td>{{ $row->section}}</td>
                                      <td>{{ str_limit($row->sub_title,20)}}</td>
                                      <td><img src="{{URL::to('public/media/page/'.$row->banner)}}" height="50px;" width="50px;"></td>
                                      <td>
                                      	@if($row->status == 1)
                                      	 <span class="badge badge-success">Active</span>
                                      	@else
                                      	<span class="badge badge-danger">Inactive</span>
                                      	@endif
                                      </td>
                                      <td>
                                      	<a href="{{ URL::to('admin/page-builder-create-store/'.$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
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
    @endsection
