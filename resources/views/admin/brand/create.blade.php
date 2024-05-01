    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                        <div class="canvas_header">
                            <h2>{{$title}}</h2>
                            <a href="{{url('admin/brand-lists')}}" class="btn btn-default btn-primary">Back
                            </a>
                        </div>  

                        <!-- orders -->
                        <form method="post" @if(empty($brand->id)) action="{{url('admin/brand-create-store')}}" @else action="{{url('admin/brand-create-store/'.$brand->id)}}" @endif enctype="multipart/form-data">
                                @csrf
                                            
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-lg-right col-12 col-lg-3" style="margin: 4px 0;">Brand Name (ENGLISH ): <span class="tx-danger">*</span></label>
                                    <div class="col-sm-12 col-lg-7">
                                        <input class="form-control" type="text" name="brand_name" value="{{$brand->brand_name}}" placeholder="Type brand in english">
                                       @if ($errors->has('brand_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('brand_name') }}</strong>
                                        </span>
                                       @endif
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-lg-right col-12 col-lg-3" style="margin: 4px 0;">Brand Bangla Name (BANGLA):</label>
                                    <div class="col-sm-12 col-lg-7">
                                        <input class="form-control" type="text" name="bangla_name" value="{{$brand->bangla_name}}" placeholder="Type brand in bangla">
                                       @if ($errors->has('bangla_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bangla_name') }}</strong>
                                        </span>
                                       @endif
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-lg-right col-12 col-lg-3" style="margin: 4px 0;">Image <span class="tx-danger">*</span></label>
                                    <div class="col-sm-12 col-lg-7">
                                        <input class="form-control" type="file" name="brand_logo" id="brandImage">
                                          @if($brand->brand_logo)
                                          <label  for="brandImage" class="imageEditPreviewLavel">
                                           <img src="{{asset('public/media/brand/'.$brand->brand_logo) }}" class="imageEditPreview">
                                           </label>
                                           @endif
                                    </div>
                                </div>
                                
                                <div class="row ">
                                        <div class="col-lg-6 offset-lg-3 col-sm-12">
                                            <div style="margin: 24px 0;">
                                                <button type="submit" class="btn btn-primary w-md"> 
                                               @if(empty($brand->id)) Submit @else Update @endif
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                            </form>
                    </div>
                </div>
            </div>  
         <main>
            <!-- Modal for Eligible-->
    @endsection
     
           
    
    
   
