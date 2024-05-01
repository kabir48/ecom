    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                        <div class="canvas_header">
                            <h2>{{$title}}</h2>
                            <a href="{{url('admin/section-lists')}}" class="btn btn-default btn-primary">Back
                            </a>
                        </div>  

                        <!-- orders -->
                        <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                             <form method="post" @if(empty($section->id)) action="{{url('admin/section-create-store')}}" @else action="{{url('admin/section-create-store/'.$section->id)}}" @endif>
                                @csrf
                                            
                                <div class="row">
                                   <div class="col-lg-6 offset-lg-3">
                                    <div class="form-group">
                                      <label class="form-control-label" style="margin: 10px 0;">Name Title (ENGLISH ): <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" name="name" value="{{$section->name}}" placeholder="Type Section in english">
                                       @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                       @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 offset-lg-3">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;" class="form-control-label">Bangla Name Title (BANGLA): <span class="tx-danger">*</span></label>
                                          <input class="form-control" type="text" name="bangla_name" value="{{$section->bangla_name}}" placeholder="Type Section in bangla">
                                           @if ($errors->has('bangla_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('bangla_name') }}</strong>
                                            </span>
                                           @endif
                                        </div>
                                      </div>
                                </div> 
                                                
                                <div class="row">
                                        <div class="col-lg-6 offset-lg-3 col-sm-12">
                                            <div style="margin: 24px 0;">
                                                <button type="submit" class="btn btn-primary w-md"> 
                                               @if(empty($section->id)) Submit @else Update @endif
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
     
           
    
    
   
