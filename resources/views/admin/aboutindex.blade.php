@extends('admin.admin_layouts')
@section('admin_content')
  <!-- ########## START: MAIN PANEL ########## -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">
    <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Term Table</h5>
        </div><!-- sl-page-title -->
        <div class="card pd-20 pd-sm-40">
           <h6 class="card-body-title">Bpti Information List
              <a href="{{url('get-bpti-cars-add-edit')}}" class="btn btn-sm btn-warning" style="float: right;">Add New</a>
              <a href="{{url('bpti/bpti-car-index')}}" class="btn btn-sm btn-info" style="float: right;">View Car Query Info</a>
          </h6>
          <br>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">ID</th>
                  <th class="wd-15p">Title</th>
                  <th class="wd-15p">Title Bangla</th>
                  <th class="wd-15p">Detail</th>
                  <th class="wd-15p">Detail Bangla</th>
                  <th class="wd-15p">Image</th>
                  <th class="wd-15p">status</th>
                  <th class="wd-20p">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($about as $row)
                <tr>
                  <td>{{$row['id']}}</td>
                  <td>{{$row['name']}}</td>
                  <td>{{$row['name_bangla']}}</td>
                  <td>{{$row['detail']}}</td>
                  <td>{{$row['detail_bangla']}}</td>
                  <td>
                      <img src="{{asset('public/media/bptiabout/'.$row['image'])}}" alt="">
                  </td>
                  <td>TK.{{$row['selling_price']}}</td>
                  <td>
                  	@if($row['status'] == 1)
                  	 <a class="updateSectionStatus" href="javascript:void(0)" id="section-{{$row['id']}}" section_id="{{$row['id']}}">Active</a>
                  	@else
                  	 <a class="updateSectionStatus" href="javascript:void(0)" id="section-{{$row['id']}}" section_id="{{$row['id']}}">Inactive</a>
                  	@endif
                  </td>
                  <td>
                  	<a href="{{ URL::to('gadmin/get-bpti-cars-add-edit-about/'.$row['id']) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                  	<a href="{{ URL::to('admin/delete-section/'.$row['id']) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i></a>
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
