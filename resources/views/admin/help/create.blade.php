@extends('admin.admin_layouts')

@section('admin_content')
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="#">Starlight</a>
        <span class="breadcrumb-item active">{{ $title }}</span>
      </nav>
      <div class="sl-pagebody">
      	  <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">{{$title}}<a href="{{ url('admin/index-power-help') }}" class="btn btn-success btn-sm pull-right">Back Page</a></h6>
          <p class="mg-b-20 mg-sm-b-30">{{$title}}</p>
          <form @if(empty($term['id'])) action="{{url('admin/create-tearm-help-store-update')}}" @else action="{{url('admin/create-tearm-help-store-update/'.$term['id'])}}" @endif method="post" enctype="multipart/form-data">
          	@csrf
          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Post Title (ENGLISH ): <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="name_en" @if(isset($term['id'])) value="{{$term['name_en']}}" @else value="{{ old('name_en') }}" @endif>
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
                  <input class="form-control" type="text" name="name_bn" @if(isset($term['id'])) value="{{$term['name_bn']}}" @else value="{{ old('name_bn') }}" @endif>
                  @if ($errors->has('name_bn'))
                  <span class="invalid-feedback" role="alert" style="display:block!important;color:violet">
                      <strong>{{ $errors->first('name_bn') }}</strong>
                  </span>
              @endif
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-12">
              	<div class="form-group">
                  <label class="form-control-label">Product Details (English)<span class="tx-danger">*</span></label>
                   <textarea class="form-control" id="summernote" name="detail_en">
                       @if(isset($term['id'])){{$term['detail_en']}} @else {{ old('detail_en') }} @endif
                   </textarea>
                   @if ($errors->has('detail_en'))
                   <span class="invalid-feedback" role="alert">
                       <strong>{{ $errors->first('detail_en') }}</strong>
                   </span>
               @endif
                </div>
              </div>

              <div class="col-lg-12">
              	<div class="form-group">
                  <label class="form-control-label">Product Details (Bangla)<span class="tx-danger">*</span></label>
                   <textarea class="form-control" id="summernote1" name="detail_bn" style="display:block!important;color:violet;padding-top:10px">

                    @if(isset($term['id'])){{$term['detail_bn']}} @else {{ old('detail_bn') }} @endif
                   </textarea>
                   @if ($errors->has('detail_bn'))
                   <span class="invalid-feedback" role="alert">
                       <strong>{{ $errors->first('detail_bn') }}</strong>
                   </span>
               @endif
                </div>
              </div>
                 <div class="col-lg-4 col-sm-4">
               	 	<lebel>Image One (Main Thumbnails)<span class="tx-danger">*</span></lebel><br>
              	     <label class="custom-file">
      				  <input type="file" id="file" class="custom-file-input" name="banner" onchange="readURL(this);"  accept="image">
                        <span class="custom-file-control"></span>
      				    <img src="#" id="one" >
                      </label>
                      <div style="padding: 10px 0px;">
                        @if(isset($term['id']))
                          <img src="{{ URL::to('public/media/tearm/'.$term['banner']) }}" style="height: 80px; width: 100px;">
                          @endif
                      </div>
                    </div>

            </div><!-- row -->
            <br><hr>
            <br><br><hr>
            <div class="form-layout-footer">
              <button class="btn btn-info mg-r-5" type="submit">@if(isset($term['id']))Update @else Submit @endif</button>
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

