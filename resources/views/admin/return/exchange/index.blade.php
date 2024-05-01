    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                    <div class="col-md-12">
                        <div class="orderListArea">
                            <div class="canvas_header">
                                <h2>{{$title}}</h2>
                            </div>  
    
                            <!-- orders -->
                            <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                                <table class="dashboard_Order_status" id="datatable" style="min-width: 130rem">
                                    <thead>
                                    <tr>
                                      <th class="wd-15p">Sl</th>
                                      <th class="wd-15p">Order ID</th>
                                      <th class="wd-15p">User ID</th>
                                      <th class="wd-15p">Product Size</th>
                                      <th class="wd-15p">Product code</th>
                                      <th class="wd-15p">Exchange Reasons</th>
                                      <th class="wd-15p">Required Size</th>
                                      <th class="wd-15p">Return Comment</th>
                                      <th class="wd-15p">Date</th>
                                      <th class="wd-20p">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($exchanges as $key=>$row)
                                    <tr>
                                      <td>{{ $key+1 }}</td>
                                      <td><a target="_blank" href="{{url('admin/order-view/'.$row->order_id)}}">View Here</a></td>
                                      <td>{{ $row->user->name}} ({{$row->user->phone??""}})</td>
                                      <td>{{ $row->product_size}}</td>
                                      <td>{{ $row->product_code}}</td>
                                      <td>{{ $row->exchange_reason}}</td>
                                      <td>{{ $row->required_size}}</td>
                                      <td>{{ $row->note}}</td>
                                      <td>{{ date('Y-m-d',strtotime($row->created_at))}}</td>
                                      @if($row->status=="Approved")
                                      <td>{{ $row->status}}</td>
                                      @else
                                      <td>
                                          <form method="post" action="{{url('admin/exchange-product-status')}}">
                                              @csrf
                                            <input type="hidden" value="{{$row->id}}" name="id">
                                          <select class="form-control" name="status" id="OrderStatusUpdate">
                                              <option>Select Status</option>
                                              <option @if($row->status=="Approved") selected @endif value="Approved">Approved</option>
                                              <option value="Rejected" @if($row->status=="Rejected") selected @endif>Rejected</option>
                                              <option value="Pending"  @if($row->status=="Pending") selected @endif disabled>Pending</option>
                                          </select>
                                          <!--<input type="submit" class="btn btn-success" value="Update" style="margin-top:20px">-->
                                          </form>
                                      </td>
                                      @endif
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
        
        <script>
            $("select#OrderStatusUpdate").change(function() {
          $(this).closest("form").submit();
        });
        </script>

      
    @endsection
     

    
    
    
   




