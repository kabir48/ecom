@extends('layouts.app')
@section('content')
<?php
use App\Product;
?>
<?php
use App\AttributeProduct;
?>
<style>
    .product-info-cart button{
        border: none;
    }
</style>
<section id="content">
		<div class="content-shop">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-4 col-xs-12">
						 @include('pages.common_sidebar')
					</div>
					<div class="col-md-9 col-sm-8 col-xs-12">
						<div class="main-content-shop">
							<!-- End List Shop Cat -->
							<div class="shop-tab-product">
								<div class="shop-tab-title">
									<h2>My Wish List</h2>
								</div>
									<ul class="product-list">
											<li>
                                            @foreach($wishlists as $row)
                                            @if(isset($row['products']))
                                                <?php
                                                    $total_stock=AttributeProduct::where('product_id',$row['products']['id'])->sum('stock');
                                                    $name=preg_replace('/\s+/', '', $row['product']['product_name']);
                                                ?>
												<div class="item-product wish_content" style="height: 407px !important;">
													<div class="row">
														<div class="col-md-4 col-sm-12 col-xs-12">
															<div class="product-thumb">
																<div class="product-thumb-link" href="{{url('product/details/'.$row['products']['id'].'/'.$name)}}">
																	<img class="first-thumb" alt="" src="{{asset( $row['products']['image_one'])}}">
																	<img class="second-thumb" alt="" src="{{asset( $row['products']['image_two'])}}">
																</div>
															</div>
														</div>
														<div class="col-md-8 col-sm-12 col-xs-12">
															<div class="product-info">
																<h3 class="title-product">{{$row['products']['product_name']}}</h3>
																<div class="info-price">
                                                                    <span style="font-weight: 600">TK.{{$row['products']['selling_price']}}</span>
																</div>
                                                                

																<div class="product-stock">
																	<label>Item Code:</label><span>{{$row['products']['product_code']}}</span>
																</div>
																<div class="product-stock">
																	<label>Availability: </label>@if($total_stock>0)<span>In stock</span> @else <span style="color:red">Stock Out</span>@endif
																</div>
																<div class="product-stock">
																	<label>product Color: </label> <span>@if(isset($row['products']['product_color'])) {{$row['products']['product_color']??"There is no Color"}} @endif</span>
																</div>
                                                                <div class="product-stock">
                                                                    <?php
                                                                     $productDetails =AttributeProduct::select('weight_size')->where('product_id',$row['products']['id'])->where('status',1)->get();
                                                                    ?>

																	<label>Product Weight: </label> <span>
                                                                        @foreach ($productDetails as $item)
                                                                            {{$item['weight_size']??"No Product Weight"}}&nbsp;
                                                                        @endforeach

                                                                    </span>
																</div>
																<div class="product-info-cart">
                                                                    @if($total_stock>0)
																	<a class="addcart-link" href="{{url('product/details/'.$row['products']['id'].'/'.$name)}}"><i class="fa fa-shopping-basket"></i>Detail</a>
                                                                    @endif
                                                                    <br>
                                                                    <input type="hidden" value="{{$row['id']}}" class="wish_id">
																	<button type="button" class="addcart-link wishlist-remove-btn">Remove</button>
																</div>
															</div>
                                                            <p>@if(isset($row['products']['small_detail'])) {{$row['products']['small_detail']}} @else There is no text @endif</p>
														</div>
													</div>
												</div>
                                                @endif
                                                @endforeach
											</li>
										</ul>
								     </div>
							     </div>
							<!-- End Shop Tab -->
						</div>
						<!-- End Main Content Shop -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Content Shop -->
	</section>

 <script type="text/javascript">
$(document).ready(function(){
    $('.wishlist-remove-btn').click(function (e) {
        e.preventDefault();
        var Clickedthis=$(this);
        var wish_id=$(Clickedthis).closest('.wish_content').find('.wish_id').val();
        //alert(wish_id);
          $.ajax({
        method:"POST",
        url: "{{route('user.remove.wishlist')}}",
        data: {'wish_id':wish_id},
        success: function (response) {
            $(Clickedthis).closest('.wish_content').remove();
        alertify.set('notifier','position', 'top-right');
        alertify.success(response.status);

            },
    });


    });
});

</script>
    @endsection
