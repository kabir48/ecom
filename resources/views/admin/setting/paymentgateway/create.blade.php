    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                        <div class="canvas_header">
                            <h2>{{$title}}</h2>
                            <a href="{{url('admin/payment-gateway-lists')}}" class="btn btn-default btn-primary">Back
                                </a>
                        </div>  

                        <!-- orders -->
                        <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                            <form method="post" @if(empty($payment->id)) action="{{url('admin/payment-gateway-create-store')}}" @else action="{{url('admin/payment-gateway-create-store/'.$payment->id)}}"  @endif id="categoryForm">
                                @csrf     
                                <div class="row">
                                   <div class="col-lg-6">
                                    <div class="form-group">
                                       <label class="form-control-label" style="margin: 10px 0;"> Store Id(aamr pay and ssl) , payPal(client ID)<span class="tx-danger">*</span></label>
                                       <input type="text" class="form-control" name="store_id" value="{{$payment->store_id}}" placeholder="store_id or client id">
                                     </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;" class="form-control-label">Name Of Gateway<span class="tx-danger">*</span></label>
                                          <input type="text" class="form-control" name="title" value="{{$payment->title}}"  placeholder="name of the gateway">
                                        </div>
                                    </div>
                                   
                                   <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;" class="form-control-label">SignatureID, SSL(PASSWORD),payPal(scret id)<span class="tx-danger">*</span></label>
                                          <input type="text" class="form-control" name="signature_id" value="{{$payment->signature_id}}"  placeholder="signature or store_pass or secret_id">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;" class="form-control-label">Payment Method <span class="tx-danger">*</span></label>
                                          <select class="form-control" name="type">
                                              <option></option>
                                              <option value="aamr_pay" @if($payment->type == "aamr_pay") selected @endif> Aamr Pay</option>
                                              <option value="ssl" @if($payment->type == 'ssl') selected @endif> SSL</option>
                                              <option value="paypal" @if($payment->type == 'paypal') selected @endif> Paypal</option>
                                          </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;" class="form-control-label">Making Site Live(Important for live) <span class="tx-danger">*</span></label>
                                          <select class="form-control" name="live">
                                              <option value="#">Do you Want Live</option>
                                              <option value="1" @if($payment->live == '1') selected @endif > Live</option>
                                              <option value="2" @if($payment->live == '0') selected @endif> Sandbox</option>
                                          </select>
                                        </div>
                                    </div>
                                </div> 
                                                
                                <div class="row justify-content-end">
                                    <div class="col-sm-12">
                                        <div style="margin: 24px 0;">
                                            <button type="submit" class="btn btn-primary w-md"> 
                                           @if(empty($payment->id)) Submit @else Update @endif
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
            
    @endsection

    
    
   
    
   

