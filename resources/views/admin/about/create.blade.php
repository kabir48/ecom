   @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                        <div class="canvas_header">
                            <h2>{{$title}}</h2>
                            <a href="{{url('admin/about-lists')}}" class="btn btn-default btn-primary">Back
                            </a>
                        </div>  

                        <!-- orders -->
                        <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                             <form method="post" @if(empty($about->id)) action="{{url('admin/about-create-store')}}" @else action="{{url('admin/about-create-store/'.$about->id)}}" @endif  enctype="multipart/form-data">
                                @csrf     
                                <div class="row">
                                   <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label" style="margin: 4px 0;">Title (ENGLISH ): <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" name="name" @if(!empty($about['name'])) value="{{$about['name']}}" @else  value="{{old('name')}}" @endif>
                                       @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                       @endif
                                    </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label" style="margin: 4px 0;">Sub Title : <span class="tx-danger">*</span></label>
                                       <input class="form-control" type="text" name="name_bn" @if(!empty($about['name_bn'])) value="{{$about['name_bn']}}" @else  value="{{old('name_bn')}}" @endif>
                                       @if ($errors->has('title_bn'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title_bn') }}</strong>
                                        </span>
                                       @endif
                                    </div>
                                    </div> 
                                    
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label class="form-control-label" style="margin: 4px 0;">Mission Title : <span class="tx-danger">*</span></label>
                                           <input class="form-control" type="text" name="mission" @if(!empty($about['mission'])) value="{{$about['mission']}}" @else  value="{{old('mission')}}" @endif>
                                           @if ($errors->has('title_bn'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('title_bn') }}</strong>
                                            </span>
                                           @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label class="form-control-label" style="margin: 4px 0;">Sub Mission Title: <span class="tx-danger">*</span></label>
                                           <input class="form-control" type="text" name="mission_bn" @if(!empty($about['mission_bn'])) value="{{$about['mission']}}" @else  value="{{old('mission_bn')}}" @endif>
                                           @if ($errors->has('title_bn'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('title_bn') }}</strong>
                                            </span>
                                           @endif
                                        </div>
                                    </div>
                                    
                                    
                                     <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 4px 0;" class="form-control-label">About Company(ENGLISH): <span class="tx-danger">*</span></label>
                                          <textarea class="form-control" name="about_company" style="height:170px !important;resize: none;">@if(isset($about->id)) {{$about->about_company}} @else {{old('about_company')}} @endif</textarea>
                                           @if ($errors->has('ans'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('ans') }}</strong>
                                            </span>
                                           @endif
                                        </div>
                                    </div>
                              
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 4px 0;" class="form-control-label">Mission Text(ENGLISH): <span class="tx-danger">*</span></label>
                                          <textarea class="form-control" name="mission_text" style="height:170px !important;resize: none;">@if(isset($about->id)) {{$about->mission_text}} @else {{old('mission_text')}} @endif</textarea>
                                           @if ($errors->has('ans'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('ans') }}</strong>
                                            </span>
                                           @endif
                                        </div>
                                    </div>
                                    
                                    
                                      <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 4px 0;" class="form-control-label">Mission Text(BANGLA): <span class="tx-danger">*</span></label>
                                          <textarea class="form-control" name="mission_text_bn" style="height:170px !important;resize: none;">@if(isset($about->id)) {{$about->mission_text_bn}} @else {{old('mission_text_bn')}} @endif</textarea>
                                           @if ($errors->has('ans'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('ans') }}</strong>
                                            </span>
                                           @endif
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label class="form-control-label" style="margin: 4px 0;">Vision Title (ENGLISH ): <span class="tx-danger">*</span></label>
                                           <input class="form-control" type="text" name="vision" @if(!empty($about['vision'])) value="{{$about['vision']}}" @else  value="{{old('vision')}}" @endif>
                                           @if ($errors->has('title_bn'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('title_bn') }}</strong>
                                            </span>
                                           @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label class="form-control-label" style="margin: 4px 0;">Vision Title: <span class="tx-danger">*</span></label>
                                           <input class="form-control" type="text" name="vision_bn" @if(!empty($about['vision_bn'])) value="{{$about['vision']}}" @else  value="{{old('vision_bn')}}" @endif>
                                           @if ($errors->has('title_bn'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('title_bn') }}</strong>
                                            </span>
                                           @endif
                                        </div>
                                    </div>
                              
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 4px 0;" class="form-control-label">Vision Text(ENGLISH): <span class="tx-danger">*</span></label>
                                          <textarea class="form-control" name="vision_text" style="height:170px !important;resize: none;">@if(isset($about->id)) {{$about->vision_text}} @else {{old('vision_text')}} @endif</textarea>
                                           @if ($errors->has('ans'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('ans') }}</strong>
                                            </span>
                                           @endif
                                        </div>
                                    </div>
                                    
                                    
                                      <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 4px 0;" class="form-control-label">Vision Text(BANGLA): <span class="tx-danger">*</span></label>
                                          <textarea class="form-control" name="vision_text_bn" style="height:170px !important;resize: none;">@if(isset($about->id)) {{$about->vision_text_bn}} @else {{old('vision_text_bn')}} @endif</textarea>
                                           @if ($errors->has('ans'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('ans') }}</strong>
                                            </span>
                                           @endif
                                        </div>
                                    </div> 
                                    
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 4px 0;" class="form-control-label">Banner</label>
                                          <input type="file" id="file" class="custom-fileinput form-control" name="banner" onchange="readURL(this);">
                                        @if(isset($about->banner))
                                            <label for="file" class="imageEditPreviewLavel mt-4">
                                                <img src="{{url('public/media/about/'.$about->banner)}}" class="imageEditPreview" id="one">
                                           </label>
                                         @endif
                                        </div>
                                    </div>
                                    
                                    
                                 
                                    
                                </div> 
                                                
                                <div class="row justify-content-end">
                                    <div class="col-sm-12">
                                        <div style="margin: 24px 0;">
                                            <button type="submit" class="btn btn-primary w-md"> 
                                              @if(!empty($faq['id'])) Update @else Submit @endif
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>  
         <main>
            <!-- Modal for Eligible-->
            
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
    @endsection
     
           
    
    
   


