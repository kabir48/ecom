@extends('admin.admin_layouts')
@section('admin_content')
  <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Term Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
           <h6 class="card-body-title">Flygar List
              <a href="{{url('admin/voice-customer-comment-add')}}" class="btn btn-sm btn-warning" style="float: right;">Add New</a>

          </h6>

          <br>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">ID</th>
                  <th class="wd-15p">name</th>
                  <th class="wd-15p">Image</th>
                  <th class="wd-15p">Status</th>
                  <th class="wd-20p">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($voice as $row)
                <tr>
                  <td>{{ $row->id }}</td>
                  <td>{{ $row->name}}</td>
                  <td><img src="{{asset('public/media/voice/'.$row->image_one)}}" height="50px;" width="50px;"></td>
                  <td>
                  	@if($row->status == 1)
                  	 <span class="badge badge-success">Active</span>
                  	@else
                  	<span class="badge badge-danger">Inactive</span>
                  	@endif
                  </td>
                  <td>
                  	<a href="{{ URL::to('admin/voice-customer-comment-add/'.$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                  	<a href="{{ URL::to('admin/voice-customer-comment-delete/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i></a>
                      	@if($row->status == 1)
                  		<a href="{{ URL::to('admin/active-customer-voice/'.$row->id) }}" class="btn btn-sm btn-success" title="active"><i class="fa fa-thumbs-up"></i></a>
                  	    @else
                  		<a href="{{ URL::to('admin/inactive-active-customer-voice/'.$row->id) }}" class="btn btn-sm btn-danger" title="Inactive"><i class="fa fa-thumbs-down"></i></a>
                  	   @endif
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
