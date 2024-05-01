    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                        <div class="canvas_header">
                            <h2>{{$title}}</h2>
                            <a href="{{url('admin/policy-lists')}}" class="btn btn-default btn-primary">Back
                            </a>
                        </div>  

                        <!-- orders -->
                        <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                             <form method="post" @if(empty($policy->id)) action="{{url('admin/policy-create-store')}}" @else action="{{url('admin/policy-create-store/'.$policy->id)}}" @endif enctype="multipart/form-data">
                                @csrf     
                                <div class="row">
                                   <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label" style="margin: 10px 0;">Title (ENGLISH ): <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" name="name_en" @if(isset($policy['id'])) value="{{$policy['name_en']}}" @else value="{{ old('name_en') }}" @endif>
                                       @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                       @endif
                                    </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label" style="margin: 10px 0;">policy Title (BANGLA ): <span class="tx-danger">*</span></label>
                                       <input class="form-control" type="text" name="name_bn" @if(isset($policy['id'])) value="{{$policy['name_bn']}}" @else value="{{ old('name_bn') }}" @endif>
                                       @if ($errors->has('title_bn'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title_bn') }}</strong>
                                        </span>
                                       @endif
                                    </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;" class="form-control-label">Details (ENGLISH): <span class="tx-danger">*</span></label>
                                            <textarea class="form-control" id="elm1" name="detail_en">@if(isset($policy['id'])){{$policy['detail_en']}} @else {{ old('detail_en') }} @endif</textarea>
                                               @if ($errors->has('ans'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('ans') }}</strong>
                                                </span>
                                               @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;" class="form-control-label">policy Ans(ENGLISH): <span class="tx-danger">*</span></label>
                                          <textarea id="elm1" class="form-control" name="detail_bn" row="5" cols="40">@if(isset($policy['id'])){{$policy['detail_bn']}} @else {{ old('detail_bn') }} @endif</textarea>
                                           @if ($errors->has('ans_bn'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('ans_bn') }}</strong>
                                            </span>
                                           @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;" class="form-control-label">policy Ans(ENGLISH): <span class="tx-danger">*</span></label>
                                          <input type="file" id="file" class="custom-fileinput form-control" name="banner" onchange="readURL(this);"  accept="image">
                                          
                                        </div>
                                        <div style="padding: 10px 0px;">
                                            @if(isset($policy['id']))
                                            <label for="file" class="imageEditPreviewLavel">
                                                <img src="{{ URL::to('public/media/policy/'.$policy['banner']) }}" class="imageEditPreview">
                                            </label>
                                            @endif
                                        </div>
                                    </div>
                                </div> 
                                                
                                <div class="row justify-content-end">
                                    <div class="col-sm-12">
                                        <div style="margin: 24px 0;">
                                            <button type="submit" class="btn btn-primary w-md"> 
                                              @if(!empty($policy['id'])) Update @else Submit @endif
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
     
           
    
    
   

