@extends('admin.admin_layouts')

@section('admin_content')
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="#">Starlight</a>
        <span class="breadcrumb-item active">{{$title}}</span>
      </nav>
      <div class="sl-pagebody">
      	   <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">{{$title}}<a href="{{url('admin/voice-customer-comment-add-index')}}" class="btn btn-danger btn-sm pull-right">All Customer Voice View</a></h6>

          <p class="mg-b-20 mg-sm-b-30">{{$title}}</p>
          <form @if(empty($voice['id'])) action="{{url('admin/voice-customer-comment-add')}}" @else action="{{url('admin/voice-customer-comment-add/'.$voice['id'])}}" @endif  method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Customer Name(ENGLISH ): <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="name" @if(!empty($voice['name'])) value="{{$voice['name']}}" @else value="{{old('name')}}" @endif>
                  @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
                </div>
              </div><!-- col-4 -->
               <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Customer Name(BANGLA): <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="name_bangla" @if(!empty($voice['name_bangla'])) value="{{$voice['name_bangla']}}" @else value="{{old('name_bangla')}}" @endif>
                  @if ($errors->has('name_bangla'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name_bangla') }}</strong>
                    </span>
                @endif
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-6">
              	<div class="form-group">
                  <label class="form-control-label">Comment<span class="tx-danger">*</span></label>
                   <textarea class="form-control" id="summernote1" name="comment">
                       {{old('comment')}}
                   </textarea>
                </div>
              </div>
              <div class="col-lg-6">
              	<div class="form-group">
                  <label class="form-control-label">Commentame(BANGLA):<span class="tx-danger">*</span></label>
                   <textarea class="form-control" id="summernote" name="comment_bangla">
                       {{old('comment_bangla')}}
                   </textarea>
                </div>
              </div>
                <div class="col-lg-4 col-sm-4">
                    <lebel>Image One (Main Thumbnails)<span class="tx-danger">*</span></lebel><br>
                    <label class="custom-file">
                    <input type="file" id="file" class="custom-file-input" name="image_one" onchange="readURL(this);"  accept="image" value="{{$voice['image_one']}}">
                        <span class="custom-file-control"></span>
                        <img src="#" id="one" >
                    </label>
                     @if(isset($voice['image_one']))
                    <div style="padding: 10px 0px;">
                        <img src="{{asset('public/media/voice/'.$voice['image_one'])}}" style="height: 80px; width: 100px;">
                    </div>
                    @endif
                    </div>
                    </div><!-- row -->
                    <br><hr>
                    <br><br><hr>
                    <div class="form-layout-footer">
                        <button class="btn btn-info mg-r-5" type="submit">Submit</button>
                    </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                    </form>
                </div><!-- card -->

      </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" crossorigin="anonymous"></script>
@endsection
