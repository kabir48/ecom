    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    <!-- Main Body -->
    <main class="section ContentBody">                
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 pl-lg-0">
                        <div class="card">
                        <div class="card-header">
                            <h4>Billing Address</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive"  data-simplebar data-simplebar-auto-hide="false">
                            <table class="table table-bordered table-md">
                               <tr>
             	    		 	<th>Name: </th>
             	    		 	<th>{{$order->name }}</th>
             	    		 </tr>
             	    		 <tr>
             	    		 	<th>Phone: </th>
             	    		 	<th>{{ $order->phone }}</th>
             	    		 </tr>
                              <tr>
                                <th>Payment Gateway: </th>
                                <th>{{ $order->payment_gateway}}</th>
                             </tr>
             	    		 <tr>
             	    		 	<th>Order No: </th>
             	    		 	<th>#{{ $order->order_no }}</th>
             	    		 </tr>
             	    		 <tr>
             	    		 	<th>Total :</th>
             	    		 	<th>TK.{{ $order->total }}</th>
             	    		 </tr>
             	    		  <tr>
             	    		 	<th>Month : </th>
             	    		 	<th>
             	    		 		  {{ $order->month }}
             	    		 	</th>
             	    		 </tr>
             	    		  <tr>
             	    		 	<th>Date: </th>
             	    		 	<th>{{ $order->date }}</th>
             	    		 </tr>
             	    		  <tr>
             	    		 	<th>Courier Name: </th>
             	    		 	<th>{{ $order->delivery_man??"not added"}}</th>
             	    		 </tr>
             	    		 <tr>
             	    		 	<th>Tracking Number : </th>
             	    		 	<th>{{ $order->status_code??"Not added"}}</th>
             	    		 </tr>
             	    		 <tr>
             	    		 	<th>Delivery Date : </th>
             	    		 	<th>{{ $order->Expected_date??"not added"}}</th>
             	    		 </tr>
                            </table>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-12 pr-lg-0 col-lg-6">
                        <div class="card">
                        <div class="card-header">
                            <h4>Shipping Address</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive"  data-simplebar data-simplebar-auto-hide="false">
                            <table class="table table-striped table-md">
                                <tr>
             	    		 	<th>Name: </th>
             	    		 	<th>{{ $shipping->name }}</th>
             	    		 </tr>
             	    		 <tr>
             	    		 	<th>Phone: </th>
             	    		 	<th>{{ $shipping->phone }}</th>
             	    		 </tr>
             	    		 <tr>
             	    		 	<th>Email: </th>
             	    		 	<th>{{ $shipping->email }}</th>
             	    		 </tr>
             	    		 <tr>
             	    		 	<th>Address: </th>
             	    		 	<th>{{ $shipping->address }}</th>
             	    		 </tr>
             	    		 <tr>
             	    		 	<th>City :</th>
             	    		 	<th>{{ $shipping->country }}</th>
             	    		 </tr>
                             @if($order->payment_type=="prepaid")
                             <tr>
             	    		 	<th>Order Status :</th>
             	    		 	<th>{{ $order->payment_status }}</th>
             	    		 </tr>
             	    		 
             	    		 <tr>
             	    		 	 <th>Status : </th>
             	    		 	 <th>
         	    		 		     @if($order->status == 1)
         	    		 		     <span class="badge badge-info">Processing Products</span>
         	    		 		     @elseif($order->status == 2)
         	    		 		     <span class="badge badge-primary">Products Shipped</span>
         	    		 		     @elseif($order->status == 3)
         	    		 		     <span class="badge badge-success">Delevered Products</span>
         	    		 		     @else
         	    		 		     <span class="badge badge-danger">Cancel </span>
         	    		 		     @endif
             	    		 	 </th>
             	    		 </tr> 
                             @else
    
                             <tr>
                                <th>Status : </th>
                                <th>
                                    @if($order->status == 0)
                                     <span class="badge badge-warning">Not Paid Yet</span>
                                    @elseif($order->status == 1)
                                    <span class="badge badge-warning">Not Paid Yet</span>
                                    @elseif($order->status == 2)
                                    <span class="badge badge-warning">Not paid Yet</span>
                                    @elseif($order->status == 3)
                                    <span class="badge badge-warning">Not paid Yet</span>
                                    @elseif($order->status == 4)
                                    <span class="badge badge-success">Paid In Cash</span>
                                    @else
                                    <span class="badge badge-danger">Cancel Products</span>
                                    @endif
                                </th>
                             </tr>
                             @endif
                            </table>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-12 p-0">
                    <div class="card">
                    <div class="card-body">
                        <div class="table-responsive"  data-simplebar data-simplebar-auto-hide="false">
                            <table class="table table-striped">
                               <thead>
                     	        <tr>
                     	          <th class="wd-15p">SL</th>
                     	          <th class="wd-15p">Product ID</th>
                     	          <th class="wd-15p">Product SKU</th>
                     	          <th class="wd-15p">Product Name</th>
                     	          <th class="wd-15p">Image</th>
                     	          <th class="wd-15p">Color </th>
                     	          <th class="wd-15p">Size</th>
                     	          <th class="wd-15p">Quantity</th>
                     	          <th class="wd-15p">Unit Price</th>
                     	          <th class="wd-15p">Return Product</th>
                     	          <th class="wd-20p">Total</th>
                     	        </tr>
                     	      </thead>
                     	      <tbody>
                     	        @foreach($details as $key=>$row)
                     	        <tr>
                     	          <td>{{ $key+1 }}</td>
                     	          <td>{{ $row->product_code??"" }}</td>
                     	          <td>
                     	              <?php
                     	                  $getSku=App\AttributeProduct::where('product_id',$row->product_id)->where('weight_size',$row->product_size)->first();
                     	              ?>
                     	              {{$getSku->sku??""}}
                     	          </td>
                     	          <td>{{ $row->product_name }}</td>
                     	          <td><img src="{{ URL::to($row->image_one) }}" height="50px;" width="50px;"></td>
                     	          <td>{{ $row->product_color }}</td>
                     	          <td>{{ $row->product_size }}</td>
                     	          <td>{{ $row->product_quantity }}</td>
                     	          <td>
                     	          	TK.{{ $row->singleprice }}
                     	          </td>
                     	          <td>{{ $row->item_status }}</td>
                     	          <td>
                     	          TK.{{ $row->totalprice }}
                     	          </td>
            
                     	        </tr>
                     	        @endforeach
                            </table>
                         </div>                        
                      </div>
                    </div>
                    <div class="card mt-4">
                    <div class="card-body">
                    
                            <form action="{{url('admin/order-status-change/')}}" method="post">
                                @csrf
                              <input type="hidden" name="id" value="{{$order->id}}">
                              <div class="row">
                              <div class="form-group col-12 col-lg-7">
                                <div class="input-group">
                                  <select class="custom-select" id="status_item" name="status">
                                    <option value="#">Select Status</option>
                                        <option value="0" @if($order->status == '0') selected @endif>New Order</option>
                                        <option value="1" @if($order->status == '1') selected @endif>Processing</option>
                                        <option value="2" @if($order->status == '2') selected @endif>Shipped</option>
                                        <option value="3" @if($order->status == '3') selected @endif>Delivered</option>
                                        @if($order->payment_type !='prepaid' || $order->payment_status !='paid')
                                        <option value="4" @if($order->status == '4') selected @endif>Paid</option>
                                        @endif
                                        <option value="5" @if($order->status == '5') selected @endif>Cancelled</option>
                                  </select>
                                 
                                </div>
                              </div>
                              
                               <div class="form-group col-12 col-lg-5">
                                <div class="input-group">
                                  <input style="width:120px" class="form-control" type="text" name="delivery_man" @if(empty($order->delivery_man)) id="delivery_man" @endif placeholder="Courier Name" value="{{$order->delivery_man}}">
                                  <input style="width:120px" class="form-control" type="text" name="status_code"  @if(empty($order->status_code)) id="status_code" @endif placeholder="tracking number" value="{{$order->status_code}}">
                                  <input style="width:120px" class="form-control" type="date" name="Expected_date" @if(empty($order->Expected_date)) id="date" @endif value="{{$order->Expected_date}}">
                                </div>
                              </div>
                              </div>
                               <div class="input-group-append d-flex justify-content-center">
                                <button class="btn btn-primary" type="submit">Submit</button>
                               </div>
                            </form>
                        </div>
                        <div class="col-6 col-md-6 col-lg-6">
                             <table class="table table-striped">
                     	      <tbody>
                     	        @foreach($logs as $key=>$row)
                     	        <tr>
                     	          <td>{{ $row->status }}</td>
                     	          <td>{{ date('F j,Y, g:i a',strtotime($row->created_at)) }}</td>
                     	        </tr>
                     	        @endforeach
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script>
        $(document).ready(function() {
            $("#delivery_man").hide();
                $("#status_code").hide();
                $("#date").hide(); 
            $("#status_item").on("change",function(){
                if(this.value == 1){
                    $("#delivery_man").show();
                    $("#status_code").show();
                    $("#date").show(); 
                }else{
                    $("#delivery_man").hide();
                    $("#status_code").hide();
                    $("#date").hide();  
                }
            });
         });
        </script>
       
        @endsection