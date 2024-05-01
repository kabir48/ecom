    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                        <div class="canvas_header">
                            <h2>{{$title}}</h2>
                            <a href="{{url('admin/shipping-charge-lists')}}" class="btn btn-default btn-primary">Back
                            </a>
                        </div>  

                        <!-- orders -->
                        <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                             <form method="post" @if(empty($charge->id)) action="{{ url('admin/shipping-charge-create-store/') }}"@else action="{{ url('admin/shipping-charge-create-store/'.$charge->id) }}" @endif enctype="multipart/form-data">
                                @csrf     
                                <div class="row">
                                   <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label" style="margin: 10px 0;">Shipping Country: <span class="tx-danger">*</span></label>
                                        <select name="country"  class="form-control" >
                                            <option value="">Select Country</option>
                                            @foreach($countries as $type)
                                            <option value="{{$type->name}}" @if($type->name==$charge->country) Selected @endif>{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                     </div>
                                    </div>
                                      
                                   <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;" class="form-control-label">Shipping Charges(0-500 gram)<span class="tx-danger">*</span></label>
                                          <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" @if($charge->zero) value="{{$charge->zero }}" @else value="{{old('zero')}}" @endif  name="zero" required="">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;" class="form-control-label">Shipping Charges(501-1000 gram)<span class="tx-danger">*</span></label>
                                          <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" @if($charge->zero) value="{{$charge->fivehundred }}" @else value="{{old('fivehundred')}}" @endif name="fivehundred" required="" >
                                           
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;" class="form-control-label">Shipping Charges(1001-1500 gram)<span class="tx-danger">*</span></label>
                                          <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" @if($charge->zero) value="{{$charge->onethousand }}" @else value="{{old('onethousand')}}" @endif name="onethousand" required="">
                                           
                                        </div>
                                    </div> 
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;" class="form-control-label">Shipping Charges(1501-2000 gram)<span class="tx-danger">*</span></label>
                                          <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" @if($charge->zero) value="{{$charge->twothousand }}" @else value="{{old('twothousand')}}" @endif name="twothousand" required="">
                                           
                                        </div>
                                    </div> 
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;" class="form-control-label">More Than 2000 gram<span class="tx-danger">*</span></label>
                                          <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" @if($charge->zero) value="{{$charge->above }}" @else value="{{old('above')}}" @endif name="above" required="">
                                           
                                        </div>
                                    </div>
                                 
                                </div> 
                                                
                                <div class="row justify-content-end">
                                        <div class="col-sm-12">
                                            <div style="margin: 24px 0;">
                                                <button type="submit" class="btn btn-primary w-md"> 
                                               @if(empty($charge->id)) Submit @else Update @endif
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
