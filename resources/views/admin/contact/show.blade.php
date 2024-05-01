@extends('admin.admin_layouts')

@section('admin_content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">

    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="#">Starlight</a>
        <span class="breadcrumb-item active">Contact Section</span>
      </nav>
      <div class="sl-pagebody">
      	   <div class="card pd-20 pd-sm-40">
          <p class="mg-b-20 mg-sm-b-30">Contact Details</p>
          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
                  <br>
                  <strong>{{$contactmessage->name}}</strong>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Email: <span class="tx-danger">*</span></label>
                   <br>
                  <strong>{{$contactmessage->email}}</strong>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Phone: <span class="tx-danger">*</span></label>
                  <br>
                  <strong>{{ $contactmessage->phone}}</strong>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Subject:<span class="tx-danger">*</span></label>
                   <br>
                  <strong>{{ $contactmessage->subject}}</strong>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-12">
              	<div class="form-group" style="border:1px solid grey;padding:10px; ">
                  <label class="form-control-label">Message<span class="tx-danger">*</span></label>
                    <br>
                  <p >{!!$contactmessage->message!!}</p>
                </div>
              </div>
            </div>
        </div><!-- card -->

      </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->

@endsection
