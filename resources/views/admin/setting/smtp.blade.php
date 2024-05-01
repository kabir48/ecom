    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                        <div class="canvas_header">
                            <h2>{{$title}}</h2>
                            <a href="{{url('admin/smtp-lists')}}" class="btn btn-default btn-primary">Back
                            </a>
                        </div>  

                        <!-- orders -->
                        <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                            <form method="post" action="{{ route('admin.smtp.setting.update')}}"  id="categoryForm">
                                @csrf     
                                <div class="form-group row mb-3">
                                    <label class="col-form-label text-lg-right col-lg-3" style="margin: 4px 0;"> Mailer Driver: <span class="tx-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="hidden" name="types[]" value="MAIL_DRIVER">
                                        <input type="text" class="form-control" name="MAIL_DRIVER" value="{{env('MAIL_DRIVER')}}" placeholder="Mail Driver Example: smtp">
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-3">
                                    <label class="col-form-label text-lg-right col-lg-3" style="margin: 4px 0;">Mailer Host<span class="tx-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="hidden" name="types[]" value="MAIL_HOST">
                                        <input type="text" class="form-control" name="MAIL_HOST" value="{{env('MAIL_HOST')}}"  placeholder="Mail Host">
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-3">
                                    <label class="col-form-label text-lg-right col-lg-3" style="margin: 4px 0;">Mail Port</label>
                                    <div class="col-lg-6">
                                        <input type="hidden" name="types[]" value="MAIL_PORT">
                                        <input type="text" class="form-control" name="MAIL_PORT" value="{{env('MAIL_PORT')}}" placeholder="Mail Port Example: 2525">
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-3">
                                    <label class="col-form-label text-lg-right col-lg-3" style="margin: 4px 0;">Mail User Name<span class="tx-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="hidden" name="types[]" value="MAIL_USERNAME">
                                        <input type="text" class="form-control" name="MAIL_USERNAME" value="{{env('MAIL_USERNAME')}}" placeholder="Mail Username please dont put any space">
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-3">
                                    <label class="col-form-label text-lg-right col-lg-3" style="margin: 4px 0;">Mail User Name<span class="tx-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="hidden" name="types[]" value="MAIL_PASSWORD">
                                        <input type="text" class="form-control" name="MAIL_PASSWORD" value="{{env('MAIL_PASSWORD')}}"  placeholder="Mail Password dont put any space">
                                    </div>
                                </div>
                                
                                                
                                <div class="row">
                                    <div class="col-sm-12 col-lg-6 offset-lg-3">
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
    
    @endsection

    
    
   
    
   

