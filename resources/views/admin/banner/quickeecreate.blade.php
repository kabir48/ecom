@extends('admin.admin_layouts')

@section('admin_content')
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="#">Starlight</a>
        <span class="breadcrumb-item active">{{ $title }}</span>
      </nav>
      <div class="sl-pagebody">
      	  <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">{{$title}}<a href="{{ url('for-banner-page-quickee-index') }}" class="btn btn-success btn-sm pull-right">Back Page</a></h6>
          <p class="mg-b-20 mg-sm-b-30">{{$title}}</p>
          <form @if(empty($term['id'])) action="{{url('for-banner-page-quickee')}}" @else action="{{url('for-banner-page-quickee/'.$term['id'])}}" @endif method="post" enctype="multipart/form-data">
          	@csrf
          <div class="form-layout">
            <div class="row mg-b-25">

              <div class="col-lg-6">
                  <div class="form-group">
                  <label class="form-control-label">Event_status(English): <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="event_status" @if(isset($term['id'])) value="{{$term['event_status']}}" @else value="{{ old('event_status') }}" @endif>
                  @if ($errors->has('event_status'))
                  <span class="invalid-feedback" role="alert" style="display:block!important;color:violet">
                      <strong>{{ $errors->first('event_status')}}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="col-lg-6">
                  <div class="form-group">
                  <label class="form-control-label">Event_status(Bangla): <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="event_status_bangla" @if(isset($term['id'])) value="{{$term['event_status_bangla']}}" @else value="{{ old('event_status_bangla') }}" @endif>
                  @if ($errors->has('event_status'))
                  <span class="invalid-feedback" role="alert" style="display:block!important;color:violet">
                      <strong>{{ $errors->first('event_status')}}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="col-lg-6">
                  <div class="form-group">
                  <label class="form-control-label">Title(English): <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="title" @if(isset($term['id'])) value="{{$term['title']}}" @else value="{{ old('title') }}" @endif>
                  @if ($errors->has('title'))
                  <span class="invalid-feedback" role="alert" style="display:block!important;color:violet">
                      <strong>{{ $errors->first('title')}}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="col-lg-6">
                  <div class="form-group">
                  <label class="form-control-label">Title(Bangla): <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="title_bangla" @if(isset($term['id'])) value="{{$term['title_bangla']}}" @else value="{{ old('title_bangla') }}" @endif>
                  @if ($errors->has('title_bangla'))
                  <span class="invalid-feedback" role="alert" style="display:block!important;color:violet">
                      <strong>{{ $errors->first('title_bangla')}}</strong>
                  </span>
                  @endif
                </div>
              </div>
                 <div class="col-lg-4 col-sm-4">
               	 	<lebel>Image Banner (Main Slider)<span class="tx-danger">*</span></lebel><br>
              	     <label class="custom-file">
      				  <input type="file" id="file" class="custom-file-input" name="image_one" onchange="readURL(this);"  accept="image">
                        <span class="custom-file-control"></span>
      				    <img src="#" id="one" >
                      </label>
                      <div style="padding: 10px 0px;">
                        @if(isset($term['id']))
                          <img src="{{ URL::to('public/media/quickeebanner/'.$term['image_one']) }}" style="height: 80px; width: 100px;">
                          @endif
                      </div>
                    </div>

                     <div class="col-lg-4 col-sm-4">
               	 	<lebel>Image Side Bar (side image)<span class="tx-danger">*</span></lebel><br>
              	     <label class="custom-file">
      				  <input type="file" id="file" class="custom-file-input" name="image_two" onchange="readURL1(this);"  accept="image">
                        <span class="custom-file-control"></span>
                        <label for="file" class="imageEditPreviewLavel">
                            <img src="#" id="two" class="imageEditPreview">
                        </label>
                      </label>
                        @if(isset($term['id']))
                        <label for="file" class="imageEditPreviewLavel">
                            <img src="{{ URL::to('public/media/quickeebanner/small/'.$term['image_two']) }}" class="imageEditPreview">
                        </label>
                        @endif
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

<script type="text/javascript">
	function readURL1(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#two')
                  .attr('src', e.target.result)
                  .width(80)
                  .height(80);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script>
@endsection


