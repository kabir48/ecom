    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    <style>
    .flex_display{
          display:flex;
    }
        .form-control{
            width: 160px !important;
        }
    </style>
        <main class="ContentBody">
            <div class="orderListArea mb-4">
                <form action="{{url('admin/order-lists/')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" style="margin: 10px 0;">Order Status: <span class="tx-danger">*</span></label>
                                <select class="custom-select" id="inputGroupSelect04" name="status">
                                    <option></option>
                                    <option value="0">New Order</option>
                                    <option value="1">Processing</option>
                                    <option value="2">Shipped</option>
                                    <option value="3">Delivered</option>
                                    <option value="4">Paid</option>
                                    <option value="5">Cancelled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-group-append d-flex justify-content-center pb-3">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
            <div class="row">
                    <div class="col-md-12">
                        <div class="orderListArea">
                            <div class="canvas_header">
                                <h2>{{$title}}</h2>
                            </div> 
                            <!-- orders -->
                            <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                                <table class="dashboard_Order_status" id="datatable">
                                    <thead>
                                    <tr>
                                       <th class="wd-15p">ID</th>
                                       <th class="wd-15p">User Name</th>
                                       <th class="wd-15p">User phone</th>
                                       <th class="wd-15p">Order ID</th>
                                       <th class="wd-20p">Payment Gateway</th>
                                       <th class="wd-20p">Balance Transection</th>
                                       <th class="wd-20p">Total Amount</th>
                                       <th class="wd-20p">Status Changed</th>
                                       <th class="wd-20p">Order Date Time</th>
                                       <th class="wd-20p">Payment Status</th>
                                       <th class="wd-20p">Courier Name</th>
                                       <th class="wd-20p">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($orders as $key=>$row)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $row->user->name }}</td>
                                        <td>{{ $row->user->phone }}</td>
                                        <td>{{ $row->order_no }}</td>
                                        <td>{{ $row->payment_gateway}}</td>
                                        <td>{{ Str::limit($row->blnc_transection??"Not Paid", 18) }}</td>
                                        <td>{{ $row->total}}</td>
                                        <td>
                                            @if($row->status == '1' || $row->status == '2' || $row->status == '3' || $row->status == '4' || $row->status == '5')
                                            <form action="{{url('admin/order-status-change/')}}" method="post" class="flex_display">
                                                <input type="hidden" name="id" value="{{$row->id}}">
                                                <input type="hidden" name="status_code" value="{{$row->status_code}}">
                                                @csrf
                                                <select class="form-control" id="OrderStatusUpdate" name="status" style="width:11rem !important">
                                                    <option value="0" @if($row->status == '0') selected @endif>New Order</option>
                                                    <option value="1" @if($row->status == '1') selected @endif>Processing</option>
                                                    <option value="2" @if($row->status == '2') selected @endif>Shipped</option>
                                                    <option value="3" @if($row->status == '3') selected @endif>Delivered</option>
                                                    @if($row->payment_type !='prepaid' || $row->payment_status !='paid')
                                                    
                                                    <option value="4" @if($row->status == '4') selected @endif>Paid</option>
                                                    <option value="5" @if($row->status == '5') selected @endif>Cancelled</option>
                                                    @endif
                                                </select>
                                                <!--<div class="input-group-append">-->
                                                <!--    <button class="btn btn-primary" type="submit">Submit</button>-->
                                                <!--</div>-->
                                            </form>
                                            @endif
                                        </td>
                                        <td>{{date('d-M-Y',strtotime($row->date))}}  ({{Carbon\Carbon::parse($row->created_at)->diffForHumans()}})</td>
                                        <td>{{ $row->payment_status??"unpaid"}}</td>
                                        <td>{{ $row->delivery_man??"During Shipment"}}</td>
                                        
                                        <td class="actionTableData">
                                           <a title="invoice" target="_blank" href="{{url('admin/order-invoice-view/'.$row->id)}}" style="display:flex;align-items:center;gap:5px;" class="btn btn-sm btn-success"><i class="fas fa-save" title="Save"></i> Invoice</a>
                                           <a title="view" target="_blank" href="{{url('admin/order-view/'.$row->id) }}" style="display:flex;align-items:center;gap:5px;" class="btn btn-sm btn-info"><i class="fas fa-eye" title="Save"></i> View</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                            </div>
                        </div>
                    </div>  
                </div>  
            </div>  
        <main>
            
         
        
        <script type="text/javascript">
        $("select#OrderStatusUpdate").change(function() {
          $(this).closest("form").submit();
        });
                     $(function(){
                    'use strict';
            $(".updateSectionStatus").click(function(e){
              var status = $(this).text();
              var section_id = $(this).attr("section_id");
              $.ajax({
                type:'post',
                url: '{{url("admin/status-paymentgateway-update")}}',
                data:{status:status,section_id:section_id},
                success:function(resp){
                    if(resp['status']==0){
                        $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:(0)'>Inactive</a>");
                    }else if(resp['status']==1){
                        $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:(0)'>Active</a>");
                    }
            
                  },error:function(){
                      alert('Error')
                  }
               });
            
              });
              });
            
        </script>
      
    @endsection
     

    
    
    
   




