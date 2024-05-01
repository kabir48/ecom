@extends('admin.admin_layouts')
@section('admin_content')
  <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Voucher Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Voucher List
          </h6>
          <br>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">ID</th>
                  <th class="wd-15p">User Name</th>
                  <th class="wd-15p">Phone Number</th>
                  <th class="wd-15p">Address</th>
                  <th class="wd-15p">Time</th>
                  <th class="wd-20p">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($happies as $row)
                <tr>
                  <td>{{ $row['id']}}</td>
                  <td>{{ $row['users']['name'] }}</td>
                  <td>{{ $row['users']['phone'] }}</td>
                  <td>{{ $row['users']['address']}}</td>
                  <td>{{Carbon\Carbon::parse($row['created_at'])->diffForHumans()}}</td>
                  <td>
                  	<a href="{{ URL::to('admin/for-happy-member-information-list-invoice/'.$row['id']) }}" class="btn btn-sm btn-danger" target="_blank">Voucher List</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->
      </div><!-- sl-pagebody -->
@endsection
