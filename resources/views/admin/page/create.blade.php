    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                        <div class="canvas_header">
                            <h2>{{$title}}</h2>
                            <a href="{{url('admin/page-builder-lists')}}" class="btn btn-default btn-primary">Back
                            </a>
                        </div>  

                        <!-- orders -->
                        <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                             <form @if(empty($page['id'])) action="{{url('admin/page-builder-create-store')}}" @else action="{{ url('admin/page-builder-create-store/'.$page['id']) }}" @endif method="post" enctype="multipart/form-data">
                                @csrf     
                                <div class="row">
                                    <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Section Title (ENGLISH ): <span class="tx-danger">*</span></label>
                                        <select class="form-control" name="section" id="section">
                                            <option>Select Section</option>
                                            @foreach($sections as $section)
                                            <option value="{{$section}}" <?php if($page['section'] === $section){ echo "selected";} ?>>{{$section}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('section'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('section') }}</strong>vv
                                        </span>
                                        @endif
                                    </div>
                                </div><!-- col-4 --> 
                                
                                @if(!empty($page['mission']) || !empty($page['vission']))
                                    <div id="missionId" style="display:none">
                                        <div class="col-lg-6">
                                          	<div class="form-group">
                                               <label class="form-control-label">Mission </label>
                                               <textarea class="form-control" id="summernote1" name="mission">
                                                @if($page['mission']) {{$page['mission']}} @else {{old('mission')}} @endif
                                                </textarea>
                                                @if ($errors->has('mission'))
                                                    <span class="invalid-feedback" role="alert">
                                                       <strong>{{ $errors->first('mission') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                         <div class="col-lg-6">
                                          	<div class="form-group">
                                               <label class="form-control-label">Details</label>
                                               <textarea class="form-control" id="summernote2" name="vission">
                                                @if($page['vission']) {{$page['vission']}} @else {{old('vission')}} @endif
                                                </textarea>
                                                @if ($errors->has('vission'))
                                                    <span class="invalid-feedback" role="alert">
                                                       <strong>{{ $errors->first('vission') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                                
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Sub Title :</label> 
                                            <input class="form-control" type="text" name="sub_title" @if(!empty($page['sub_title'])) value="{{$page['sub_title']}}" @else  value="{{old('sub_title')}}" @endif>
                                            @if ($errors->has('sub_title'))
                                            <span class="invalid-feedback" role="alert" style="display:block!important;color:violet">
                                              <strong>{{ $errors->first('sub_title') }}</strong>
                                            </span>
                                           @endif
                                        </div>
                                    </div><!-- col-4 --> 
                                    <div class="col-lg-6" id="detail">
                                      	<div class="form-group">
                                           <label class="form-control-label">Details</label>
                                           <textarea class="form-control" id="summernote" name="text">
                                            @if($page['text']) {{$page['text']}} @else {{old('text')}} @endif
                                            </textarea>
                                            @if ($errors->has('text'))
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $errors->first('text') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 4px 0;" class="form-control-label">Banner</label>
                                          <input type="file" id="file" class="custom-fileinput form-control" name="banner" onchange="readURL(this);">
                                        @if(isset($page->banner))
                                            <label for="file" class="imageEditPreviewLavel mt-4">
                                                <img src="{{url('public/media/page/'.$page->banner)}}" class="imageEditPreview" id="one">
                                           </label>
                                         @endif
                                        </div>
                                    </div>
                                </div> 
                                                
                                <div class="row justify-content-end">
                                    <div class="col-sm-12">
                                        <div style="margin: 24px 0;">
                                            <button type="submit" class="btn btn-primary w-md"> 
                                              @if(!empty($page['id'])) Update @else Submit @endif
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
            
    <script src="{{asset('public/backend/asset/js/tinymce/tinymce.min.js')}}"></script>
    <script>
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "#summernote",
                theme: "modern",
                height: 200,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('public/backend/asset/js/tinymce') }}';
        });
    </script>
    
    <script>
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "#summernote1",
                theme: "modern",
                height: 200,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('public/backend/asset/js/tinymce') }}';
        });
    </script>
    
    <script>
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "#summernote2",
                theme: "modern",
                height: 200,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('public/backend/asset/js/tinymce') }}';
        });
    </script>
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
    <script>
        $(document).ready(function(){
            $("#section").on("change",function(){
                let section=$(this).val();
                if(section==='About Page'){
                    $("#missionId").show();
                    $("#detail").hide();
                }else{
                    $("#missionId").hide(); 
                }
            })
        })
    </script>
    @endsection
     
           
    
    
   



