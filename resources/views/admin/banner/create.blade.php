   @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                        <div class="canvas_header">
                            <h2>{{$title}}</h2>
                            <a href="{{url('admin/banner-lists')}}" class="btn btn-default btn-primary">Back
                            </a>
                        </div>  

                        <!-- orders -->
                        <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                            <form method="post" @if(empty($banner['id'])) action="{{ url('admin/banner-create-store')}}" @else action="{{ url('admin/banner-create-store/'.$banner['id'])}}" @endif enctype="multipart/form-data" id="categoryForm">
                                @csrf     
                                <div class="row">
                                   <div class="col-lg-4">
                                    <div class="form-group">
                                      <label class="form-control-label" style="margin: 10px 0;"> Section: <span class="tx-danger">*</span></label>
                                        <select class="form-control" name="tag" id="tag">
                                        <option value="">Select Tag</option>
                                        <?php
                                            $tags=['Campaign','Festival','Offer','Whole Sale'];
                                        ?>
                                      	@foreach($tags as $tag)
                                      	<option value="{{$tag}}" @if($banner['tag']==$tag) selected @endif>{{$tag}}</option>
                                      	@endforeach
                                      </select>
                                     </div>
                                    </div>
                                    
                                   <div class="col-lg-4">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;" class="form-control-label"> Title<span class="tx-danger">*</span></label>
                                           <input class="form-control" type="text" name="meta_title" @if(isset($banner['id'])) value="{{$banner['meta_title']}}" @else value="{{ old('meta_title') }}" @endif>
                                           
                                        </div>
                                    </div> 
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;" class="form-control-label">Sub Title</label>
                                           <input class="form-control" type="text" name="sub_title" @if(isset($banner['id'])) value="{{$banner['sub_title']}}" @else value="{{ old('sub_title') }}" @endif>
                                           
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;" class="form-control-label">Tag</label>
                                           <input class="form-control" type="text" name="tag_one" @if(isset($banner['id'])) value="{{$banner['tag_one']}}" @else value="{{ old('tag_one') }}" @endif>
                                           
                                        </div>
                                    </div>
                                    
                                     <div class="col-lg-4">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;" class="form-control-label">Tag Two<span class="tx-danger">*</span></label>
                                           <input class="form-control" type="text" name="tag_two" @if(isset($banner['id'])) value="{{$banner['tag_two']}}" @else value="{{ old('tag_two') }}" @endif>
                                           
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;" class="form-control-label">Sort The Order<span class="tx-danger">*</span></label>
                                           <input class="form-control" type="number" name="sort" @if(isset($banner['id'])) value="{{$banner['sort']}}" @else value="{{ old('sort') }}" @endif>
                                           
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                         <div class="form-group">
                                         <label style="margin: 10px 0;">Banner (1920X600)<span class="tx-danger">*</span></label>
                                           <input type="file" id="image" class="form-control" name="banner" onchange="readURL(this);"  accept="image">
                                        
                                         @if(!@empty($banner['banner']))
                                         <label for="image" class="imageEditPreviewLavel">
                                           <img src="{{asset('public/media/banner/'.$banner['banner'])}}" id="two" class="imageEditPreview">
                                           </label>
                                          @endif
                                         </div>
                                    </div>
                                </div> 
                                                
                                <div class="row justify-content-end">
                                        <div class="col-sm-12">
                                            <div style="margin: 24px 0;">
                                                <button type="submit" class="btn btn-primary w-md"> 
                                               @if(empty($banner->id)) Submit @else Update @endif
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
    
    
   
    
   




