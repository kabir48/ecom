    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                        <div class="canvas_header">
                            <h2>{{$title_two}}</h2>
                            <a href="{{url('admin/sms-lists')}}" class="btn btn-default btn-primary">Back
                            </a>
                             <p>{{$title}}</p>
                        </div>  

                        <!-- orders -->
                        <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                            <form method="post" @if(empty($sms['id'])) action="{{ url('admin/smsgateway-create-store')}}" @else action="{{ url('admin/smsgateway-create-store/'.$sms['id'])}}"@endif enctype="multipart/form-data" id="categoryForm">
                                @csrf     
                                <div class="row">
                                   <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label" style="margin: 10px 0;"> Section: <span class="tx-danger">*</span></label>
                                        <select class="form-control" name="title" id="section_id">
                                        <option value="">select SMS TITLE</option>
                                      	<option value="ssl" @if($sms['title']=="ssl") selected @endif>SSl</option>
                                      	<option value="bulksmsbd" @if($sms['title']=="bulksmsbd") selected @endif>Bulksmsbd</option>
                                      	<option value="bdbulksms" @if($sms['title']=="bdbulksms") selected @endif>Bdbulksms</option>
                                      	<option value="banglalink" @if($sms['title']=="banglalink") selected @endif>Banglalink</option>
                                      </select>
                                     </div>
                                    </div>
                                    
                                   <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;" class="form-control-label">Sender Id<span class="tx-danger">*</span></label>
                                          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="sender id" name="sender_id" @if(!empty($sms['sender_id'])) value="{{$sms['sender_id']}}" @else value="{{old('sender_id')}}" @endif>
                                           
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;" class="form-control-label">API KEY / USER ID /TOKEN<span class="tx-danger">*</span></label>
                                          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="type Api key/ token /user id" name="api_key" @if(!empty($sms['api_key'])) value="{{$sms['api_key']}}" @else value="{{old('api_key')}}" @endif>
                                           
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;" class="form-control-label">SENDER ID /PASSWORD<span class="tx-danger">*</span></label>
                                          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="sender id / passrword" name="client_id" @if(!empty($sms['client_id'])) value="{{$sms['client_id']}}" @else value="{{old('client_id')}}" @endif>
                                           
                                        </div>
                                    </div>
                                 
                                </div> 
                                                
                                <div class="row justify-content-end">
                                        <div class="col-sm-12">
                                            <div style="margin: 24px 0;">
                                                <button type="submit" class="btn btn-primary w-md"> 
                                               @if(empty($sms->id)) Submit @else Update @endif
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