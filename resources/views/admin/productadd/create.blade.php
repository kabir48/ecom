    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                        <div class="canvas_header">
                            <h2>{{$title}}</h2>
                            <a href="{{url('admin/index-addproduct')}}" class="btn btn-default btn-primary">Back
                            </a>
                        </div>  

                        <!-- orders -->
                        <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                                <form @if(empty($addproduct['id']))action="{{url('admin/add-edit-addproduct')}}"@else action="{{url('admin/add-edit-addproduct/'.$addproduct['id'])}}" @endif method="post" enctype="multipart/form-data">
                                  @csrf
                                  <div class="form-layout">
                                      <div class="form-group row">
                                          <label class="col-form-label text-lg-right col-12 col-lg-3">Add Title (ENGLISH ): <span class="tx-danger">*</span></label>
                                          <div class="col-sm-12 col-lg-6">
                                                <input class="form-control" type="text" name="add_title" @if(!empty($addproduct['add_title'])) value="{{$addproduct['add_title']}}" @else value="{{old('add_title')}}" @endif>
                                               @if ($errors->has('add_title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('add_title') }}</strong>
                                                </span>
                                               @endif
                                          </div>
                                      </div>
                                      
                                      <div class="form-group row">
                                          <label class="col-form-label text-lg-right col-12 col-lg-3">Add Location: <span class="tx-danger">*</span></label>
                                          <div class="col-sm-12 col-lg-6">
                                            <select class="form-control" name="location">
                                              <option>Select Location</option>
                                              <option value="listing" @if($addproduct['location']=='listing') selected @endif>Listing</option>
                                              <option value="front" @if($addproduct['location']=='front') selected @endif>Front Page and  Email Marketing</option>
                                            </select>
                                           @if ($errors->has('add_title_bangla'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('add_title_bangla') }}</strong>
                                            </span>
                                           @endif
                                          </div>
                                      </div>
                                      
                                      <div class="form-group row">
                                          <label class="col-form-label text-lg-right col-12 col-lg-3">Short Detail: <span class="tx-danger">*</span></label>
                                          <div class="col-sm-12 col-lg-6">
                                            <input class="form-control" type="text" name="add_short_detail" @if(!empty($addproduct['add_short_detail'])) value="{{$addproduct['add_short_detail']}}" @else value="{{old('add_short_detail')}}" @endif>
                                           @if ($errors->has('add_title_bangla'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('add_title_bangla') }}</strong>
                                            </span>
                                           @endif
                                          </div>
                                      </div>
                                      
                                       <div class="form-group row">
                                          <label class="col-form-label text-lg-right col-12 col-lg-3">Add Lasting Date: <span class="tx-danger">*</span></label>
                                          <div class="col-sm-12 col-lg-6">
                                            <input class="form-control" type="date" name="date" @if(!empty($addproduct['date'])) value="{{$addproduct['date']}}" @else value="{{old('date')}}" @endif>
                                           @if ($errors->has('date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('date') }}</strong>
                                            </span>
                                           @endif
                                          </div>
                                      </div>
                                      
                                      <div class="form-group row">
                                          <label class="col-form-label text-lg-right col-12 col-lg-3">Image for Add Banner (300x300): <span class="tx-danger">*</span></label>
                                          <div class="col-sm-12 col-lg-6">
                                            <input class="form-control" type="file" name="image_one" id="ImageUpload">
                                            @if(!@empty($addproduct['image_one']))
                                              <label for="ImageUpload" class="imageEditPreviewLavel">
                                               <img src="{{asset('public/media/addproduct/'.$addproduct['image_one'])}}" id="one" class="imageEditPreview">
                                               </label>
                                            @endif
                                          </div>
                                      </div>
                                    
                                    <div class="form-layout-footer row">
                                      <div class="col-12 col-lg-6 offset-lg-3">
                                          <button class="btn btn-info mg-r-5" type="submit">Submit</button>
                                      </div>
                                    </div><!-- form-layout-footer -->
                                  </div><!-- form-layout -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>  
         <main>
            <!-- Modal for Eligible-->
    @endsection
     
           
    
    
   


