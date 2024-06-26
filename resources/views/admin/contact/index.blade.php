@extends('admin.admin_layouts')
@section('admin_content')
  <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Term Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
           <h6 class="card-body-title">All Message List
          </h6>

          <br>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">ID</th>
                  <th class="wd-15p">Name</th>
                  <th class="wd-15p">Email</th>
                  <th class="wd-15p">Phone</th>
                  <th class="wd-15p">Subject</th>
                  <th class="wd-15p">Message</th>
                  <th class="wd-20p">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($contactmessages as $row)
                <tr class="{{$row->status == 0 ? 'unreaded' : ''}}">
                  <td>{{ $row->id }}</td>
                  <td>{{ $row->name}}</td>
                  <td>{{ $row->email}}</td>
                  <td>{{ $row->phone}}</td>
                  <td>{{ $row->subject}}</td>
                  <td>{{ $row->message}}</td>
                  <td>
                  	@if($row->status == 1)
                  	 <span class="badge badge-success">Active</span>
                  	@else
                  	<span class="badge badge-danger">Inactive</span>
                  	@endif
                  </td>
                  <td>
                  	<a href="{{ URL::to('admin/contact-view/show/'.$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                  	<a href="{{ URL::to('admin/contact-view/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i></a>
                  	@if($row->status == 1)
                  		<a href="{{ URL::to('inactive/contact/'.$row->id) }}" class="btn btn-sm btn-danger" title="Inactive"><i class="fa fa-thumbs-down"></i></a>
                  	@else
                  		<a href="{{ URL::to('active/contact/'.$row->id) }}" class="btn btn-sm btn-success" title="Active"><i class="fa fa-thumbs-up"></i></a>
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
