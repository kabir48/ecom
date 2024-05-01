    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                    <div class="col-md-12">
                        <div class="orderListArea">
                            <div class="canvas_header">
                                <h2>{{$title}}</h2>
                                @if($aboutCount<1)
                                <a href="{{url('admin/about-create-store')}}" class="btn btn-default btn-primary">Create About Page
                                </a>
                                @endif
                            </div>  
    
                            <!-- orders -->
                            <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                                <table class="dashboard_Order_status" id="datatable">
                                   <thead>
                                        <tr>
                                          <th class="wd-15p">ID</th>
                                          <th class="wd-15p">Name</th>
                                          <th class="wd-15p">Vision</th>
                                          <th class="wd-15p">Banner</th>
                                          <th class="wd-15p">Status</th>
                                          <th class="wd-20p">Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($abouts as $row)
                                        <tr>
                                          <td>{{ $row->id }}</td>
                                          <td>{{ $row->name}}</td>
                                          <td>{{ $row->vision}}</td>
                                          <td style="padding:2px 10px;"><img src="{{asset('public/media/about/'.$row->banner)}}" style="width:44px; height:44px;object-fit:fill"></td>
                                          <td>
                                          	@if($row->status == 1)
                                          	 <span>Active</span>
                                          	@else
                                          	<span>Inactive</span>
                                          	@endif
                                          </td>
                                          <td style="padding: 10px !important;margin:0;">
                                          	<a href="{{ url('admin/about-create-store/'.$row->id) }}" style="padding:4px 10px;" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
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
     

    
    
    
   




