@extends('layouts.app')
@section('content')
<style>
    .list-shop-cat a {
    border: none !important;
    border-radius: 0 !important;
     color: none !important;
    height: 0 !important;
    line-height: 36px;
    padding:0 !important;
    font-size: 20px; !important
    position: relative;
     background: 0 !important;
    -webkit-transition: all 0.3s ease-out 0s;
    transition: all 0.3s ease-out 0s;
      float: left !important;
    padding: 1px 10px !important;
    position: relative !important;
    top: 0px !important;
}
    .list-shop-cat {
    background: #fafafa none repeat scroll 0 0;
    border: 1px solid #e8e8e8;
    padding: 0px !important;
}
.list-shop-cat li .list_li{
   margin-bottom: 8px !important;
}
.product-desc {
    border-top: 0 !important;
}
.sort_form{
    float: left;
    padding: 4px 7px;
}
.category-filter input{
    margin-bottom: 2px !important;
    width: 95% !important;
    margin-top: 11px !important;
    position: relative !important;
    top: 20px !important;
    left: -115px !important;
    border-radius: 5px;
    height: 11px !important;
    border: 0px;
    font-family: georgia;
    font-size: 13px;
    text-align: center;
}
.box-filter li {
    margin-bottom: -13px !important;
    padding-left: 11px !important;
}
</style>
@if(session()->get('lang')=="bangla")
	<section id="content">
		<div class="content-shop">
			<div class="container">
				<div class="row">
                       <div class="col-md-3 col-sm-4 col-xs-12">
                        @include('pages.sidebar_lady_listing')
					  </div>
					<div class="col-md-9 col-sm-8 col-xs-12">
						<div class="main-content-shop">
                             <div class="banner-shop-slider">
								<div class="wrap-item" data-navigation="true" data-pagination="false" data-itemscustom="[[0,1]]">
                                    <?php
                                    $banners=DB::table('ladybanners')->where('status',1)->limit(3)->latest()->get();
                                    ?>
								    @foreach($banners as $banner)
                                    	<div class="item">
										<div class="item-shop-slider">
											<div class="shop-slider-thumb">
												<a href="#"><img src="{{asset($banner->banner)}}" alt="{{$banner->meta_title}}" title="{{$banner->meta_title}}" /></a>
											</div>
											<div class="shop-slider-info">
												<h3>{{$banner->product_name}}</h3>
												<h4>{{$banner->event_status}}</h4>
												<h5>{{$banner->discount_status}}</h5>
											</div>
										</div>
									</div>
                                  @endforeach

									<!-- End Item -->
								</div>
							</div>
							<!-- End Banner Slider -->
							<div class="list-shop-cat">
								<ul>
									<li><a class="list_li" href="{{url('/')}}">Home</a></li>
									<li><?php echo $ladycateDetails['breadcumbs'];?></li>
								</ul>
                                <h3></h3>
							</div>
							<!-- End List Shop Cat -->
							<div class="shop-tab-product">
								<div class="shop-tab-title">
									<h2>{{$ladycateDetails['ladycateDetails']['category_name']}} &nbsp;<span style="color:#0B7CBB;">({{count($categoryPro)}})</span></h2>

								</div>
								<div class="tab-content filter_products">
									<div role="tabpanel" class="tab-pane fade in active" id="product-grid">
										@include('pages.ajax_product_lady_listing')

										<!-- End Sort Pagibar -->
									</div>

								</div>
							</div>

                            <div class="product_listing_ajax">
                                <div class="row">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="sort-pagi-bar">
                                                         <div class="sort_form">
                                                        <form name="sortProducts" id="sortProducts">
                                                            <input type="hidden" name="url" value="{{$url}}" id="url">
                                                        <div class="control-group">
														<label for="" class="control-label alignL">sort By</label>
														<select name="sort" id="sort">
                                                            <option value="">select</option>
                                                            <option value="product_latest" @if(isset($_GET['sort']) && $_GET['sort']=="product_latest") selected="" @endif>Latest Product</option>
                                                            <option value="Product_name_a_z" @if(isset($_GET['sort']) && $_GET['sort']=="Product_name_a_z") selected="" @endif>Product_name_A_Z</option>
                                                            <option value="Product_name_z_a"  @if(isset($_GET['sort']) && $_GET['sort']=="Product_name_z_a") selected="" @endif>Product_name_Z_A</option>
                                                            <option value="price_lowest"  @if(isset($_GET['sort']) && $_GET['sort']=="price_lowest") selected="" @endif>Lowest Price first</option>
                                                            <option value="price_highest"  @if(isset($_GET['sort']) && $_GET['sort']=="price_highest") selected="" @endif>Highest Price</option>
                                                        </select>
													</div>
                                                    </form>
                                                   </div>
													<div class="product-per-page">
                                                        @if(isset($_GET['sort']) && !empty($_GET['sort']))
                                                        {{ $categoryPro->appends(['sort' => $_GET['sort']])->links()}}

                                                        @else
                                                       {{$categoryPro->links()}}
                                                       @endif
													</div>
												</div>
											</div>
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
    @else
    	<section id="content">
		<div class="content-shop">
			<div class="container">
				<div class="row">
                       <div class="col-md-3 col-sm-4 col-xs-12">
                        @include('pages.sidebar_lady_listing')
					  </div>
					<div class="col-md-9 col-sm-8 col-xs-12">
						<div class="main-content-shop">
                          <div class="banner-shop-slider">
								<div class="wrap-item" data-navigation="true" data-pagination="false" data-itemscustom="[[0,1]]">
                                    <?php
                                    $banners=DB::table('ladybanners')->where('status',1)->limit(3)->latest()->get();
                                    ?>
								    @foreach($banners as $banner)
                                    	<div class="item">
										<div class="item-shop-slider">
											<div class="shop-slider-thumb">
												<a href="#"><img src="{{asset($banner->banner)}}" alt="{{$banner->meta_title_bangla}}" title="{{$banner->meta_title_bangla}}" /></a>
											</div>
											<div class="shop-slider-info">
												<h3>{{$banner->product_name_bangla}}</h3>
												<h4>{{$banner->event_status_bangla}}</h4>
												<h5>{{$banner->discount_status_bangla}}</h5>
											</div>
										</div>
									</div>
                                  @endforeach

									<!-- End Item -->
								</div>
							</div>
							<!-- End Banner Slider -->
							<div class="list-shop-cat">
								<ul>
									<li><a class="list_li" href="{{url('/')}}">বাড়ি</a></li>
									<li><?php echo $ladycateDetails['breadcumb'];?></li>
								</ul>
                                <h3></h3>
							</div>
							<!-- End List Shop Cat -->
							<div class="shop-tab-product">
								<div class="shop-tab-title">
									<h2>{{$ladycateDetails['ladycateDetails']['bangla_name']}} &nbsp;<span style="color:#0B7CBB;">({{count($categoryPro)}})</span></h2>
								</div>
								<div class="tab-content filter_products">
									<div role="tabpanel" class="tab-pane fade in active" id="product-grid">
										@include('pages.ajax_product_lady_listing')

										<!-- End Sort Pagibar -->
									</div>

								</div>
							</div>

                            <div class="product_listing_ajax">
                                <div class="row">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="sort-pagi-bar">
                                                         <div class="sort_form">
                                                        <form name="sortProducts" id="sortProducts">
                                                            <input type="hidden" name="url" value="{{$url}}" id="url">
                                                        <div class="control-group">
														<label for="" class="control-label alignL">ক্রমানুসার</label>
														<select name="sort" id="sort">
                                                            <option value="">নির্বাচন করুন</option>
                                                            <option value="product_latest" @if(isset($_GET['sort']) && $_GET['sort']=="product_latest") selected="" @endif>সর্বশেষ পণ্য</option>
                                                            <option value="Product_name_a_z" @if(isset($_GET['sort']) && $_GET['sort']=="Product_name_a_z") selected="" @endif>পণ্য_নাম_এ_জেড</option>
                                                            <option value="Product_name_z_a"  @if(isset($_GET['sort']) && $_GET['sort']=="Product_name_z_a") selected="" @endif>পণ্য_নাম_জেড_এ</option>
                                                            <option value="price_lowest"  @if(isset($_GET['sort']) && $_GET['sort']=="price_lowest") selected="" @endif>সর্বনিম্ন দাম</option>
                                                            <option value="price_highest"  @if(isset($_GET['sort']) && $_GET['sort']=="price_highest") selected="" @endif>সর্বোচ্চ মূল্য</option>
                                                        </select>
													</div>
                                                    </form>
                                                   </div>
													<div class="product-per-page">
                                                        @if(isset($_GET['sort']) && !empty($_GET['sort']))
                                                        {{ $categoryPro->appends(['sort' => $_GET['sort']])->links()}}

                                                        @else
                                                       {{$categoryPro->links()}}
                                                       @endif
													</div>
												</div>
											</div>
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
    @endif
	<!-- End Content -->

	@endsection
