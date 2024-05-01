        <?php
            $getMostPopular=App\ProductRating::with('product')->where('product_id',$productDetails['id'])->get();
            $getOrderDetailStarCount=$getMostPopular->count();
            $sumRating=$getMostPopular->sum('rating');
            if($getOrderDetailStarCount>0){
                $avg=round($sumRating/$getOrderDetailStarCount,2);
                $roundAvg=round($sumRating/$getOrderDetailStarCount);
            }else{
                $roundAvg=0;
            }
              //dd($applyMost);
              
            $discounted_price=App\Product::getProductdiscount($productDetails['id']);
            $productSizes =App\AttributeProduct::select('weight_size')->where('product_id',$productDetails['id'])->where('status',1)->where('stock','>',0)->get();
            $stock=$productSizes->sum('stock');
            
            //====Ip Block====//
            
            $currencies=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->first();
            $currencieCount=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->count();
            if($getIp->country !='Bangladesh'){
                if($currencieCount>0){
                    $amount= $currencies->exchange_rate;
                    $selling_price=$productDetails['selling_price'] * $amount;
                    $discounte=$discounted_price * $amount;
                }else{
                   $selling_price=$productDetails['selling_price'];
                   $discounte=$discounted_price ;
                }
            }else{
                $selling_price=$productDetails['selling_price'];
               // dd($selling_price);
                $discounte=$discounted_price ;
            }
            
            
        ?>
    
		<div class="col-12 col-sm-6 col-md-6 col-lg-6">
				<div id="slider">
					<!-- model thumbnail -->
					<div id="myCarousel" class="carousel slide">
						<!-- image slide carousel items -->
						<div class="carousel-inner">
						    
							<!-- slide 1 -->
							<div class="item carousel-item active" data-slide-number="0">
								<img data-src="{{asset($productDetails['image_one'])}}" src="{{asset($productDetails['image_one'])}}" alt="{{$productDetails['product_name']}}" title="{{$productDetails['product_name']}}">
							</div>
							<!-- End slide 1 -->
							
							<!-- slide 1 -->
							<div class="item carousel-item active" data-slide-number="1">
								<img data-src="{{asset($productDetails['image_two'])}}" src="{{asset($productDetails['image_two'])}}" alt="{{$productDetails['product_name']}}" title="{{$productDetails['product_name']}}">
							</div>
							<!-- End slide 1 -->
							
							<!-- slide 1 -->
							<div class="item carousel-item active" data-slide-number="2">
								<img data-src="{{asset($productDetails['image_three'])}}" src="{{asset($productDetails['image_three'])}}" alt="{{$productDetails['product_name']}}" title="{{$productDetails['product_name']}}">
							</div>
							<!-- End slide 1 -->
					
						</div>
						<!-- End image slide carousel items -->
						<!-- model thumbnail image -->
						<div class="model-thumbnail-img">
							<!-- model thumbnail slide -->
							<ul class="carousel-indicators list-inline">
								<!-- slide 1 -->
								<li class="list-inline-item active">
									<a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#myCarousel">
										<img data-src="{{asset($productDetails['image_one'])}}" src="{{asset($productDetails['image_one'])}}" alt="{{$productDetails['product_name']}}" title="{{$productDetails['product_name']}}">
									</a>
								</li>
								<!-- End slide 1 -->
								<!-- slide 2 -->
								<li class="list-inline-item">
									<a id="carousel-selector-1" data-slide-to="1" data-target="#myCarousel">
											<img data-src="{{asset($productDetails['image_two'])}}" src="{{asset($productDetails['image_two'])}}" alt="{{$productDetails['product_name']}}" title="{{$productDetails['product_name']}}">
									</a>
								</li>
								<!-- End slide 2 -->
								<!-- slide 3 -->
								<li class="list-inline-item">
									<a id="carousel-selector-2" class="selected" data-slide-to="2" data-target="#myCarousel">
										<img data-src="{{asset($productDetails['image_three'])}}" src="{{asset($productDetails['image_three'])}}" alt="{{$productDetails['product_name']}}" title="{{$productDetails['product_name']}}">
									</a>
								</li>
								<!-- End slide 3 -->
							</ul>
							<!-- End model thumbnail slide -->
							
						</div>
						<!-- End model thumbnail image -->
					</div>
				</div>
			</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-6 quick_product_data">
				<div class="product-brand"><a href="#">{{$productDetails['category']['category_name']}} / {{$productDetails['section']['name']}}</a></div>
				<h2 class="product-title">{{$productDetails['product_name']}}</h2>
				<div class="product-review">
					<div class="rating">
					    <?php
                            $star=1;
                            while ($star <= 5) {?>
                            <i style="color:#b17714ab;" class="fa fa-star"></i>
                            <?php $star++;
                        }?>
					</div>
					<div class="reviews"><a href="#">{{$roundAvg}} Reviews</a></div>
				</div>
				<div class="product-info">
				    
					<div class="product-stock"> @if($stock>0 || $productDetails['product_quantity']>0)<span class="instock">In Stock</span>@else <span class="outstock hide">Unavailable</span>@endif </div>
					<div class="product-sku">Product Code: <span class="variant-sku">{{$productDetails['product_code']}}</span></div>
				</div>
				<div class="pricebox">
				    @if($discounte)
					<span class="price old-price">{{$getIp->currency}} {{$selling_price}}</span>
					<span class="price">{{$getIp->currency}} {{$discounte}}</span>
					@else
					<span class="price">{{$getIp->currency}} {{$selling_price}}</span>
					@endif
				</div>
				<div class="sort-description">{!!str_limit($productDetails['product_details'],100)!!}</div>
				<form id="product_form--option" class="product-form ">
					<div class="product-options">
						<div class="swatch clearfix swatch-1 option2">
							<div class="product-form__item">
							  <label class="label">Size:<span class="required">*</span> <span class="slVariant" id="slVariant">XS</span></label>
							  @foreach($productSizes as $key=>$size)
							  <div class="swatch-element xs">
								<input class="swatchInput" id="{{$size->weight_size}}" onclick="sizeProduct()" type="radio" name="w_size" value="{{$size->weight_size}}">
								<label class="swatchLbl medium" for="{{$size->weight_size}}" title="{{$size->weight_size}}">{{$size->weight_size}}</label>
							  </div>
							  @endforeach
							</div>
						</div>
						<div class="product-action clearfix">
							<div class="quantity">
								<div class="wrapQtyBtn">
									<div class="qtyField">
										<a class="qtyBtn minus minus-class" href="javascript:void(0);"><i class="fa fa-minus" aria-hidden="true"></i></a>
										<input type="text" name="quantity" value="1" class="product-form__input qty qty-class qty_cart">
										<a class="qtyBtn plus plus-class" href="javascript:void(0);"><i class="fa fa-plus" aria-hidden="true"></i></a>
									</div>
								</div>
							</div>       
							<input type="hidden" value="{{$productDetails['id']}}" class="product_id_cart">
							<div class="add-to-cart">
								<button type="button" class="btn button-cart addToCartProduct" data-modalmode="modal">
									<span>Add to cart</span>
								</button>
							</div>
						</div>
					</div>
				</form>
				<div class="wishlist-btn">
					<a class="wishlist add-to-wishlist product-wish" href="javascript:void(0)" title="Add to Wishlist"><i class="fa fa-heart" aria-hidden="true"></i> <span>Add to Wishlist</span></a>
				</div>
				
			</div>
	
		
		<script>
		   function sizeProduct() {
              // Get all radio buttons with class 'swatchInput'
              var radioButtons = document.getElementsByClassName('swatchInput');
              var slVariant=document.getElementById("slVariant")
            
              // Loop through radio buttons to find the selected one
              for (var i = 0; i < radioButtons.length; i++) {
                if (radioButtons[i].checked) {
                  // Get the value of the selected radio button
                  var selectedValue = radioButtons[i].value;
                  slVariant.innerText=selectedValue
                  // Do something with the selected value
                  //console.log("Selected value: " + selectedValue);
                  break; // Exit the loop once a selected radio button is found
                }
              }
            }

		</script>
		
		
		<!--====Quantity Update====-->
    <script>
    
        $(document).ready(function(){
           $('.plus-class').click(function(e){
             e.preventDefault();
               var incre=$('.qty-class').val();
               var value=parseInt(incre,10);
               //alert(value)
               value=isNaN(value)?0:value;
               if(value<10){
                   value++;
                   $('.qty-class').val(value);
               }
           });

           $('.minus-class').click(function(e){
            e.preventDefault();
              var dcre=$('.qty-class').val();
              var value=parseInt(dcre,10);
              value=isNaN(value)?0:value;
              if(value>1){
                  value--;
                  $('.qty-class').val(value);
              }
          });

        });
    </script>
    <script>
        
    //   add to cart for all Page
            
            $(document).ready(function(){
                  $('.addToCartProduct').click(function(e){
                    e.preventDefault();
                    var product_id_cart=$(this).closest('.quick_product_data').find('.product_id_cart').val();
                    var weight_cart=$("input[name='w_size']:checked").val();
                    var qty_cart=$(this).closest('.quick_product_data').find('.qty_cart').val();
                    var modalName = $(this).attr('data-modalmode');
                   //alert(qty_cart);
                    $.ajax({
                       type:'post',
                       url:"/quick-product-add",
                       data:{product_id_cart:product_id_cart,weight_cart:weight_cart,qty_cart:qty_cart},
                       success:function(resp){
                        
                        
                        if(modalName == "modal"){
                            location.reload(true);
                            alertify.set('notifier','position', 'top-right');
                            alertify.success(resp.status);
                            $('#minicart-drawer').modal('show');
                            $("#appendCartItem").html(resp.view);
                            $("#appendHeaderCartItem").html(resp.headerview);
                            $("#appendHeaderCartItem").html(resp.loadview);
                        }
                        
                       },error:function(error){
                           //alert("Error");
                        alertify.set('notifier','position', 'top-right');
                        alertify.error(error.status);
                    }
                });
                    
            });
        });
    </script>
    
    
    
        <script>
             $(document).ready(function(){
            $('.product-wish').click(function (e) {
                e.preventDefault();
            var wishlist_id=$(this).closest('.quick_product_data').find('.product_id_cart').val();
            //alert(wishlist_id);
            //return false;
                $.ajax({
                    headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/add-wishlist",
                    type:'post',
                    data: {wishlist_id:wishlist_id},
                    success: function (response) {
                    alertify.set('notifier','position','top-right');
                    alertify.success(response.status);
                    countWishList();
        
                        },
                });
        
            });
        });
        </script>
		
