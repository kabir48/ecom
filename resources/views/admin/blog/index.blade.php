@extends('admin.admin_layouts')
@section('admin_content')
  <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Partner Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Partner List
              @if($countPost<6)
               <a href="{{url('admin/add-edit-post-for-admin')}}" class="btn btn-sm btn-warning" style="float: right;">Add New</a>
               @endif
          </h6>

          <br>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">ID</th>
                  <th class="wd-15p">Image</th>
                  <th class="wd-15p">Payment Card Image</th>
                  <th class="wd-20p">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($post as $row)
                <tr>
                  <td>{{ $row->id}}</td>
                  <td class="actionTableImageData"><img src="{{ URL::to('public/media/post/'.$row->image_one) }}"></td>
                  <td class="actionTableImageData"><img src="{{ URL::to('public/media/card/'.$row->image_two) }}"></td>
                  <td class="actionTableData">
                  	<a href="{{ URL::to('admin/add-edit-post-for-admin/'.$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
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
