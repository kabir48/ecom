@extends('admin.admin_layouts')
@section('admin_content')
  <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Help Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
           <h6 class="card-body-title">Help List
              @if($tear<1)
              <a href="{{url('admin/create-tearm-help-store-update')}}" class="btn btn-sm btn-warning" style="float: right;">Add New</a>
              @endif
          </h6>
          <br>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">ID</th>
                  <th class="wd-15p">Name_en</th>
                  <th class="wd-15p">Banner</th>
                  <th class="wd-15p">Status</th>
                  <th class="wd-20p">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($tearm as $row)
                <tr>
                  <td>{{ $row->id }}</td>
                  <td>{{ $row->name_en}}</td>
                  <td><img src="{{URL::to('public/media/help/'.$row->banner)}}" height="50px;" width="50px;"></td>
                  <td>
                  	@if($row->status == 1)
                  	 <span class="badge badge-success">Active</span>
                  	@else
                  	<span class="badge badge-danger">Inactive</span>
                  	@endif
                  </td>
                  <td>
                  	<a href="{{ URL::to('admin/create-tearm-help-store-update/'.$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
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
