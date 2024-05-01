@extends('admin.admin_layouts')
@section('admin_content')
  <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Term Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
           <h6 class="card-body-title">About List
              @if($abouts<1)
              <a href="{{url('admin/create-power-service')}}" class="btn btn-sm btn-warning" style="float: right;">Add New</a>
              @endif

          </h6>

          <br>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">ID</th>
                  <th class="wd-15p">Name_bn</th>
                  <th class="wd-15p">Image</th>
                  <th class="wd-15p">Status</th>
                  <th class="wd-20p">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($service as $row)
                <tr>
                  <td>{{ $row->id }}</td>
                  <td>{{ $row->name_bn}}</td>
                  <td style="padding:2px 10px;"><img src="{{URL::to($row->image_name)}}" style="width:44px; height:44px;object-fit:fill"></td>
                  <td>
                  	@if($row->status == 1)
                  	 <span class="badge badge-success">Active</span>
                  	@else
                  	<span class="badge badge-danger">Inactive</span>
                  	@endif
                  </td>
                  <td class="actionTableData">
                  	<a href="{{ URL::to('admin/edit-tearm-service/'.$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                  	<a href="{{ URL::to('admin/delete-tearm-service/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i></a>
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
