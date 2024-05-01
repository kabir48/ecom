    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                        <div class="canvas_header">
                            <h2>{{$title}}</h2>
                            <a href="{{url('admin/sitesetting-lists')}}" class="btn btn-default btn-primary">Back
                            </a>
                        </div>  

                        <!-- orders -->
                        <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                            <form method="post" @if(empty($info['id'])) action="{{ url('admin/sitesetting-create-store')}}" @else action="{{ url('admin/sitesetting-create-store/'.$info['id'])}}"@endif enctype="multipart/form-data" id="categoryForm">
                                @csrf     
                                <div class="row">
                                   <div class="col-lg-4">
                                    <div class="form-group">
                                       <label class="form-control-label" style="margin: 4px 0;"> Company Name: <span class="tx-danger">*</span></label>
                                       <input class="form-control" type="text" name="company_name"  required="" value="{{$info['company_name']}}">
                                     </div>
                                    </div>
                                   
                                   <div class="col-lg-4">
                                        <div class="form-group">
                                          <label style="margin: 4px 0;" class="form-control-label">Phone Number One<span class="tx-danger">*</span></label>
                                          <input class="form-control" type="text" name="phone_one"  required="" value="{{$info['phone_one']}}">
                                           
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                          <label style="margin: 4px 0;" class="form-control-label">Phone Numer Two</label>
                                          <input class="form-control" type="text" name="phone_two"  required="" value="{{$info['phone_two']}}">
                                           
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                          <label style="margin: 4px 0;" class="form-control-label">Company Email<span class="tx-danger">*</span></label>
                                          <input class="form-control" type="email" name="email"  required="" value="{{$info['email']}}">
                                           
                                        </div>
                                    </div> 
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                          <label style="margin: 4px 0;" class="form-control-label">Minimum Order<span class="tx-danger">*</span></label>
                                          <input class="form-control" type="text" name="minimum_order"  required="" value="{{$info['minimum_order']}}" placeholder="Tell How Much Customer Need to Order">
                                           
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                          <label style="margin: 4px 0;" class="form-control-label">Maximum Order<span class="tx-danger">*</span></label>
                                          <input class="form-control" type="text" name="maximum_order"  required="" value="{{$info['maximum_order']}}"  placeholder="Tell How Much Customer Need to Order">
                                           
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 4px 0;" class="form-control-label">Short Description (300 words only)</label>
                                          <textarea class="form-control" style="height:14rem !important;resize: none;" type="text" name="short" >{{$info['short']}}</textarea>
                                           
                                        </div>
                                    </div>
                                    
                                     <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 4px 0;" class="form-control-label">Company Description<span class="tx-danger">*</span></label>
                                          <textarea class="form-control" style="height:14rem !important;resize: none;" type="text" name="description" >{{$info['description']}}</textarea>
                                           
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 4px 0;" class="form-control-label">Keyword for seo<span class="tx-danger">*</span></label>
                                          <input class="form-control" type="text" name="keyword"  value="{{$info['keyword'] }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 4px 0;" class="form-control-label">YouTube Link<span class="tx-danger">*</span></label>
                                          <input class="form-control" type="text" name="youtube"  required="" value="{{ $info['youtube']}}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 4px 0;" class="form-control-label">Instagram Link<span class="tx-danger">*</span></label>
                                          <input class="form-control" type="text" name="instagram"  required="" value="{{$info['instagram']}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 4px 0;" class="form-control-label">Twitter Link<span class="tx-danger">*</span></label>
                                          <input class="form-control" type="text" name="twitter"  required="" value="{{$info['twitter']}}">
                                        </div>
                                    </div>
                                    
                                     <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 4px 0;" class="form-control-label">Facebook Link<span class="tx-danger">*</span></label>
                                          <input class="form-control" type="text" name="facebook"  required="" value="{{$info['facebook']}}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 4px 0;" class="form-control-label">Company Address<span class="tx-danger">*</span></label>
                                          <input class="form-control" type="text" name="company_address"  required="" value="{{$info['company_address']}}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                         <div class="form-group">
                                         <label style="margin: 4px 0;" class="form-control-label">Company Logo(74x74px)<span class="tx-danger">*</span></label>
                                          <input type="file" id="file" class="form-control" name="logo" onchange="readURL(this);"  accept="image">
                                        </div>
                                           @if($info['logo'])
                                           <label for="brandImage" class="imageEditPreviewLavel">
                                            <img src="{{url('public/media/logo/'.$info['logo'])}}" id="one" class="imageEditPreview">
                                           </label>
                                           @else
                                           <label for="brandImage" class="imageEditPreviewLavel">
                                            <img src="" class="imageEditPreview" id="one">
                                           </label>
                                           @endif
                                    </div>
                                    
                                     <div class="col-lg-6">
                                         <div class="form-group">
                                         <label style="margin: 4px 0;" class="form-control-label">Image (use cover image seo)(250,250px)<span class="tx-danger">*</span></label>
                                          <input type="file" id="file" class="form-control" name="seo" onchange="readURL(this);"  accept="image">
                                        </div>
                                           @if($info['logo'])
                                           <label for="brandImage" class="imageEditPreviewLavel">
                                            <img src="{{url('public/media/logo/seo/'.$info['seo'])}}" id="one" class="imageEditPreview">
                                           </label>
                                           @else
                                           <label for="brandImage" class="imageEditPreviewLavel">
                                            <img src="" class="imageEditPreview" id="two">
                                           </label>
                                           @endif
                                    </div>
                                </div> 
                                                
                                <div class="row justify-content-end">
                                    <div class="col-sm-12">
                                        <div style="margin: 24px 0;">
                                            <button type="submit" class="btn btn-primary w-md"> 
                                           @if(empty($info->id)) Submit @else Update @endif
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
                      .width(80)
                      .height(80);
              };
              reader.readAsDataURL(input.files[0]);
          }
       }
    </script> 
    
      <script type="text/javascript">
    	function readURL(input) {
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

    
    
   
    
   

