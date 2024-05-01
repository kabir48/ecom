@extends('admin.admin_layouts')
@section('admin_content')
  <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Main Banner Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
           <h6 class="card-body-title">Banner Page List
              <a href="{{url('for-banner-page-quickee')}}" class="btn btn-sm btn-warning" style="float: right;">Add New</a>
          </h6>

          <br>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">ID</th>
                  <th class="wd-15p">Title</th>
                  <th class="wd-15p">event_status</th>
                  <th class="wd-15p">Banner</th>
                  <th class="wd-15p">Status</th>
                  <th class="wd-20p">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($quickeeBanner as $row)
                <tr>
                  <td>{{ $row->id }}</td>
                  <td>{{ $row->title}}</td>
                  <td>{{ $row->event_status}}</td>
                  <td class="actionTableImageData"><img src="{{URL::to('public/media/quickeebanner/'.$row->image_one)}}"></td>
                  <td>
                  	@if($row->status == 1)
                  	 <span class="badge badge-success">Active</span>
                  	@else
                  	<span class="badge badge-danger">Inactive</span>
                  	@endif
                  </td>
                  <td class="actionTableData">
                  	<a href="{{ URL::to('for-banner-page-quickee/'.$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->
      </div><!-- sl-pagebody -->
  </div>



@endsection
