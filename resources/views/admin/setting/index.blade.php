    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                    <div class="col-md-12">
                        <div class="orderListArea">
                            <div class="canvas_header">
                                <h2>{{$title}}</h2>
                                @if($settinCount<1)
                                <a href="{{url('admin/sitesetting-create-store')}}" class="btn btn-default btn-primary">Create Setting
                                </a>
                                @endif
                            </div>  
    
                            <!-- orders -->
                            <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                                <table class="dashboard_Order_status" id="datatable">
                                    <thead>
                                    <tr>
                                      <th class="wd-15p">ID</th>
                                      <th class="wd-15p">Company Name</th>
                                      <th class="wd-15p">Company Phone Number</th>
                                      <th class="wd-15p">Company Email</th>
                                      <th class="wd-15p">Maximum Order</th>
                                      <th class="wd-15p">Minimum Order</th>
                                      <th class="wd-15p">Logo</th>
                                      <th class="wd-20p">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($setting as $row)
                                    <tr>
                                      <td>{{ $row->id }}</td>
                                      <td>{{ $row->company_name}}</td>
                                      <td>{{ $row->phone_one}}</td>
                                      <td>{{ $row->email}}</td>
                                      <td>{{ $row->maximum_order}}</td>
                                      <td>{{ $row->minimum_order}}</td>
                                      <td class="padding: 0px auto;"><img src="{{asset('public/media/logo/'.$row->logo)}}" style="width:44px;height:44px;object-fit:fill;"></td>
                                      <td>
                                      	<a href="{{url('admin/sitesetting-create-store/'.$row->id)}}" style="padding:4px 10px;" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
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
     

    
    
    
   


