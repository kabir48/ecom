@extends('admin.admin_layouts')
@section('admin_content')
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="#">Starlight</a>
        <span class="breadcrumb-item active">Service Section</span>
      </nav>
      <div class="sl-pagebody">
      	   <div class="card pd-20 pd-sm-40">
          @if(isset($alldata))
          <h6 class="card-body-title">Edit Service <a href="{{url('admin.index-power-service')}}" class="btn btn-danger btn-sm pull-right">All Service</a></h6>
          @else
          <h6 class="card-body-title">New Service Add <a href="{{route('admin.index-power-service')}}" class="btn btn-success btn-sm pull-right">All Service</a></h6>
          @endif
          @if(isset($alldata))
          <p class="mg-b-20 mg-sm-b-30">Edit Service form</p>
          @else
          <p class="mg-b-20 mg-sm-b-30">New Service add form</p>
          @endif
          <form action="{{(@$alldata)?url('admin/update/tearm-service/'.$alldata->id):url('admin/create-tearm-service/store')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">name_en Title (ENGLISH ): <span class="tx-danger">*</span></label>
                  <input class="form-control" type="{{@$alldata->name}}" name="name_en" value="{{@$alldata->name_en}}">
                  @if ($errors->has('name_en'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name_en') }}</strong>
                    </span>
                  @endif
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Post Title (BANGLA ): <span class="tx-danger">*</span></label>
                  <input class="form-control" type="{{@$alldata->name_bn}}" name="name_bn" value="{{@$alldata->name_bn}}">
                  @if ($errors->has('name_bn'))
                  <span class="invalid-feedback" role="alert" style="display:block!important;color:violet">
                      <strong>{{ $errors->first('name_bn') }}</strong>
                  </span>
                  @endif
                </div>
              </div><!-- col-4 -->
                <div class="col-lg-6">
              	<div class="form-group">
                  <label class="form-control-label">title Details (English)<span class="tx-danger">*</span></label>
                   <textarea class="form-control" name="title">
                        {{@$alldata->title}}
                   </textarea>
                   @if ($errors->has('title'))
                   <span class="invalid-feedback" role="alert">
                       <strong>{{ $errors->first('title') }}</strong>
                   </span>
                   @endif
                </div>
              </div>

               <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">title_bn Title (BANGLA ): <span class="tx-danger">*</span></label>
                  <input class="form-control" type="{{@$alldata->title_bn}}" name="title_bn" value="{{@$alldata->title_bn}}">
                  @if ($errors->has('title_bn'))
                  <span class="invalid-feedback" role="alert" style="display:block!important;color:violet">
                      <strong>{{ $errors->first('title_bn') }}</strong>
                  </span>
                   @endif
                </div>
              </div><!-- col-4 -->
                  <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">title_one Title (English): <span class="tx-danger">*</span></label>
                  <input class="form-control" type="{{@$alldata->title_one}}" name="title_one" value="{{@$alldata->title_one}}">
                  @if ($errors->has('title_one'))
                  <span class="invalid-feedback" role="alert" style="display:block!important;color:violet">
                      <strong>{{ $errors->first('title_one') }}</strong>
                  </span>
                 @endif
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">title_one_bn Title (BANGLA ): <span class="tx-danger">*</span></label>
                  <input class="form-control" type="{{@$alldata->title_one_bn}}" name="title_one_bn" value="{{@$alldata->title_one_bn}}">
                  @if ($errors->has('title_one_bn'))
                  <span class="invalid-feedback" role="alert" style="display:block!important;color:violet">
                      <strong>{{ $errors->first('title_one_bn') }}</strong>
                  </span>
                 @endif
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-12">
              	<div class="form-group">
                  <label class="form-control-label">detail_en<span class="tx-danger">*</span></label>
                   <textarea class="form-control" id="summernote" name="detail_en">
                         {{@$alldata->detail_en}}
                   </textarea>
                </div>
              </div>
              <div class="col-lg-12">
              	<div class="form-group">
                  <label class="form-control-label">detail_bn<span class="tx-danger">*</span></label>
                   <textarea class="form-control" id="summernote1" name="detail_bn">
                     {{@$alldata->detail_bn}}
                   </textarea>
                </div>
              </div>

                     <div class="col-lg-4 col-sm-4">
               	 	<lebel>Banner One (Main Thumbnails)<span class="tx-danger">*</span></lebel><br>
              	     <label class="custom-file">
      				  <input type="file" id="file" class="custom-file-input" name="banner" onchange="readURL(this);"  value="{{@$alldata->banner}}">
                        <span class="custom-file-control"></span>
                        <input type="hidden" name="old_one" value="{{@$alldata->banner}}">
      				  <img src="#" id="one" >
                      </label>
                      <div style="padding: 10px 0px;">
                          <img src="{{ URL::to(@$alldata->banner) }}" style="height: 80px; width: 100px;">
                      </div>
                    </div>

                      <div class="col-lg-4 col-sm-4">
               	 	<lebel>Image two (Main Thumbnails)<span class="tx-danger">*</span></lebel><br>
              	     <label class="custom-file">
      				  <input type="file" id="file" class="custom-file-input" name="image_name" onchange="readURL(this);"  value="{{@$alldata->image_name}}">
                        <span class="custom-file-control"></span>
                        <input type="hidden" name="old_two" value="{{@$alldata->image_name}}">
      				    <img src="#" id="two" >
                      </label>
                      <div style="padding: 10px 0px;">
                          <img src="{{ URL::to(@$alldata->image_name) }}" style="height: 80px; width: 100px;">
                      </div>
                    </div>

            </div><!-- row -->
            <br><hr>
            <br><br><hr>
            <div class="form-layout-footer">
              <button class="btn btn-info mg-r-5" type="submit">{{(@$alldata)?"Update Form":"Submit Form"}}</button>
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
                  .width(100)
                  .height(100);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script>

<script type="text/javascript">
	function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#two')
                  .attr('src', e.target.result)
                  .width(100)
                  .height(100);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script>
@endsection
