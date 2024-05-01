<?php
use App\Product;
?>
<?php
use App\OrderDetail;
?>
@extends('layouts.app')
@section('content')
<style type="text/css">
	.lady_store{
		background: #3379F8!important;
	}
	.lady_color{
		background: #561BEF !important;
	}
</style>
<link rel="stylesheet" type="text/css" href="{{asset('public/fontside/css/typecss.css')}}">

@if(session()->get('lang')=="bangla")
	<section id="content">
			<div class="container">
				<div class="banner-slider banner-slider5 simple-owl-slider">
					<div class="wrap-item" data-transition="fade" data-autoplay="true" data-pagination="true" data-navigation="false" data-itemscustom="[[0,1]]">

                        @foreach($banners as $banner)
						<div class="item-slider item-slider5">
							<div class="banner-thumb">
								<a href="#"><img src="{{url('public/media/quickeebanner/'.$banner->image_one)}}" alt="{{$banner->title}}" title="{{$banner->title}}" /></a>
							</div>
							<div class="banner-info text-uppercase font-bold animated" data-animated="zoomIn">
                                @if(!empty($banner->event_status))
								<h4>{{$banner->event_status}}</h4>
                                @endif
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<!-- End Banner Slider -->

				<!-- New Arrival products -->
				<div class="block-product05">
					<div class="row">
						<div class="col-md-3 col-sm-4 col-xs-12">
							<div class="hot-deal05">
								<div class="block-title05 lady_store">
									<h2 class="title14 font-bold text-uppercase bg-color white inline-block lady_color">New Arrival Products</h2>
								</div>
								<div class="special-slider05 arrow-style05">
									<div class="wrap-item" data-pagination="false" data-navigation="false" data-itemscustom="[[0,1]]">
										@foreach($allChunk as $key=>$data)
										<div class="item">
											@foreach($data as $row)
											<div class="product-table05 table">
												<div class="zoom-image-thumb product-thumb">
													<a href="#"><img src="{{asset($row['image_one'])}}" alt="" /></a>
												</div>
												 <div class="product-info5">
													<h3 class="title-product"><a href="{{url('product/details/'.$row['id'].'/'.$row['product_name'])}}">{{$row['product_name']}}</a></h3>
													 <div class="info-price">
					                                    <?php
					                                    $discounted_price=Product::getProductdiscount($row['id']);
					                                    ?>
					                                    @if($discounted_price>0)
					                                    <span style="font-weight: 600;color:#ffa19a">TK.{{$discounted_price}}</span><del>TK.{{$row['selling_price']}}</del>
					                                    @else
					                                    <span style="font-weight: 600;color:#ffa19a">TK.{{$row['selling_price']}}</span>
					                                    @endif
					                                  </div>
					                               <?php
							                            $id=$row['id'];
							                           $OrderReviCount=OrderDetail::where('product_id',$id)->where('review','yes')->count();
							                           ?>
								                        <div class="product-rating">
								                        <div class="inner-rating" style="width:100%"></div>
								                        <span>({{$OrderReviCount}})</span>
								                      </div>
												</div>
											 </div>
											@endforeach
										</div>
										@endforeach
									</div>
								</div>
							</div>
							<!-- End Hot Deal5 -->
						</div>
						<div class="col-md-9 col-sm-8 col-xs-12">
							<div class="product-tab05">
								<div class="block-title05 lady_store">
									<h2 class="title14 font-bold text-uppercase bg-color white inline-block lady_color">Featured Products</h2>
								</div>
								<div class="product-slider05 arrow-style05 line-white">
									<div class="wrap-item" data-pagination="false" data-navigation="false" data-itemscustom="false" data-autoplay="true">
										@foreach($ladystore as $row)
										<div class="item-product05 product_data feature_data_item">
											 <div class="product-thumb">
					                            <?php
					                                $discounted_price=Product::getProductdiscount($row['id']);
					                                ?>
					                                @if($discounted_price>0)
					                                <span class="ribbon hot">On Sale</span>
					                                @else
					                                @endif
					                            <a class="product-thumb-link" href="{{url('product/details/'.$row['id'].'/'.$row['product_name'])}}">
					                               <img class="first-thumb" src="{{asset($row['image_one'])}}" alt=""/>
					                               <img class="second-thumb" src="{{asset($row['image_two'])}}" alt=""/>
					                            </a>
					                            <div class="product-info-cart">
					                                <div class="product-extra-link">
					                                   <input type="hidden" class="wishlist_id" value="{{$row['id']}}">
					                                   <button type="button" class="wishlist-link add-to-wishlist"><i class="fa fa-heart-o"></i>
					                                </div>
					                                <a class="addcart-link" href="{{url('product/details/'.$row['id'].'/'.$row['product_name'])}}"><i class="fa fa-shopping-basket"></i>Product</a>
					                            </div>
					                        </div>
											<div class="product-info5">
												<h5 class="title-product" style="font-weight: 700;color:#ffa19a">{{$row['product_name']}}</h5>
					                            <h5 style="font-weight: 700">Product-code: <span style="color:#ffa19a">{{$row['product_code']}}</span></h5>
					                            <h5 style="font-weight: 700">Product-color: <span style="color:#ffa19a">@if($row['product_color'] !=NULL)({{$row['product_color']}})@else No color @endif</span></h5>
					                            <div class="info-price">
			                                    <?php
			                                    $discounted_price=Product::getProductdiscount($row['id']);
			                                    ?>
			                                    @if($discounted_price>0)
			                                    <span style="font-weight: 600;color:#ffa19a">TK.{{$discounted_price}}</span><del>TK.{{$row['selling_price']}}</del>
			                                    @else
			                                    <span style="font-weight: 600;color:#ffa19a">TK.{{$row['selling_price']}}</span>
			                                    @endif
					                            </div>
					                               <?php
						                            $id=$row['id'];
						                           $OrderReviCount=OrderDetail::where('product_id',$id)->where('review','yes')->count();
						                           ?>
							                        <div class="product-rating">
							                        <div class="inner-rating" style="width:100%"></div>
							                        <span>({{$OrderReviCount}})</span>
							                      </div>
											</div>
										</div>
										@endforeach
									</div>
								</div>

								<div class="banner-product05 banner-adv zoom-image pull-curtain">
									<a href="#" class="adv-thumb-link">
										<img src="{{asset('public/website/images/home/home5/banner2.jpg')}}" alt="" />
									</a>
									<div class="banner-info white text-right text-uppercase">
										<h2 class="title24 font-bold">Collection Tablet & iPad super design</h2>
										<h3 class="title14">on suppeshop on Collection</h3>
									</div>
								</div>
								<!-- End Banner -->
							</div>
						</div>
					</div>
				</div>
				<!-- End Block -->

                {{-- category product --}}
				<div class="block-product05">
					<div class="row">
						<div class="col-md-3 col-sm-4 col-xs-12">
							<div class="banner-ads05 banner-adv zoom-image line-scale">
                                <?php  $bannersImage=DB::table('quickee_banners')->where('status',1)->limit(1)->get();
								//dd($bannersImage);die;
								?>
                                @foreach($bannersImage as $row)
								<a class="adv-thumb-link"><img src="{{url('public/media/quickeebanner/small/'.$row->image_two)}}" alt=""/></a>
								<div class="banner-info text-center text-uppercase">
                                    @if((isset($row->title)) || (isset($row->event_status)))
									<h2 class="color2 title24 font-bold">{{ $row->title }}</h2>
                                    <p>Up To{{ $row->event_status }}<sup>%</sup> off</p>

                                    @else
                                    @endif
								</div>
                                @endforeach
							</div>
						</div>
						<div class="col-md-9 col-sm-8 col-xs-12">
							<div class="product-tab05">
								<div class="block-title05 lady_store">
									<h2 class="title14 font-bold text-uppercase bg-color white inline-block lady_color">Category Related Products</h2>
								</div>
								<div class="product-slider05 arrow-style05 line-white">
									<div class="wrap-item" data-pagination="false" data-navigation="false" data-itemscustom="false">
										@foreach($CateProduct as $row)
										<div class="item-product05  product_data">
											<div class="product-thumb">
												<?php
						                         $id=$row->id;
						                         $date =Carbon\Carbon::today()->subDays(7);
						                         $OrderCount=OrderDetail::where('product_id',$id)->where('date','>=',$date)->count();
						                         //$OrderCount=OrderDetail::where('product_id',$id)->where('id','>',1)->count();
						                         //echo $OrderCount;die;
						                      ?>
						                      @if($OrderCount>0)
						                       <span class="ribbon hot">{{$OrderCount}}</span>
						                      @endif
						                    <a href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}" class="product-thumb-link">
						                      <img class="first-thumb" src="{{asset($row->image_one)}}" alt=""/>
						                      <img class="second-thumb" src="{{asset($row->image_two)}}" alt=""/>
						                    </a>
												<div class="product-info-cart">
					                                <div class="product-extra-link">
					                                   <input type="hidden" class="wishlist_id" value="{{$row->id}}">
					                                   <button type="button" class="wishlist-link add-to-wishlist"><i class="fa fa-heart-o"></i>
					                                </div>
					                                <a class="addcart-link" href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}"><i class="fa fa-shopping-basket"></i>Detail</a>
					                            </div>
											</div>
											    <div class="product-info5">
						                    <h3 class="title-product"><a style="text-transform:uppercase;font-weight:600;color:#ffa19a" href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}">{{$row->product_name}} @if($row->product_color !=NULL)(<span style="color:ffa19a">{{$row->product_color}}</span>)@else @endif</a></h3>
						                   <h5 style="font-weight: 700">Product-Code: <span style="color:#ffa19a">{{$row->product_code}}</span></h5>
						                    <div class="info-price">
						                    <?php
						                      $discounted_price=Product::getProductdiscount($row->id);
						                    ?>
						                    @if($discounted_price>0)
						                    <span style="color:#ffa19a">TK.{{$discounted_price}}</span><del>TK.{{$row->selling_price}}</del>
						                    @else
						                    <span style="color:#ffa19a">TK.{{$row->selling_price}}</span>
						                    @endif
						                    </div>
						                       <?php
					                            $id=$row->id;
					                           $OrderReviCount=OrderDetail::where('product_id',$id)->where('review','yes')->count();
					                           ?>
						                        <div class="product-rating">
						                        <div class="inner-rating" style="width:100%"></div>
						                        <span>({{$OrderReviCount}})</span>
						                      </div>
						                  </div>
										</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End Block -->

              {{-- daily bproducts --}}
				<div class="block-product05">
					<div class="row">
						<div class="col-md-3 col-sm-4 col-xs-12">
							<div class="banner-ads05 banner-adv zoom-image line-scale">
                                <?php  $bannersImage=DB::table('quickee_banners')->where('status',1)->limit(1)->skip(1)->get();
								//dd($bannersImage);die;
								?>
                                @foreach($bannersImage as $row)
								<a  class="adv-thumb-link"><img src="{{url('public/media/quickeebanner/small/'.$row->image_two)}}" alt="" /></a>
								<div class="banner-info text-center text-uppercase">
                                    @if(isset($row->title) || isset($row->event_status))
									<h2 class="color2 title24 font-bold">{{ $row->title }}</h2>
                                    <p>Up To{{ $row->event_status }}<sup>%</sup> off</p>
                                    @endif
								</div>
                                @endforeach
							</div>
						</div>
						<div class="col-md-9 col-sm-8 col-xs-12">
							<div class="product-tab05">
								<div class="block-title05 lady_store">
									<h2 class="title14 font-bold text-uppercase bg-color white inline-block lady_color">Daily Products</h2>
								</div>
								<div class="product-slider05 arrow-style05 line-white">
									<div class="wrap-item" data-pagination="false" data-navigation="false" data-itemscustom="false">
										@foreach($ladystoreJewellery as $row)
										<div class="item-product05  product_data">
											<div class="product-thumb">
												<?php
						                         $id=$row->id;
						                         $date =Carbon\Carbon::today()->subDays(7);
						                         $OrderCount=OrderDetail::where('product_id',$id)->where('created_at','>=',$date)->count();
						                         //$OrderCount=OrderDetail::where('product_id',$id)->where('id','>',1)->count();
						                         //echo $OrderCount;die;
						                      ?>
						                      @if($OrderCount>0)
						                       <span class="ribbon hot">{{$OrderCount}}</span>
						                      @endif
						                    <a href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}" class="product-thumb-link">
						                      <img class="first-thumb" src="{{asset($row->image_one)}}" alt=""/>
						                      <img class="second-thumb" src="{{asset($row->image_two)}}" alt=""/>
						                    </a>
												<div class="product-info-cart">
					                                <div class="product-extra-link">
					                                   <input type="hidden" class="wishlist_id" value="{{$row['id']}}">
					                                   <button type="button" class="wishlist-link add-to-wishlist"><i class="fa fa-heart-o"></i>
					                                </div>
					                                <a class="addcart-link" href="{{url('product/details/'.$row['id'].'/'.$row['product_name'])}}"><i class="fa fa-shopping-basket"></i>Add Cart</a>
					                            </div>
											</div>
											    <div class="product-info5">
						                    <h3 class="title-product"><a style="text-transform:uppercase;font-weight:600;color:#ffa19a" href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}">{{$row->product_name}} @if($row->product_color !=NULL)(<span style="color:ffa19a">{{$row->product_color}}</span>)@else @endif</a></h3>
						                   <h5 style="font-weight: 700">Product-Code: <span style="color:#ffa19a">{{$row->product_code}}</span></h5>
						                    <div class="info-price">
						                    <?php
						                      $discounted_price=Product::getProductdiscount($row->id);
						                    ?>
						                    @if($discounted_price>0)
						                    <span style="color:#ffa19a">TK.{{$discounted_price}}</span><del>TK.{{$row->selling_price}}</del>
						                    @else
						                    <span style="color:#ffa19a">TK.{{$row->selling_price}}</span>
						                    @endif
						                    </div>
						                       <?php
					                            $id=$row->id;
					                           $OrderReviCount=OrderDetail::where('product_id',$id)->where('review','yes')->count();
					                           ?>
						                        <div class="product-rating">
						                        <div class="inner-rating" style="width:100%"></div>
						                        <span>({{$OrderReviCount}})</span>
						                      </div>
						                  </div>
										</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

            {{-- special day --}}
                @if(isset($byeOne->buyone_getone)==1)
                <div class="block-product05">
					<div class="row">
						<div class="col-md-3 col-sm-4 col-xs-12">
							<div class="banner-ads05 banner-adv zoom-image line-scale">
                                <?php  $bannersImage=DB::table('quickee_banners')->where('status',1)->limit(1)->skip(2)->get();
								//dd($bannersImage);die;
								?>
                                @foreach($bannersImage as $row)
								<a  class="adv-thumb-link"><img src="{{url('public/media/quickeebanner/small/'.$row->image_two)}}" alt="" /></a>
								<div class="banner-info text-center text-uppercase">
                                    @if(isset($row->title) || isset($row->event_status))
									<h2 class="color2 title24 font-bold">{{ $row->title }}</h2>
                                    <p>Up To{{ $row->event_status }}<sup>%</sup> off</p>
                                    @endif
								</div>
                                @endforeach
							</div>
						</div>
						<div class="col-md-9 col-sm-8 col-xs-12">
							<div class="product-tab05">
								<div class="block-title05 lady_store">
									<h2 class="title14 font-bold text-uppercase bg-color white inline-block lady_color">Special Day Offer Products</h2>
								</div>
								<div class="product-slider05 arrow-style05 line-white">
									<div class="wrap-item" data-pagination="false" data-navigation="false" data-itemscustom="false">
										@foreach($byeOne as $row)
										<div class="item-product05  product_data">
											<div class="product-thumb">
												<?php
						                         $id=$row->id;
						                         $date =Carbon\Carbon::today()->subDays(7);
						                         $OrderCount=OrderDetail::where('product_id',$id)->where('created_at','>=',$date)->count();
						                         //$OrderCount=OrderDetail::where('product_id',$id)->where('id','>',1)->count();
						                         //echo $OrderCount;die;
						                      ?>
						                      @if($OrderCount>0)
						                       <span class="ribbon hot">{{$OrderCount}}</span>
						                      @endif
						                    <a href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}" class="product-thumb-link">
						                      <img class="first-thumb" src="{{asset($row->image_one)}}" alt=""/>
						                      <img class="second-thumb" src="{{asset($row->image_two)}}" alt=""/>
						                    </a>
												<div class="product-info-cart">
					                                <div class="product-extra-link">
					                                   <input type="hidden" class="wishlist_id" value="{{$row['id']}}">
					                                   <button type="button" class="wishlist-link add-to-wishlist"><i class="fa fa-heart-o"></i>
					                                </div>
					                                <a class="addcart-link" href="{{url('product/details/'.$row['id'].'/'.$row['product_name'])}}"><i class="fa fa-shopping-basket"></i>Add Cart</a>
					                            </div>
											</div>
											    <div class="product-info5">
						                    <h3 class="title-product"><a style="text-transform:uppercase;font-weight:600;color:#ffa19a" href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}">{{$row->product_name}} @if($row->product_color !=NULL)(<span style="color:ffa19a">{{$row->product_color}}</span>)@else @endif</a></h3>
						                   <h5 style="font-weight: 700">Product-Code: <span style="color:#ffa19a">{{$row->product_code}}</span></h5>
						                    <div class="info-price">
						                    <?php
						                      $discounted_price=Product::getProductdiscount($row->id);
						                    ?>
						                    @if($discounted_price>0)
						                    <span style="color:#ffa19a">TK.{{$discounted_price}}</span><del>TK.{{$row->selling_price}}</del>
						                    @else
						                    <span style="color:#ffa19a">TK.{{$row->selling_price}}</span>
						                    @endif
						                    </div>
						                       <?php
					                            $id=$row->id;
					                           $OrderReviCount=OrderDetail::where('product_id',$id)->where('review','yes')->count();
					                           ?>
						                        <div class="product-rating">
						                        <div class="inner-rating" style="width:100%"></div>
						                        <span>({{$OrderReviCount}})</span>
						                      </div>
						                  </div>
										</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

                @endif


                {{-- best selling Products --}}
                 <div class="block-product05">
					<div class="row">
						<div class="col-md-3 col-sm-4 col-xs-12">
							<div class="banner-ads05 banner-adv zoom-image line-scale">
                                <?php  $bannersImage=DB::table('quickee_banners')->where('status',1)->limit(1)->skip(3)->get();
								//dd($bannersImage);die;
								?>
                                @foreach($bannersImage as $row)
								<a  class="adv-thumb-link"><img src="{{url('public/media/quickeebanner/small/'.$row->image_two)}}" alt="" /></a>
								<div class="banner-info text-center text-uppercase">
                                    @if(isset($row->title) || isset($row->event_status))
									<h2 class="color2 title24 font-bold">{{ $row->title }}</h2>
                                    <p>Up To{{ $row->event_status }}<sup>%</sup> off</p>
                                    @endif
								</div>
                                @endforeach
							</div>
						</div>
						<div class="col-md-9 col-sm-8 col-xs-12">
							<div class="product-tab05">
								<div class="block-title05 lady_store">
									<h2 class="title14 font-bold text-uppercase bg-color white inline-block lady_color">Best Selling Products</h2>
								</div>
								<div class="product-slider05 arrow-style05 line-white">
									<div class="wrap-item" data-pagination="false" data-navigation="false" data-itemscustom="false">
										@foreach($bestSelling as $row)
										<div class="item-product05  product_data">
											<div class="product-thumb">
												<?php
						                         $id=$row->id;
						                         $date =Carbon\Carbon::today()->subDays(7);
						                         $OrderCount=OrderDetail::where('product_id',$id)->where('created_at','>=',$date)->count();
						                         //$OrderCount=OrderDetail::where('product_id',$id)->where('id','>',1)->count();
						                         //echo $OrderCount;die;
						                         ?>
						                      @if($OrderCount>0)
						                       <span class="ribbon hot">{{$OrderCount}}</span>
						                      @endif
						                    <a href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}" class="product-thumb-link">
						                      <img class="first-thumb" src="{{asset($row->image_one)}}" alt=""/>
						                      <img class="second-thumb" src="{{asset($row->image_two)}}" alt=""/>
						                    </a>
												<div class="product-info-cart">
					                                <div class="product-extra-link">
					                                   <input type="hidden" class="wishlist_id" value="{{$row['id']}}">
					                                   <button type="button" class="wishlist-link add-to-wishlist"><i class="fa fa-heart-o"></i>
					                                </div>
					                                <a class="addcart-link" href="{{url('product/details/'.$row['id'].'/'.$row['product_name'])}}"><i class="fa fa-shopping-basket"></i>Add Cart</a>
					                            </div>
											</div>
											    <div class="product-info5">
						                    <h3 class="title-product"><a style="text-transform:uppercase;font-weight:600;color:#ffa19a" href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}">{{$row->product_name}} @if($row->product_color !=NULL)(<span style="color:ffa19a">{{$row->product_color}}</span>)@else @endif</a></h3>
						                   <h5 style="font-weight: 700">Product-Code: <span style="color:#ffa19a">{{$row->product_code}}</span></h5>
						                    <div class="info-price">
						                    <?php
						                      $discounted_price=Product::getProductdiscount($row->id);
						                    ?>
						                    @if($discounted_price>0)
						                    <span style="color:#ffa19a">TK.{{$discounted_price}}</span><del>TK.{{$row->selling_price}}</del>
						                    @else
						                    <span style="color:#ffa19a">TK.{{$row->selling_price}}</span>
						                    @endif
						                    </div>
						                       <?php
					                            $id=$row->id;
					                           $OrderReviCount=OrderDetail::where('product_id',$id)->where('review','yes')->count();
					                           ?>
						                        <div class="product-rating">
						                        <div class="inner-rating" style="width:100%"></div>
						                        <span>({{$OrderReviCount}})</span>
						                      </div>
						                  </div>
										</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
                {{-- end of best selling products --}}

                    {{-- brand products --}}
                <div class="block-product05">
					<div class="row">
						<div class="col-md-3 col-sm-4 col-xs-12">
                            <div class="col-md-3 col-sm-4 col-xs-12">
							<div class="banner-ads05 banner-adv zoom-image line-scale">
                                <?php  $bannersImage=DB::table('quickee_banners')->where('status',1)->limit(1)->skip(4)->get();
								//dd($bannersImage);die;
								?>
                                @foreach($bannersImage as $row)
								<a  class="adv-thumb-link"><img src="{{url('public/media/quickeebanner/small/'.$row->image_two)}}" alt="" /></a>
								<div class="banner-info text-center text-uppercase">
                                    @if(isset($row->title) || isset($row->event_status))
									<h2 class="color2 title24 font-bold">{{ $row->title }}</h2>
                                    <p>Up To{{ $row->event_status }}<sup>%</sup> off</p>
                                    @endif
								</div>
                                @endforeach
							</div>
						</div>

						</div>
						<div class="col-md-9 col-sm-8 col-xs-12">
							<div class="product-tab05">
								<div class="block-title05 lady_store">
									<h2 class="title14 font-bold text-uppercase bg-color white inline-block lady_color">Brand Products</h2>
								</div>
								<div class="product-slider05 arrow-style05 line-white">
									<div class="wrap-item" data-pagination="false" data-navigation="false" data-itemscustom="false">
                                        @if(!empty($ladystoreBrand))
										@foreach($ladystoreBrand as $row)
										<div class="item-product05  product_data">
											<div class="product-thumb">
												<?php
						                         $id=$row->id;
						                         $date =Carbon\Carbon::today()->subDays(7);
                                                 //dd($date);die;

						                         $OrderCount=OrderDetail::where('product_id',$id)->where('date','>=',$date)->count();
                                                  //echo $OrderCount;die;
						                      ?>
						                      @if($OrderCount>0)
						                       <span class="ribbon hot">{{$OrderCount}}</span>
						                      @endif
						                    <a href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}" class="product-thumb-link">
						                      <img class="first-thumb" src="{{asset($row->image_one)}}" alt=""/>
						                      <img class="second-thumb" src="{{asset($row->image_two)}}" alt=""/>
						                    </a>
												<div class="product-info-cart">
					                                <div class="product-extra-link">
					                                   <input type="hidden" class="wishlist_id" value="{{$row['id']}}">
					                                   <button type="button" class="wishlist-link add-to-wishlist"><i class="fa fa-heart-o"></i>
					                                </div>
					                                <a class="addcart-link" href="{{url('product/details/'.$row['id'].'/'.$row['product_name'])}}"><i class="fa fa-shopping-basket"></i>Detail</a>
					                            </div>
											</div>
											    <div class="product-info5">
						                    <h3 class="title-product"><a style="text-transform:uppercase;font-weight:600;color:#ffa19a" href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}">{{$row->product_name}} @if($row->product_color !=NULL)(<span style="color:ffa19a">{{$row->product_color}}</span>)@else @endif</a></h3>
						                   <h5 style="font-weight: 700">Product-Code: <span style="color:#ffa19a">{{$row->product_code}}</span></h5>
						                    <div class="info-price">
						                    <?php
						                      $discounted_price=Product::getProductdiscount($row->id);
						                    ?>
						                    @if($discounted_price>0)
						                    <span style="color:#ffa19a">TK.{{$discounted_price}}</span><del>TK.{{$row->selling_price}}</del>
						                    @else
						                    <span style="color:#ffa19a">TK.{{$row->selling_price}}</span>
						                    @endif
						                    </div>
						                       <?php
					                            $id=$row->id;
					                           $OrderReviCount=OrderDetail::where('product_id',$id)->where('review','yes')->count();
					                           ?>
						                        <div class="product-rating">
						                        <div class="inner-rating" style="width:100%"></div>
						                        <span>({{$OrderReviCount}})</span>
						                      </div>
						                  </div>
										</div>
										@endforeach
                                        @else
                                        no product
                                        @endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End Latest News -->
			</div>
		</section>
@else

	<section id="content">
			<div class="container">
				<div class="banner-slider banner-slider5 simple-owl-slider">
					<div class="wrap-item" data-transition="fade" data-autoplay="true" data-pagination="true" data-navigation="false" data-itemscustom="[[0,1]]">

                            @foreach($banners as $banner)
						<div class="item-slider item-slider5">
							<div class="banner-thumb">
								<a href="#"><img src="{{url('public/media/quickeebanner/'.$banner->image_one)}}" alt="{{$banner->title_bangla}}" title="{{$banner->title_bangla}}" /></a>
							</div>
							<div class="banner-info text-uppercase font-bold animated" data-animated="zoomIn">
                                @if(!empty($banner->event_status_bangla))
								<h4>{{$banner->event_status_bangla}}</h4>
                                @endif
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<!-- End Banner Slider -->

				<!-- End Block -->
				<div class="block-product05">
					<div class="row">
						<div class="col-md-3 col-sm-4 col-xs-12">
							<div class="hot-deal05">
								<div class="block-title05 lady_store">
									<h2 class="title14 font-bold text-uppercase bg-color white inline-block lady_color">নতুন আগমন পণ্য</h2>
								</div>
								<div class="special-slider05 arrow-style05">
									<div class="wrap-item" data-pagination="false" data-navigation="false" data-itemscustom="[[0,1]]">
										@foreach($allChunk as $key=>$data)
										<div class="item">
											@foreach($data as $row)
											<div class="product-table05 table">
												<div class="zoom-image-thumb product-thumb">
													<a href="#"><img src="{{asset($row['image_one'])}}" alt="" /></a>
												</div>
												 <div class="product-info5">
													<h3 class="title-product"><a href="{{url('product/details/'.$row['id'].'/'.$row['product_name'])}}">{{$row['product_name_bangla']}}</a></h3>
													 <div class="info-price">
					                                    <?php
					                                    $discounted_price=Product::getProductdiscount($row['id']);
					                                    ?>
					                                    @if($discounted_price>0)
					                                    <span style="font-weight: 600;color:#ffa19a">TK.{{$discounted_price}}</span><del>TK.{{$row['selling_price']}}</del>
					                                    @else
					                                    <span style="font-weight: 600;color:#ffa19a">TK.{{$row['selling_price']}}</span>
					                                    @endif
					                                  </div>
					                               <?php
							                            $id=$row['id'];
							                           $OrderReviCount=OrderDetail::where('product_id',$id)->where('review','yes')->count();
							                           ?>
								                        <div class="product-rating">
								                        <div class="inner-rating" style="width:100%"></div>
								                        <span>({{$OrderReviCount}})</span>
								                      </div>
												</div>
											 </div>
											@endforeach
										</div>
										@endforeach
									</div>
								</div>
							</div>
							<!-- End Hot Deal5 -->
						</div>
						<div class="col-md-9 col-sm-8 col-xs-12">
							<div class="product-tab05">
								<div class="block-title05 lady_store">
									<h2 class="title14 font-bold text-uppercase bg-color white inline-block lady_color">বৈশিষ্ট্যযুক্ত পণ্য</h2>
								</div>
								<div class="product-slider05 arrow-style05 line-white">
									<div class="wrap-item" data-pagination="false" data-navigation="false" data-itemscustom="false" data-autoplay="true">
										@foreach($ladystore as $row)
										<div class="item-product05 product_data feature_data_item">
											 <div class="product-thumb">
					                            <?php
					                                $discounted_price=Product::getProductdiscount($row['id']);
					                                ?>
					                                @if($discounted_price>0)
					                                <span class="ribbon hot">On Sale</span>
					                                @else
					                                @endif
					                            <a class="product-thumb-link" href="{{url('product/details/'.$row['id'].'/'.$row['product_name'])}}">
					                               <img class="first-thumb" src="{{asset($row['image_one'])}}" alt=""/>
					                               <img class="second-thumb" src="{{asset($row['image_two'])}}" alt=""/>
					                            </a>
					                            <div class="product-info-cart">
					                                <div class="product-extra-link">
					                                   <input type="hidden" class="wishlist_id" value="{{$row['id']}}">
					                                   <button type="button" class="wishlist-link add-to-wishlist"><i class="fa fa-heart-o"></i>
					                                </div>
					                                <a class="addcart-link" href="{{url('product/details/'.$row['id'].'/'.$row['product_name'])}}"><i class="fa fa-shopping-basket"></i>Add Cart</a>
					                            </div>
					                        </div>
											<div class="product-info5">
												<h5 class="title-product" style="font-weight: 700;color:#ffa19a">{{$row['product_name_bangla']}}</h5>
					                            <h5 style="font-weight: 700">Product-code: <span style="color:#ffa19a">{{$row['product_code']}}</span></h5>
					                            <h5 style="font-weight: 700">Product-color: <span style="color:#ffa19a">@if($row['product_color'] !=NULL)({{$row['product_color']}})@else No color @endif</span></h5>
					                            <div class="info-price">
			                                    <?php
			                                    $discounted_price=Product::getProductdiscount($row['id']);
			                                    ?>
			                                    @if($discounted_price>0)
			                                    <span style="font-weight: 600;color:#ffa19a">TK.{{$discounted_price}}</span><del>TK.{{$row['selling_price']}}</del>
			                                    @else
			                                    <span style="font-weight: 600;color:#ffa19a">TK.{{$row['selling_price']}}</span>
			                                    @endif
					                            </div>
					                               <?php
						                            $id=$row['id'];
						                           $OrderReviCount=OrderDetail::where('product_id',$id)->where('review','yes')->count();
						                           ?>
							                        <div class="product-rating">
							                        <div class="inner-rating" style="width:100%"></div>
							                        <span>({{$OrderReviCount}})</span>
							                      </div>
											</div>
										</div>
										@endforeach
									</div>
								</div>

								<div class="banner-product05 banner-adv zoom-image pull-curtain">
									<a href="#" class="adv-thumb-link">
										<img src="{{asset('public/website/images/home/home5/banner2.jpg')}}" alt="" />
									</a>
									<div class="banner-info white text-right text-uppercase">
										<h2 class="title24 font-bold">Collection Tablet & iPad super design</h2>
										<h3 class="title14">on suppeshop on Collection</h3>
									</div>
								</div>
								<!-- End Banner -->
							</div>
						</div>
					</div>
				</div>
				<!-- End Block -->
				<div class="block-product05">
					<div class="row">
						<div class="col-md-3 col-sm-4 col-xs-12">
							<div class="banner-ads05 banner-adv zoom-image line-scale">
                                <?php  $bannersImage=DB::table('quickee_banners')->where('status',1)->limit(1)->get();
								//dd($bannersImage);die;
								?>
                                @foreach($bannersImage as $row)
								<a class="adv-thumb-link"><img src="{{url('public/media/quickeebanner/small/'.$row->image_two)}}" alt=""/></a>
								<div class="banner-info text-center text-uppercase">
                                    @if((isset($row->title_bangla)) || (isset($row->event_status_bangla)))
									<h2 class="color2 title24 font-bold">{{ $row->title_bangla }}</h2>
                                    <p>Up To{{ $row->event_status_bangla }}<sup>%</sup> off</p>

                                    @else
                                    @endif
								</div>
                                @endforeach
							</div>
						</div>
						<div class="col-md-9 col-sm-8 col-xs-12">
							<div class="product-tab05">
								<div class="block-title05 lady_store">
									<h2 class="title14 font-bold text-uppercase bg-color white inline-block lady_color">বিভাগ সম্পর্কিত পণ্য</h2>
								</div>
								<div class="product-slider05 arrow-style05 line-white">
									<div class="wrap-item" data-pagination="false" data-navigation="false" data-itemscustom="false">
										@foreach($CateProduct as $row)
										<div class="item-product05  product_data">
											<div class="product-thumb">
												<?php
						                         $id=$row->id;
						                         $date =Carbon\Carbon::today()->subDays(7);
						                         $OrderCount=OrderDetail::where('product_id',$id)->where('date','>=',$date)->count();
						                         //$OrderCount=OrderDetail::where('product_id',$id)->where('id','>',1)->count();
						                         //echo $OrderCount;die;
						                      ?>
						                      @if($OrderCount>0)
						                       <span class="ribbon hot">{{$OrderCount}}</span>
						                      @endif
						                    <a href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}" class="product-thumb-link">
						                      <img class="first-thumb" src="{{asset($row->image_one)}}" alt=""/>
						                      <img class="second-thumb" src="{{asset($row->image_two)}}" alt=""/>
						                    </a>
												<div class="product-info-cart">
					                                <div class="product-extra-link">
					                                   <input type="hidden" class="wishlist_id" value="{{$row->id}}">
					                                   <button type="button" class="wishlist-link add-to-wishlist"><i class="fa fa-heart-o"></i>
					                                </div>
					                                <a class="addcart-link" href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}"><i class="fa fa-shopping-basket"></i>Detail</a>
					                            </div>
											</div>
											    <div class="product-info5">
						                    <h3 class="title-product"><a style="text-transform:uppercase;font-weight:600;color:#ffa19a" href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}">{{$row->product_name_bangla}} @if($row->product_color !=NULL)(<span style="color:ffa19a">{{$row->product_color}}</span>)@else @endif</a></h3>
						                   <h5 style="font-weight: 700">Product-Code: <span style="color:#ffa19a">{{$row->product_code}}</span></h5>
						                    <div class="info-price">
						                    <?php
						                      $discounted_price=Product::getProductdiscount($row->id);
						                    ?>
						                    @if($discounted_price>0)
						                    <span style="color:#ffa19a">TK.{{$discounted_price}}</span><del>TK.{{$row->selling_price}}</del>
						                    @else
						                    <span style="color:#ffa19a">TK.{{$row->selling_price}}</span>
						                    @endif
						                    </div>
						                       <?php
					                            $id=$row->id;
					                           $OrderReviCount=OrderDetail::where('product_id',$id)->where('review','yes')->count();
					                           ?>
						                        <div class="product-rating">
						                        <div class="inner-rating" style="width:100%"></div>
						                        <span>({{$OrderReviCount}})</span>
						                      </div>
						                  </div>
										</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End Block -->


				<div class="block-product05">
					<div class="row">
						<div class="col-md-3 col-sm-4 col-xs-12">
							<div class="banner-ads05 banner-adv zoom-image line-scale">
                                <?php  $bannersImage=DB::table('quickee_banners')->where('status',1)->limit(1)->skip(1)->get();
								//dd($bannersImage);die;
								?>
                                @foreach($bannersImage as $row)
								<a  class="adv-thumb-link"><img src="{{url('public/media/quickeebanner/small/'.$row->image_two)}}" alt="" /></a>
								<div class="banner-info text-center text-uppercase">
                                     @if(isset($row->title_bangla) || isset($row->event_status_bangla))
									<h2 class="color2 title24 font-bold">{{ $row->title_bangla }}</h2>
                                    <p>Up To{{ $row->event_status_bangla }}<sup>%</sup> off</p>
                                    @endif

								</div>
                                @endforeach
							</div>
						</div>
						<div class="col-md-9 col-sm-8 col-xs-12">
							<div class="product-tab05">
								<div class="block-title05 lady_store">
									<h2 class="title14 font-bold text-uppercase bg-color white inline-block lady_color">দৈনন্দিন পণ্য</h2>
								</div>
								<div class="product-slider05 arrow-style05 line-white">
									<div class="wrap-item" data-pagination="false" data-navigation="false" data-itemscustom="false">
										@foreach($ladystoreJewellery as $row)
										<div class="item-product05  product_data">
											<div class="product-thumb">
												<?php
						                         $id=$row->id;
						                         $date =Carbon\Carbon::today()->subDays(7);
						                         $OrderCount=OrderDetail::where('product_id',$id)->where('created_at','>=',$date)->count();
						                         //$OrderCount=OrderDetail::where('product_id',$id)->where('id','>',1)->count();
						                         //echo $OrderCount;die;
						                      ?>
						                      @if($OrderCount>0)
						                       <span class="ribbon hot">{{$OrderCount}}</span>
						                      @endif
						                    <a href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}" class="product-thumb-link">
						                      <img class="first-thumb" src="{{asset($row->image_one)}}" alt=""/>
						                      <img class="second-thumb" src="{{asset($row->image_two)}}" alt=""/>
						                    </a>
												<div class="product-info-cart">
					                                <div class="product-extra-link">
					                                   <input type="hidden" class="wishlist_id" value="{{$row['id']}}">
					                                   <button type="button" class="wishlist-link add-to-wishlist"><i class="fa fa-heart-o"></i>
					                                </div>
					                                <a class="addcart-link" href="{{url('product/details/'.$row['id'].'/'.$row['product_name'])}}"><i class="fa fa-shopping-basket"></i>Add Cart</a>
					                            </div>
											</div>
											    <div class="product-info5">
						                    <h3 class="title-product"><a style="text-transform:uppercase;font-weight:600;color:#ffa19a" href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}">{{$row->product_name_bangla}} @if($row->product_color !=NULL)(<span style="color:ffa19a">{{$row->product_color}}</span>)@else @endif</a></h3>
						                   <h5 style="font-weight: 700">Product-Code: <span style="color:#ffa19a">{{$row->product_code}}</span></h5>
						                    <div class="info-price">
						                    <?php
						                      $discounted_price=Product::getProductdiscount($row->id);
						                    ?>
						                    @if($discounted_price>0)
						                    <span style="color:#ffa19a">TK.{{$discounted_price}}</span><del>TK.{{$row->selling_price}}</del>
						                    @else
						                    <span style="color:#ffa19a">TK.{{$row->selling_price}}</span>
						                    @endif
						                    </div>
						                       <?php
					                            $id=$row->id;
					                           $OrderReviCount=OrderDetail::where('product_id',$id)->where('review','yes')->count();
					                           ?>
						                        <div class="product-rating">
						                        <div class="inner-rating" style="width:100%"></div>
						                        <span>({{$OrderReviCount}})</span>
						                      </div>
						                  </div>
										</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

             {{-- special day products --}}
                @if(isset($byeOne->buyone_getone)==1)
                <div class="block-product05">
					<div class="row">
						<div class="col-md-3 col-sm-4 col-xs-12">
							<div class="banner-ads05 banner-adv zoom-image line-scale">
                                <?php  $bannersImage=DB::table('quickee_banners')->where('status',1)->limit(1)->skip(2)->get();
								//dd($bannersImage);die;
								?>
                                @foreach($bannersImage as $row)
								<a  class="adv-thumb-link"><img src="{{url('public/media/quickeebanner/small/'.$row->image_two)}}" alt="" /></a>
								<div class="banner-info text-center text-uppercase">
                                    @if(isset($row->title_bangla) || isset($row->event_status_bangla))
									<h2 class="color2 title24 font-bold">{{ $row->title_bangla }}</h2>
                                    <p>Up To{{ $row->event_status_bangla }}<sup>%</sup> off</p>
                                    @endif
								</div>
                                @endforeach
							</div>
						</div>
						<div class="col-md-9 col-sm-8 col-xs-12">
							<div class="product-tab05">
								<div class="block-title05 lady_store">
									<h2 class="title14 font-bold text-uppercase bg-color white inline-block lady_color">বিশেষ দিন অফার পণ্য</h2>
								</div>
								<div class="product-slider05 arrow-style05 line-white">
									<div class="wrap-item" data-pagination="false" data-navigation="false" data-itemscustom="false">
										@foreach($byeOne as $row)
										<div class="item-product05  product_data">
											<div class="product-thumb">
												<?php
						                         $id=$row->id;
						                         $date =Carbon\Carbon::today()->subDays(7);
						                         $OrderCount=OrderDetail::where('product_id',$id)->where('created_at','>=',$date)->count();
						                         //$OrderCount=OrderDetail::where('product_id',$id)->where('id','>',1)->count();
						                         //echo $OrderCount;die;
						                      ?>
						                      @if($OrderCount>0)
						                       <span class="ribbon hot">{{$OrderCount}}</span>
						                      @endif
						                    <a href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}" class="product-thumb-link">
						                      <img class="first-thumb" src="{{asset($row->image_one)}}" alt=""/>
						                      <img class="second-thumb" src="{{asset($row->image_two)}}" alt=""/>
						                    </a>
												<div class="product-info-cart">
					                                <div class="product-extra-link">
					                                   <input type="hidden" class="wishlist_id" value="{{$row['id']}}">
					                                   <button type="button" class="wishlist-link add-to-wishlist"><i class="fa fa-heart-o"></i>
					                                </div>
					                                <a class="addcart-link" href="{{url('product/details/'.$row['id'].'/'.$row['product_name'])}}"><i class="fa fa-shopping-basket"></i>Add Cart</a>
					                            </div>
											</div>
											    <div class="product-info5">
						                    <h3 class="title-product"><a style="text-transform:uppercase;font-weight:600;color:#ffa19a" href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}">{{$row->product_name_bangla}} @if($row->product_color !=NULL)(<span style="color:ffa19a">{{$row->product_color}}</span>)@else @endif</a></h3>
						                   <h5 style="font-weight: 700">Product-Code: <span style="color:#ffa19a">{{$row->product_code}}</span></h5>
						                    <div class="info-price">
						                    <?php
						                      $discounted_price=Product::getProductdiscount($row->id);
						                    ?>
						                    @if($discounted_price>0)
						                    <span style="color:#ffa19a">TK.{{$discounted_price}}</span><del>TK.{{$row->selling_price}}</del>
						                    @else
						                    <span style="color:#ffa19a">TK.{{$row->selling_price}}</span>
						                    @endif
						                    </div>
						                       <?php
					                            $id=$row->id;
					                           $OrderReviCount=OrderDetail::where('product_id',$id)->where('review','yes')->count();
					                           ?>
						                        <div class="product-rating">
						                        <div class="inner-rating" style="width:100%"></div>
						                        <span>({{$OrderReviCount}})</span>
						                      </div>
						                  </div>
										</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
                @endif

                {{-- best selling Product --}}

                <div class="block-product05">
					<div class="row">
						<div class="col-md-3 col-sm-4 col-xs-12">
							<div class="banner-ads05 banner-adv zoom-image line-scale">
                                <?php  $bannersImage=DB::table('quickee_banners')->where('status',1)->limit(1)->skip(3)->get();
								//dd($bannersImage);die;
								?>
                                @foreach($bannersImage as $row)
								<a  class="adv-thumb-link"><img src="{{url('public/media/quickeebanner/small/'.$row->image_two)}}" alt="" /></a>
								<div class="banner-info text-center text-uppercase">
                                    @if(isset($row->title_bangla) || isset($row->event_status_bangla))
									<h2 class="color2 title24 font-bold">{{ $row->title_bangla }}</h2>
                                    <p>Up To{{ $row->event_status_bangla }}<sup>%</sup> off</p>
                                    @endif
								</div>
                                @endforeach
							</div>
						</div>
						<div class="col-md-9 col-sm-8 col-xs-12">
							<div class="product-tab05">
								<div class="block-title05 lady_store">
									<h2 class="title14 font-bold text-uppercase bg-color white inline-block lady_color">সেরা বিক্রয় পণ্য</h2>
								</div>
								<div class="product-slider05 arrow-style05 line-white">
									<div class="wrap-item" data-pagination="false" data-navigation="false" data-itemscustom="false">
										@foreach($bestSelling as $row)
										<div class="item-product05  product_data">
											<div class="product-thumb">
												<?php
						                         $id=$row->id;
						                         $date =Carbon\Carbon::today()->subDays(7);
						                         $OrderCount=OrderDetail::where('product_id',$id)->where('created_at','>=',$date)->count();
						                         //$OrderCount=OrderDetail::where('product_id',$id)->where('id','>',1)->count();
						                         //echo $OrderCount;die;
						                      ?>
						                      @if($OrderCount>0)
						                       <span class="ribbon hot">{{$OrderCount}}</span>
						                      @endif
						                    <a href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}" class="product-thumb-link">
						                      <img class="first-thumb" src="{{asset($row->image_one)}}" alt=""/>
						                      <img class="second-thumb" src="{{asset($row->image_two)}}" alt=""/>
						                    </a>
												<div class="product-info-cart">
					                                <div class="product-extra-link">
					                                   <input type="hidden" class="wishlist_id" value="{{$row['id']}}">
					                                   <button type="button" class="wishlist-link add-to-wishlist"><i class="fa fa-heart-o"></i>
					                                </div>
					                                <a class="addcart-link" href="{{url('product/details/'.$row['id'].'/'.$row['product_name'])}}"><i class="fa fa-shopping-basket"></i>Add Cart</a>
					                            </div>
											</div>
											    <div class="product-info5">
						                    <h3 class="title-product"><a style="text-transform:uppercase;font-weight:600;color:#ffa19a" href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}">{{$row->product_name_bangla}} @if($row->product_color !=NULL)(<span style="color:ffa19a">{{$row->product_color}}</span>)@else @endif</a></h3>
						                   <h5 style="font-weight: 700">Product-Code: <span style="color:#ffa19a">{{$row->product_code}}</span></h5>
						                    <div class="info-price">
						                    <?php
						                      $discounted_price=Product::getProductdiscount($row->id);
						                    ?>
						                    @if($discounted_price>0)
						                    <span style="color:#ffa19a">TK.{{$discounted_price}}</span><del>TK.{{$row->selling_price}}</del>
						                    @else
						                    <span style="color:#ffa19a">TK.{{$row->selling_price}}</span>
						                    @endif
						                    </div>
						                       <?php
					                            $id=$row->id;
					                           $OrderReviCount=OrderDetail::where('product_id',$id)->where('review','yes')->count();
					                           ?>
						                        <div class="product-rating">
						                        <div class="inner-rating" style="width:100%"></div>
						                        <span>({{$OrderReviCount}})</span>
						                      </div>
						                  </div>
										</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>



              {{-- brand --}}

                <div class="block-product05">
					<div class="row">
						<div class="col-md-3 col-sm-4 col-xs-12">
                            <div class="col-md-3 col-sm-4 col-xs-12">
							<div class="banner-ads05 banner-adv zoom-image line-scale">
                                <?php  $bannersImage=DB::table('quickee_banners')->where('status',1)->limit(1)->skip(4)->get();
								//dd($bannersImage);die;
								?>
                                @foreach($bannersImage as $row)
								<a  class="adv-thumb-link"><img src="{{url('public/media/quickeebanner/small/'.$row->image_two)}}" alt="" /></a>
								<div class="banner-info text-center text-uppercase">
                                    @if(isset($row->title_bangla) || isset($row->event_status_bangla))
									<h2 class="color2 title24 font-bold">{{ $row->title_bangla}}</h2>
                                    <p>Up To{{ $row->event_status_bangla}}<sup>%</sup> off</p>
                                    @endif
								</div>
                                @endforeach
							</div>
						</div>

						</div>
						<div class="col-md-9 col-sm-8 col-xs-12">
							<div class="product-tab05">
								<div class="block-title05 lady_store">
									<h2 class="title14 font-bold text-uppercase bg-color white inline-block lady_color">ব্র্যান্ড পণ্য</h2>
								</div>
								<div class="product-slider05 arrow-style05 line-white">
									<div class="wrap-item" data-pagination="false" data-navigation="false" data-itemscustom="false">
                                        @if(!empty($ladystoreBrand))
										@foreach($ladystoreBrand as $row)
										<div class="item-product05  product_data">
											<div class="product-thumb">
												<?php
						                         $id=$row->id;
						                         $date =Carbon\Carbon::today()->subDays(7);
                                                 //dd($date);die;

						                         $OrderCount=OrderDetail::where('product_id',$id)->where('date','>=',$date)->count();
                                                  //echo $OrderCount;die;
						                      ?>
						                      @if($OrderCount>0)
						                       <span class="ribbon hot">{{$OrderCount}}</span>
						                      @endif
						                    <a href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}" class="product-thumb-link">
						                      <img class="first-thumb" src="{{asset($row->image_one)}}" alt=""/>
						                      <img class="second-thumb" src="{{asset($row->image_two)}}" alt=""/>
						                    </a>
												<div class="product-info-cart">
					                                <div class="product-extra-link">
					                                   <input type="hidden" class="wishlist_id" value="{{$row['id']}}">
					                                   <button type="button" class="wishlist-link add-to-wishlist"><i class="fa fa-heart-o"></i>
					                                </div>
					                                <a class="addcart-link" href="{{url('product/details/'.$row['id'].'/'.$row['product_name'])}}"><i class="fa fa-shopping-basket"></i>Detail</a>
					                            </div>
											</div>
											    <div class="product-info5">
						                    <h3 class="title-product"><a style="text-transform:uppercase;font-weight:600;color:#ffa19a" href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}">{{$row->product_name_bangla}} @if($row->product_color !=NULL)(<span style="color:ffa19a">{{$row->product_color}}</span>)@else @endif</a></h3>
						                   <h5 style="font-weight: 700">Product-Code: <span style="color:#ffa19a">{{$row->product_code}}</span></h5>
						                    <div class="info-price">
						                    <?php
						                      $discounted_price=Product::getProductdiscount($row->id);
						                    ?>
						                    @if($discounted_price>0)
						                    <span style="color:#ffa19a">TK.{{$discounted_price}}</span><del>TK.{{$row->selling_price}}</del>
						                    @else
						                    <span style="color:#ffa19a">TK.{{$row->selling_price}}</span>
						                    @endif
						                    </div>
						                       <?php
					                            $id=$row->id;
					                           $OrderReviCount=OrderDetail::where('product_id',$id)->where('review','yes')->count();
					                           ?>
						                        <div class="product-rating">
						                        <div class="inner-rating" style="width:100%"></div>
						                        <span>({{$OrderReviCount}})</span>
						                      </div>
						                  </div>
										</div>
										@endforeach
                                        @else
                                        no product
                                        @endif
									</div>
								</div>
							</div>
						</div>
					</div>
				 </div>

				<!-- End Latest News -->
			</div>
		</section>
    @endif
@endsection
