    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                        <div class="canvas_header">
                            <h2>{{$title}}</h2>
                            <a href="{{url('admin/faq-lists')}}" class="btn btn-default btn-primary">Back
                            </a>
                        </div>  

                        <!-- orders -->
                        <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                             <form method="post" @if(empty($faq->id)) action="{{url('admin/faq-create-store')}}" @else action="{{url('admin/faq-create-store/'.$faq->id)}}" @endif>
                                @csrf     
                                <div class="row">
                                   <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label" style="margin: 10px 0;">Faq Title (ENGLISH ): <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" name="title" @if(isset($faq['id'])) value="{{$faq['title']}}" @else value="{{ old('title') }}" @endif>
                                       @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                       @endif
                                    </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label" style="margin: 10px 0;">Faq Title (BANGLA ): <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" name="title_bn" @if(isset($faq['id'])) value="{{$faq['title_bn']}}" @else value="{{ old('title_bn') }}" @endif>
                                       @if ($errors->has('title_bn'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title_bn') }}</strong>
                                        </span>
                                       @endif
                                    </div>
                                    </div>
                                    
                              
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;" class="form-control-label">Faq Ans(ENGLISH): <span class="tx-danger">*</span></label>
                                          
                                           <textarea id="elm1" name="ans" class="form-control">@if(isset($faq['id'])) {{$faq['ans']}} @else {{ old('ans') }} @endif</textarea>
                                           @if ($errors->has('ans'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('ans') }}</strong>
                                            </span>
                                           @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;">Faq Ans(ENGLISH)</label>
                                          
                                          <textarea id="elm1" name="ans_bn" rows="5" cols="40" class="form-control">@if(isset($faq['id'])){{$faq['ans_bn']}} @else {{ old('ans_bn') }} @endif</textarea>
                                           @if ($errors->has('ans_bn'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('ans_bn') }}</strong>
                                            </span>
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
    @endsection
     
           
    
    
   

