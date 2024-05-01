@extends('admin.admin_layouts')

@section('admin_content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">

    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="#">Starlight</a>
        <span class="breadcrumb-item active">{{$title}}</span>
      </nav>
      <div class="sl-pagebody">
      	   <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">{{$title}} </h6>
          <p class="mg-b-20 mg-sm-b-30">{{$title}}</p>
          <form @if(empty($delivery['id'])) action="{{url('admin/add-delivery-stuff')}}" @else  action="{{url('admin/add-delivery-stuff/'.$delivery['id'])}}" @endif method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label"> Name: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="name"  @if(!empty($delivery['name'])) value="{{$delivery['name']}}" @else value="{{old('name')}}" @endif>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Phone: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="phone"  @if(!empty($delivery['phone'])) value="{{$delivery['phone']}}" @else value="{{old('phone')}}" @endif  required="">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Email (Optional) <span class="tx-danger">*</span></label>
                  <input class="form-control" type="email" name="email" @if(!empty($delivery['email'])) value="{{$delivery['email']}}" @else value="{{old('email')}}" @endif>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Address <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="address" @if(!empty($delivery['address'])) value="{{$delivery['address']}}" @else value="{{old('address')}}" @endif required="">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-6">
              <div class="form-group">
                <label for="name">City</label>
                <select class="form-control" name="city" id="city">
                @foreach($districts as $district)
                <option value="{{$district['name']}}" @if($district['name']==$delivery['city']) Selected @endif>{{$district['name']}}</option>
                @endforeach
                </select>
              </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Image for Stuff: <span class="tx-danger">*</span>
                  <input class="form-control" type="file" name="image_one">
                   @if(!@empty($delivery['image_one']))
                    <div style="height:100px;">
                        <img style="width:100px;height:60px" src="{{asset('public/media/deliveryman/'.$delivery['image_one'])}}" id="one">
                    </div>
                    @endif
                   </label>
                </div>
              </div>
            </div><!-- row -->
            <div class="form-layout-footer">
              <button class="btn btn-info mg-r-5" type="submit">Submit </button>
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
          </form>
        </div><!-- card -->

      </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
<script type="text/javascript">
	function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#one')
                  .attr('src', e.target.result)
                  .width(80)
                  .height(80);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script>
@endsection
