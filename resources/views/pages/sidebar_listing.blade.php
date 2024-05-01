    <?php
        use App\Model\Admin\Category;
        $cateDetail=Category::cateDetail();
        //echo"<pre>";print_r($cateDetail);die;
        $mainCategory=Category::mainCategory();
        //echo"<pre>";print_r($mainCategory);die;
        use App\ProductFilter;
        $productFilters=ProductFilter::productFilters();
    ?>

    <?php
        $getSizes=ProductFilter::getSizes($url);
        $getColors=ProductFilter::getColors($url);
        $getBrands=ProductFilter::getBrands($url);
    ?>
    <?php
       $getParentCategory=Category::with('subcategories')->where('parent_id',0)->where('url','!=',$url)->where('section_id',$categoryDetails['cateDetails']['section_id'])->get()->toArray();
    ?>
    <div class="col-12 col-sm-12 col-md-3 col-lg-3 sidebar filterbar">
        @if(isset($page_name) && $page_name=="listing")
		<div class="closeFilter d-block d-md-none d-lg-none"><i class="fa fa-plus"></i></div>
		<div class="sidebar_tags">
			<!--====Categories=====-->
			<div class="sidebar_widget categories filter-widget">
				<div class="widget-title"><h2>Categories</h2></div>
				<div class="widget-content" style="">
					<ul class="sidebar_categories">
					    @if(count($getParentCategory)>0)
                        @foreach ($getParentCategory as $parentCat)
						<li class="level1 sub-level"><a href="{{url('category-products/'.$parentCat['url'])}}" class="site-nav toggle-sublinks">{{$parentCat['category_name']}} ({{App\Product::where('category_id',$parentCat['id'])->count()}})</a>
							<ul class="sublinks" style="display: none;">
								@if(count($parentCat['subcategories'])>0)
                                @foreach($parentCat['subcategories'] as $catB)
									<li class="level2"><a href="{{url('category-products/'.$catB['url'])}}" class="site-nav">{{$catB['category_name']}} ({{App\Product::where('category_id',$catB['id'])->count()}})</a></li>
							
                                @endforeach
                                @endif
							</ul>
						</li>
						@endforeach
						@endif
				
					</ul>
				</div>
			</div>
			<!--====Categories====-->
			
			
			<!--=====Size Filter====-->
			<div class="sidebar_widget filterBox filter-widget brand-filter">
				<div class="widget-title"><h2>Size Filter</h2></div>
				<ul>
				    @foreach($getSizes as $key=>$size)
					<li>
					  <input class="size" type="checkbox" name="size[]" id="size{{$key}}" value="{{$size}}">
					  <label for="size{{$key}}"><span><span></span></span>{{$size}}</label>
					</li>
					@endforeach
				
				</ul>
			</div>
			<!--====End Size End====-->
			
			<!--====Price Filter====-->
			<div class="sidebar_widget filterBox filter-widget brand-filter">
				<div class="widget-title"><h2>Price Range</h2></div>
				<ul>
				    <?php $prices=array('0-500','501-1000','1001-2000','2001-3000','3001-4000','4001-5000');?>
				    @foreach($prices as $key=>$price)
					<li>
					  <input class="price" type="checkbox" name="price[]" id="price{{$key}}" value="{{$price}}">
					  <label for="price{{$key}}"><span><span></span></span>{{$price}}</label>
					</li>
					@endforeach
				
				</ul>
			</div>
			<!--====End Size End====-->
			
			<!--===Color Filter===-->
			<div class="sidebar_widget filterBox filter-widget brand-filter">
				<div class="widget-title"><h2>Product Color</h2></div>
				<ul>
				    @forelse($getColors as $key=>$data)
                    <?php
                        $getColorName=App\Color::where('id',$data)->first()->toArray();
                    ?>
					<li>
					  <input type="checkbox" class="family_color"  name="family_color[]" id="family_color{{$key}}" value="{{$data}}">
					  <label for="family_color{{$key}}" style="background-color:{{$getColorName['name']}}"><span><span></span></span>{{$getColorName['name']}}</label>
					</li>
					@endforeach
				
				</ul>
			</div>
			<!--=====Color Filter End===-->
			
			<!--=====Product Filter=====-->
			@foreach($productFilters as $filter)
			<?php
               $filterAvailable=ProductFilter::filterAvailable($filter['id'],$categoryDetails['cateDetails']['id']);
            ?>
            @if($filterAvailable=='Yes')
            @if(count($filter['filter_values'])>0)
			<div class="sidebar_widget filterBox filter-widget brand-filter">
				<div class="widget-title"><h2>{{$filter['filter_name']}}</h2></div>
				<ul>
                    @foreach($filter['filter_values'] as $key=>$value)
					<li>
					  <input class="{{$filter['filter_column']}}" type="checkbox" name="{{$filter['filter_column']}}[]" id="{{$value['filter_value']}}" value="{{$value['filter_value']}}">
					  
					  <label for="{{$value['filter_value']}}"><span><span></span></span>{{ucwords($value['filter_value'])}}</label>
					</li>
					@endforeach
				</ul>
			</div>
			@endif
            @endif
			@endforeach
			<!--====Product Filter End====-->
			
			<!--====Popular Products====-->
			<div class="sidebar_widget sidePro">
				<div class="widget-title"><h2>Popular Products</h2></div>
				<div class="widget-content">
					<div class="sideProSlider grid-products">
					    @foreach($getParentCategory as $category)
					    <?php
					       $getProducts=App\Product::where('category_id',$category['id'])->where('status',1)->get()->toArray();
					    ?>
					    @foreach($getProducts as $data)
					     <?php
                            $data_format=date('Y/m/d',strtotime($data['discount_date']));
                            $discounted_price=App\Product::getProductdiscount($data['id']);
                            $name=preg_replace('/\s+/', '', $data['product_name']);
                            
                            //====Ip Block====//
                            $currencies=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->first();
                            $currencieCount=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->count();
                            if($getIp->country !='Bangladesh'){
                                if($currencieCount>0){
                                    $amount= $currencies->exchange_rate;
                                    $selling_price=$data['selling_price'] * $amount;
                                    $discounte=$discounted_price * $amount;
                                }else{
                                   $selling_price=$data['selling_price'];
                                   $discounte=$discounted_price ;
                                }
                            }else{
                                $selling_price=$data['selling_price'];
                               // dd($selling_price);
                                $discounte=$discounted_price ;
                            }
                            
                            $productSizes =App\AttributeProduct::with('product')->where('product_id',$data['id'])->where('status',1)->get()->toArray();
                        ?>
						<div class="item">
							<!-- start product image -->
							<div class="product-image">
								<!-- start product image -->
								<a href="{{url('product/details/'.$data['id'].'/'.$name)}}" class="product-img">
                                    <!-- image -->
                                    <img class="primary blur-up lazyload" data-src="{{asset($data['image_one'])}}" src="{{asset($data['image_one'])}}" alt="{{$data['product_name']}}" title="{{$data['product_name']}}">
                                    <!-- End image -->
                                    <!-- Hover image -->
                                    <img class="hover blur-up lazyload" data-src="{{asset($data['image_two'])}}" src="{{asset($data['image_two'])}}" alt="{{$data['product_name']}}" title="{{$data['product_name']}}">
                                    <!-- End hover image -->
                                    @if($data['discount_price'])
                                    <div class="product-labels"><span class="lbl on-sale">Sale</span></div>
                                    @endif
                                    
                                    @if($data['product_quantity'] < 0 || empty($data['product_quantity']))
                                        <span class="sold-out"><span>Sold out</span></span>
                                    @endif
                                </a>
								<!-- end product image -->
								
								@if($data['discount_date'])
                                    <!--Countdown Timer-->
                                    <div class="saleTime desktop" data-countdown="{{$data_format}}"></div>
                                    <!--End Countdown Timer-->
                                @endif
								
								<!--Product Button-->
								<div class="button-set style1">
                                <ul>
                                    <li>
                                        <input class="form-control input-number qty_cart qty-input" type="hidden" value="1">
                                        <input type="hidden" value="{{$data['id']}}" class="product_id_cart">
                                        <!--Cart Button-->
                                        <form class="add">
                                            <button class="btn-icon btn btn-addto-cart addToCartProduct" type="button" tabindex="0" data-mode="buy_now">
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                <span class="tooltip-label">Buy Now</span>
                                            </button>
                                        </form>
                                        <!--end Cart Button-->
                                    </li>
                                    <li>
                                        <!--Quick View Button-->
                                        <a href="javascript:void(0)" title="Quick View" class="btn-icon quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview" onclick="productview(this.id)" id="{{ $data['id'] }}">
                                            <i class="fa fa-search-plus" aria-hidden="true"></i>
                                            <span class="tooltip-label">Quick View</span>
                                        </a>
                                        <!--End Quick View Button-->
                                    </li>
                                    <li>
                                        <!--Wishlist Button-->
                                        <div class="wishlist-btn">
                                            <a class="btn-icon wishlist add-to-wishlist product-wish" href="javascript:void(0)">
                                               <i class="fa fa-heart" aria-hidden="true"></i>
                                                <span class="tooltip-label">Add To Wishlist</span>
                                            </a>
                                        </div>
                                        <!--End Wishlist Button-->
                                    </li>
                                </ul>
                            </div>
								<!--End Product Button-->
							</div>
							<!-- end product image -->
							<!--start product details -->
							<div class="product-details text-center">
								<!-- product name -->
								<div class="product-name">
									 <a href="{{url('product/details/'.$data['id'].'/'.$name)}}">{{ucfirst($data['product_name'])}}</a>
								</div>
								<!-- End product name -->
								<!-- product price -->
								<div class="product-price">
									{{$getIp->currency}} @if($discounted_price>0) <span class="price">{{$discounte}}&nbsp;&nbsp;<del style="color:red">{{$selling_price}}</del></span> @else <span class="price">{{$selling_price}}</span> @endif
								</div>
								<!-- End product price -->
								<!--Product Review-->
								<?php
                                $getMostPopular=App\ProductRating::with('product')->where('product_id',$data['id'])->get();
                                $getOrderDetailStarCount=$getMostPopular->count();
                                $sumRating=$getMostPopular->sum('rating');
                                if($getOrderDetailStarCount>0){
                                    $avg=round($sumRating/$getOrderDetailStarCount,2);
                                    $roundAvg=round($sumRating/$getOrderDetailStarCount);
                                }else{
                                    $roundAvg=0;
                                }
                                          //dd($applyMost);
                            ?>
                            
                            	<!-- End Variant -->
								<div class="product-review">
                                <?php
                                    $star=1;
                                    while ($star <= 5) {?>
                                    <i class="font-13 fa fa-star"></i>
                                    <?php $star++;
                                }?>
                                ({{$roundAvg}})
                                </div>
                            <!--End Product Review-->
                            
                            <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                                <div class="product-form__item">
                                    @foreach($productSizes as $key => $size)
                                    <div data-value="{{$size['weight_size']}}" class="swatch-element xs available">
                                        <input class="swatchInput" id="swatch-1-{{$key}}" type="radio" name="w_size" value="{{$size['weight_size']}}" @if($key === 0) checked @endif>
                                        <label class="swatchLbl medium" for="swatch-1-{{$key}}" title="{{$size['weight_size']}}">{{$size['weight_size']}}</label>
                                    </div>
                                    @endforeach              
                                </div>
                            </div>
							
							</div>
							<!-- End product details -->
						</div>
						@endforeach
						@endforeach
					</div>
				</div>
			</div>

			<!--=====End Popular Products====-->
			<!--====Banner====-->
			<?php
			   $product_adds=App\ProductAdd::where('location','listing')->where('status',1)->first();
			   //dd($product_adds);
			   $product_adds_count=App\ProductAdd::where('location','listing')->where('status',1)->count();
			?>
			@if($product_adds_count>0)
			<div class="sidebar_widget static-banner">
				<a href="javascript:void(0);"><img src="{{asset('public/media/addproduct/'.$product_adds->image_one)}}" alt="{{$product_adds->add_title}}"></a>
			</div>
			@endif
		</div>
		@endif
	</div>
	
<script>
        document.addEventListener("DOMContentLoaded", function () {
        var toggleLinks = document.querySelectorAll('.toggle-sublinks');

        toggleLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                var sublinks = this.parentNode.querySelector('.sublinks');
                sublinks.style.display = (sublinks.style.display === 'none' || sublinks.style.display === '') ? 'block' : 'none';
            });
        });
    });
       
    </script>


