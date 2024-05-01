    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
  
        <main class="ContentBody">
            <div class="orderListArea mb-4">
                <form action="{{url('admin/inventory-product-lists/')}}" method="post">
                    @csrf
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-lg-right col-12 col-lg-3" style="margin: 4px 0;">Filter: <span class="tx-danger">*</span></label>
                        <div class="col-sm-12 col-lg-6">
                            <input class="form-control" name="filter" value="{{request()->filter}}" placeholder="product name or product code or product price">
                        </div>
                        <div class="col-lg-6 offset-lg-3 mt-4">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
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
                                <table class="table table-bordered" id="datatable" style="border-color: #f7f8fa;">
                                  <thead style="background-color:#6777EF!important;">
                                    <tr>
                                      <th style="color:#fff;" scope="col">SL</th>
                                      <th style="color:#fff;" scope="col">Product Code</th>
                                      <th style="color:#fff;" scope="col">Product Name</th>
                                      <th style="color:#fff;" scope="col">Product Price</th>
                                      <th style="color:#fff;" scope="col">Image</th>
                                      <th style="color:#fff;" scope="col">Category </th>
                                      <th style="color:#fff;" scope="col">Quantity</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($products as $key=>$product)
                                    
                                    <tr style="background-color: #eaf1ff !important;">
                                      <td>{{$key+1}}</td>
                                      <td>{{$product->product_code}}</td>
                                      <td>{{$product->product_name}}</td>
                                      <td>{{$product->selling_price}}</td>
                                      <td class="actionTableImageData">
                                          <img src="{{asset($product->image_one) }}" width="60">
                                      </td>
                                      <td>{{$product->category->category_name??""}}</td>
                                      <td>{{$product->product_quantity}}</td>
                                    </tr>
                                    <tr>
                                      <td colspan="7" style="background-color:#FFF !important">
                                        <table class="table mb-2" style="border-color: #f7f8fa;">
                                          <thead>
                                            <tr style="background-color: #f0f5ff !important;">
                                              <th class="ChieldColorDesign" scope="col">Product Size</th>
                                              <th class="ChieldColorDesign" scope="col">Product SKU</th>
                                              <th class="ChieldColorDesign" scope="col">Stock</th>
                                              <th class="ChieldColorDesign" scope="col">Waist</th>
                                              <th class="ChieldColorDesign" scope="col">Chest</th>
                                              <th class="ChieldColorDesign" scope="col">Length</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @foreach($product->attributes as $row)
                                            
                                            <tr>
                                              <td>{{$row->weight_size}}</td>
                                              <td>{{$row->sku}}</td>
                                              <td>@if($row->stock>0) {{$row->stock}} @else <span class="badge badge-danger"> Stock Out </span> @endif</td>
                                              <td>{{$row->waist}}</td>
                                              <td>{{$row->chest}}</td>
                                              <td>{{$row->length}}</td>
                                            </tr>
                                           @endforeach
                                          </tbody>
                                        </table>
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
    @endsection
     

    
    
    
   




