@extends('admin.admin_layouts')

@section('admin_content')

    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="#">Starlight</a>
        <span class="breadcrumb-item active">Product Section</span>
      </nav>
      <div class="sl-pagebody">
      	   <div class="card pd-20 pd-sm-40">
          <p class="mg-b-20 mg-sm-b-30">Product Details</p>
           <h6 class="mg-b-20 mg-sm-b-30"> <a href="{{url('admin/quickee-ladystore-product-for-all')}}" class="btn btn-info btn-sm pull-right">Move Back</a></h6>


          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
                  <br>
                  <strong>{{ $product->product_name }}</strong>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
                   <br>
                  <strong>{{ $product->product_code }}</strong>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Quantity <span class="tx-danger">*</span></label>
                  <br>
                  <strong>{{ $product->product_quantity }}</strong>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                   <br>
                  <strong>{{ $product->category->category_name }}</strong>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Section: <span class="tx-danger">*</span></label>
                   <br>
                  <strong>{{ $product->section->name}}</strong>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
                   <br>
                  <strong>{{$product->brand->brand_name??"No Brand Item" }}</strong>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                 <label class="form-control-label">Product Size: <span class="tx-danger">*</span></label>
                  <br>
                  <strong>{{ $product->product_size }}</strong>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Product Color: <span class="tx-danger">*</span></label><br>
                  <strong>{{ $product->product_color }}</strong>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Selling Price <span class="tx-danger">*</span></label>
                   <br>
                  <strong>{{ $product->selling_price }}</strong>
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-12">
              	<div class="form-group" style="border:1px solid grey;padding:10px; ">
                  <label class="form-control-label">Product Details<span class="tx-danger">*</span></label>
                    <br>
                  <p >{!! $product->product_details !!}</p>
                </div>
              </div>


              <div class="col-lg-4">
              	<lebel>Image One (Main Thumbnail)<span class="tx-danger">*</span></lebel>
              	<label class="custom-file">

				  <img src="{{ URL::to($product->image_one) }}" style="height: 80px; width: 80px;" >
				</label>
              </div>
              <div class="col-lg-4">
              	<lebel>Image Two <span class="tx-danger">*</span></lebel>
              	<label class="custom-file">
				  <img src="{{ URL::to($product->image_two) }}" style="height: 80px; width: 80px;" >
				</label>
              </div>
              <div class="col-lg-4">
              	<lebel>Image Three <span class="tx-danger">*</span></lebel>
              	<label class="custom-file">
				  <img src="{{ URL::to($product->image_three) }}" style="height: 80px; width: 80px;" >
				</label>
              </div>
            </div><!-- row -->
            <br><hr>
            <div class="row">
                 @if(Auth::user()->Ladystore == 1)
                  <div class="col-lg-4">
            		<label class="">
            		@if($product->hot_new == 1)
					  <span class="badge badge-success">Active</span> |
					@else
					<span class="badge badge-danger">Inactive</span> |
					@endif
					  <span>Up-Comming Product</span>
					</label>
            	</div>
                <div class="col-lg-4">
            		<label class="">
            		@if($product->hot_deal == 1)
					  <span class="badge badge-success">Active</span> |
					@else
					<span class="badge badge-danger">Inactive</span> |
					@endif
					  <span>Weakly Special Product</span>
					</label>
            	</div>
                  <div class="col-lg-4">
            		<label class="">
            		@if($product->jewellary == 1)
					  <span class="badge badge-success">Active</span> |
					@else
					<span class="badge badge-danger">Inactive</span> |
					@endif
					  <span>Jewellary Items</span>
					</label>
            	</div>
                <div class="col-lg-4">
            		<label class="">
					  @if($product->feature == 1)
					  <span class="badge badge-success">Active</span> |
					@else
					<span class="badge badge-danger">Inactive</span> |
					@endif
					  <span>Regular Product</span>
					</label>
            	</div>
                <div class="col-lg-4">
            		<label class="">
            		@if($product->is_feature == 1)
					  <span class="badge badge-success">Active</span> |
					@else
					<span class="badge badge-danger">Inactive</span> |
					@endif
					  <span>Featured Item</span>
					</label>
            	</div>
                 @else

            	<div class="col-lg-4">
            		<label class="">
            		@if($product->special == 1)
					  <span class="badge badge-success">Active</span> |
					@else
					<span class="badge badge-danger">Inactive</span> |
					@endif
					  <span>New Arrival Products</span>
					</label>
            	</div>
            	<div class="col-lg-4">
            		<label class="">
					  @if($product->popular == 1)
					  <span class="badge badge-success">Active</span> |
					@else
					<span class="badge badge-danger">Inactive</span> |
					@endif
					  <span>Recently View Products</span>
					</label>
            	</div>

            	<div class="col-lg-4">
            		<label class="">
					  @if($product->best_rated == 1)
					  <span class="badge badge-success">Active</span> |
					@else
					<span class="badge badge-danger">Inactive</span> |
					@endif
					  <span>Hot Deals</span>
					</label>
            	</div>

            	<div class="col-lg-4">
            		<label class="">
					  @if($product->trend == 1)
					  <span class="badge badge-success">Active</span> |
					@else
					<span class="badge badge-danger">Inactive</span> |
					@endif
					  <span>Best Selling Product</span>
					</label>
            	</div>
                	<div class="col-lg-4">
            		<label >
					  @if($product->buyone_getone == 1)
					  <span class="badge badge-success">Active</span> |
					@else
					<span class="badge badge-danger">Inactive</span> |
					@endif
					  <span>Occasional Product</span>
					</label>
            	</div>
                	<div class="col-lg-4">
            		<label class="">
					  @if($product->feature == 1)
					  <span class="badge badge-success">Active</span> |
					@else
					<span class="badge badge-danger">Inactive</span> |
					@endif
					  <span>Regular Product</span>
					</label>
            	</div>
                <div class="col-lg-4">
            		<label class="">
            		@if($product->is_feature == 1)
					  <span class="badge badge-success">Active</span> |
					@else
					<span class="badge badge-danger">Inactive</span> |
					@endif
					  <span>Featured Item</span>
					</label>
            	</div>
                <div class="col-lg-4">
            		<label class="">
            		@if($product->hot_new == 1)
					  <span class="badge badge-success">Active</span> |
					@else
					<span class="badge badge-danger">Inactive</span> |
					@endif
					  <span>Up-Comming Product</span>
					</label>
            	</div>
                <div class="col-lg-4">
            		<label class="">
            		@if($product->hot_deal == 1)
					  <span class="badge badge-success">Active</span> |
					@else
					<span class="badge badge-danger">Inactive</span> |
					@endif
					  <span>Weakly Special Product</span>
					</label>
            	</div>
               @endif

            </div>
        </div><!-- card -->

      </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->





@endsection
