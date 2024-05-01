    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                        <div class="canvas_header">
                            <h2>{{$title}}</h2>
                            <a href="{{url('admin/announcement-lists')}}" class="btn btn-default btn-primary">Back</a>
                        </div>  

                        <!-- orders -->
                        <form method="post" @if(empty($announcement['id'])) action="{{url('admin/announcement-create-store')}}" @else action="{{url('admin/announcement-create-store/'.$announcement['id'])}}" @endif>
                                @csrf
                                <div class="form-group row mb-4">
                                  <label class="col-form-label text-lg-right col-12 col-lg-2" style="margin: 4px 0;">Title (ENGLISH): <span class="tx-danger">*</span></label>
                                  <div class="col-sm-12 col-lg-8 p-lg-0">
                                    <select class="form-control" name="trigger">
                                      <option value="#"></option>
                                      <option value="customer" @if($announcement['trigger']=="customer") selected @endif>Customer Page</option>
                                      <option value="detail" @if($announcement['trigger']=="detail") selected @endif>Product Detail</option>
                                      <option value="charge" @if($announcement['trigger']=="charge") selected @endif>Shipping Charge And Delivery</option>
                                      <option value="discount" @if($announcement['trigger']=="discount") selected @endif>Discount Product</option>
                                    </select>
                                  </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                  <label class="col-form-label text-lg-right col-12 col-lg-2">Content</label>
                                  <div class="col-sm-12 col-lg-8 p-lg-0 summernoteTextAreaDesign">
                                    <textarea class="form-control" id="summernote" name="note">
                                        @if($announcement['note']) {{$announcement['note']}} @else {{old('note')}} @endif
                                    </textarea>
                                  </div>
                                </div>
                                
                                <div class="form-group row mb-4" style="margin: 20px 0;">
                                  <label class="col-form-label text-md-right col-12 col-lg-2"></label>
                                  <div class="col-sm-12 col-lg-8 p-lg-0">
                                    <button type="submit" class="btn btn-primary w-md"> 
                                        @if(!empty($announcement['id'])) Update @else Submit @endif
                                    </button>
                                  </div>
                                </div>
                                         
                            </form>
                    </div>
                </div>
            </div>  
         <main>
             
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
            <!-- Modal for Eligible-->
    @endsection
     
           
    
    
   

