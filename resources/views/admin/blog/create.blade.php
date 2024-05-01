@extends('admin.admin_layouts')

@section('admin_content')
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="#">Starlight</a>
        <span class="breadcrumb-item active">{{$title}}</span>
      </nav>
      <div class="sl-pagebody">
      	   <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">{{$title}} <a href="{{url('admin/get-all-post-index')}}" class="btn btn-success btn-sm pull-right">All Partner List</a></h6>
          <p class="mg-b-20 mg-sm-b-30">{{$title}}</p>
          <form @if(empty($post->id)) action="{{ url('admin/add-edit-post-for-admin') }}"@else action="{{ url('admin/add-edit-post-for-admin/'.$post->id) }}" @endif method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-6">
              	<lebel>Partner Image (Main Thumbnail)<span class="tx-danger">*</span></lebel>
              	<label class="custom-file">
      				  <input type="file" id="file" class="form-control" name="image_one" onchange="readURL(this);" accept="image">
      				  <span class="custom-file-control"></span>
      				  <label for="files" class="imageEditPreviewLavel">
                            <img src="#" id="one" class="imageEditPreview">
                      </label>
      			</label>
                @if(isset($post->image_one))
                <div style="padding: 10px 0px;">
                    <img src="" style="height: 80px; width: 100px;">
                </div>
                <label for="files" class="imageEditPreviewLavel">
                    <img src="{{asset('public/media/post/'.$post->image_one)}}" class="imageEditPreview">
                </label>
                @endif
              </div>
              <div class="col-lg-6">
              	<lebel>Payment Card Image (Main Thumbnail)<span class="tx-danger">*</span></lebel>
              	<label class="custom-file">
      				  <input type="file" id="file" class="form-control" name="image_two" onchange="readURL1(this);" accept="image">
      				  <span class="custom-file-control"></span>
      				  <label for="files" class="imageEditPreviewLavel">
                            <img src="#" id="two" class="imageEditPreview">
                      </label>
      			</label>
                @if(isset($post->image_two))
                <label for="files" class="imageEditPreviewLavel">
                    <img src="{{asset('public/media/card/'.$post->image_two)}}" class="imageEditPreview">
                </label>
                @endif
              </div>
            </div><!-- row -->
            <br><hr>
            <br><br><hr>
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
                  .width(160)
                  .height(150);
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
                  .width(160)
                  .height(150);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script>

@endsection
