@extends('layouts.app')
@section('content')
<section id="content">
		<div class="content-shop">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-4 col-xs-12">
						<div class="sidebar-shop sidebar-left">
							<div class="widget widget-filter">
								<div class="box-filter category-filter">
									<h2 class="widget-title">CATEGORY</h2>
									<ul>
										<li><a href="#"> Maxi Dresses (32)</a></li>
										<li><a href="#"> Vintage Dresses (15)</a></li>
										<li><a href="#"> Bodycon Dresses (24)</a></li>
										<li><a href="#"> Fit & Flare Dresses (8)</a></li>
									</ul>
								</div>
								<!-- End Category -->
								<div class="box-filter price-filter">
									<h2 class="widget-title">price</h2>
									<div class="inner-price-filter">
										<ul>
											<li><a href="#">$ Under-10 (29)</a></li>
											<li><a href="#">$ 10-20 (29)</a></li>
											<li><a href="#">$ 20-40 (29)</a></li>
											<li><a href="#">$ 40-50 (29)</a></li>
											<li><a href="#">$ 50-80 (29)</a></li>
										</ul>
										<div class="range-filter">
											<label>$</label>
											<div id="amount"></div>
											<button class="btn-filter">Filter</button>
											<div id="slider-range"></div>
										</div>
									</div>
								</div>
								<!-- End Price -->
								<div class="box-filter color-filter">
									<h2 class="widget-title">Color</h2>
									<div class="list-color-filter">
										<a href="#" style="background-color:#ffffff"></a>
										<a href="#" style="background-color:#e66054"></a>
										<a href="#" style="background-color:#d0b7cc"></a>
										<a href="#" style="background-color:#107a8e"></a>
										<a href="#" style="background-color:#b9cad2"></a>
										<a href="#" style="background-color:#a7bc93"></a>
										<a href="#" style="background-color:#d3b627"></a>
										<a href="#" style="background-color:#b4b3ae"></a>
										<a href="#" style="background-color:#502006"></a>
										<a href="#" style="background-color:#311e21"></a>
										<a href="#" style="background-color:#e6b3af"></a>
										<a href="#" style="background-color:#f3d213"></a>
										<a href="#" style="background-color:#bd0316"></a>
										<a href="#" style="background-color:#cd0c20"></a>
									</div>
								</div>
								<!-- End Color -->
								<div class="box-filter manufacturer-filter">
									<h2 class="widget-title">Manufacturers</h2>
									<ul>
										<li><a href="#">D&D Fashion</a></li>
										<li><a href="#">London Fashion</a></li>
										<li><a href="#">Milanno Fashion</a></li>
										<li><a href="#">Gucci</a></li>
										<li><a href="#">CK Fashion</a></li>
									</ul>
								</div>
								<!-- End Manufacturers -->
							</div>
							<!-- End Filter -->
							<div class="widget widget-vote">
								<h2 class="widget-title">COMMUNITY POLL</h2>
								<p>What is your favorite color</p>
								<ul>
									<li><a href="#">Green</a></li>
									<li><a href="#" class="active">Red</a></li>
									<li><a href="#">Black</a></li>
									<li><a href="#">Magenta</a></li>
								</ul>
								<button>Vote</button>
							</div>
							<!-- End Vote -->
							<div class="widget widget-adv">
								<h2 class="title-widget-adv">
									<span>Week</span>
									<strong>big sale</strong>
								</h2>
								<div class="wrap-item" data-itemscustom="[[0,1]]" data-pagination="true" data-navigation="false">
									<div class="item">
										<div class="item-widget-adv">
											<div class="adv-widget-thumb">
												<a href="#"><img src="images/grid/sl1.jpg" alt="" /></a>
											</div>
											<div class="adv-widget-info">
												<h3>New Collection</h3>
												<h2><span>from</span> 40% off</h2>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="item-widget-adv">
											<div class="adv-widget-thumb">
												<a href="#"><img src="images/grid/sl2.jpg" alt="" /></a>
											</div>
											<div class="adv-widget-info">
												<h3>Quality usinesswear </h3>
												<h2><span>from</span> 30% off</h2>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="item-widget-adv">
											<div class="adv-widget-thumb">
												<a href="#"><img src="images/grid/sl3.jpg" alt="" /></a>
											</div>
											<div class="adv-widget-info">
												<h3>Hanbags Style 2016</h3>
												<h2><span>from</span> 20% off</h2>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- End Adv -->
						</div>
						<!-- End Sidebar Shop -->
					</div>
					<div class="col-md-9 col-sm-8 col-xs-12">
						<div class="main-content-shop">
							<div class="banner-shop-slider">
								<div class="wrap-item" data-pagination="false" data-navigation="true" data-itemscustom="[[0,1]]">
									<div class="item">
										<div class="item-shop-slider">
											<div class="shop-slider-thumb">
												<a href="#"><img src="images/grid/bn3.jpg" alt="" /></a>
											</div>
											<div class="shop-slider-info">
												<h3>jewelry-bracelets</h3>
												<h2>exta 35% off </h2>
												<a href="#" class="shop-now">shop now</a>
											</div>
										</div>
									</div>
									<!-- End Item -->
									<div class="item">
										<div class="item-shop-slider">
											<div class="shop-slider-thumb">
												<a href="#"><img src="images/grid/bn2.jpg" alt="" /></a>
											</div>
											<div class="shop-slider-info">
												<h3>jewelry-bracelets</h3>
												<h2>exta 35% off </h2>
												<a href="#" class="shop-now">shop now</a>
											</div>
										</div>
									</div>
									<!-- End Item -->
									<div class="item">
										<div class="item-shop-slider">
											<div class="shop-slider-thumb">
												<a href="#"><img src="images/grid/bn1.jpg" alt="" /></a>
											</div>
											<div class="shop-slider-info">
												<h3>jewelry-bracelets</h3>
												<h2>exta 35% off </h2>
												<a href="#" class="shop-now">shop now</a>
											</div>
										</div>
									</div>
									<!-- End Item -->
									<div class="item">
										<div class="item-shop-slider">
											<div class="shop-slider-thumb">
												<a href="#"><img src="images/grid/bn4.jpg" alt="" /></a>
											</div>
											<div class="shop-slider-info">
												<h3>jewelry-bracelets</h3>
												<h2>exta 35% off </h2>
												<a href="#" class="shop-now">shop now</a>
											</div>
										</div>
									</div>
									<!-- End Item -->
									<div class="item">
										<div class="item-shop-slider">
											<div class="shop-slider-thumb">
												<a href="#"><img src="images/grid/bn5.jpg" alt="" /></a>
											</div>
											<div class="shop-slider-info">
												<h3>jewelry-bracelets</h3>
												<h2>exta 35% off </h2>
												<a href="#" class="shop-now">shop now</a>
											</div>
										</div>
									</div>
									<!-- End Item -->
								</div>
							</div>
							<!-- End Banner Slider -->
							<div class="list-shop-cat">
								<ul>
									<li><a href="#">Women <span>15</span></a></li>
									<li><a href="#">Men <span>10</span></a></li>
									<li><a href="#">Kids & Baby <span>4</span></a></li>
									<li><a href="#">Bags & Shoes <span>3</span></a></li>
									<li><a href="#">Jewelry & Watches <span>8</span></a></li>
									<li><a href="#">Electronics <span>5</span></a></li>
								</ul>
							</div>
							<!-- End List Shop Cat -->
							<div class="shop-tab-product">
								<div class="shop-tab-title">
									<h2>Maxi dresses</h2>
									<ul class="shop-tab-select">
										<li><a href="#product-grid" class="grid-tab" data-toggle="tab"></a></li>
										<li class="active"><a href="#product-list" class="list-tab" data-toggle="tab"></a></li>
									</ul>
								</div>
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane fade" id="product-grid">
										<ul class="row product-grid">
											<li class="col-md-4 col-sm-6 col-xs-12">
												<div class="item-product">
													<div class="product-thumb">
														<a class="product-thumb-link" href="detail.html">
															<img class="first-thumb" alt="" src="images/photos/extras/17.jpg">
															<img class="second-thumb" alt="" src="images/photos/extras/18.jpg">
														</a>
														<div class="product-info-cart">
															<div class="product-extra-link">
																<a class="wishlist-link" href="#"><i class="fa fa-heart-o"></i></a>
																<a class="compare-link" href="#"><i class="fa fa-toggle-on"></i></a>
																<a class="quickview-link fancybox.ajax" href="quick-view.html"><i class="fa fa-search"></i></a>
															</div>
															<a class="addcart-link" href="#"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
														</div>
													</div>
													<div class="product-info">
														<h3 class="title-product"><a href="#">Burberry Pink & black</a></h3>
														<div class="info-price">
															<span>$59.52</span><del>$17.96</del>
														</div>
														<div class="product-rating">
															<div class="inner-rating" style="width:100%"></div>
															<span>(6s)</span>
														</div>
													</div>
												</div>
											</li>
											<li class="col-md-4 col-sm-6 col-xs-12">
												<div class="item-product">
													<div class="product-thumb">
														<a class="product-thumb-link" href="detail.html">
															<img class="first-thumb" alt="" src="images/photos/extras/15.jpg">
															<img class="second-thumb" alt="" src="images/photos/extras/19.jpg">
														</a>
														<div class="product-info-cart">
															<div class="product-extra-link">
																<a class="wishlist-link" href="#"><i class="fa fa-heart-o"></i></a>
																<a class="compare-link" href="#"><i class="fa fa-toggle-on"></i></a>
																<a class="quickview-link fancybox.ajax" href="quick-view.html"><i class="fa fa-search"></i></a>
															</div>
															<a class="addcart-link" href="#"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
														</div>
													</div>
													<div class="product-info">
														<h3 class="title-product"><a href="#">Burberry Pink & black</a></h3>
														<div class="info-price">
															<span>$59.52</span><del>$17.96</del>
														</div>
														<div class="product-rating">
															<div class="inner-rating" style="width:100%"></div>
															<span>(6s)</span>
														</div>
													</div>
												</div>
											</li>
											<li class="col-md-4 col-sm-6 col-xs-12">
												<div class="item-product">
													<div class="product-thumb">
														<a class="product-thumb-link" href="detail.html">
															<img class="first-thumb" alt="" src="images/photos/extras/16.jpg">
															<img class="second-thumb" alt="" src="images/photos/extras/22.jpg">
														</a>
														<div class="product-info-cart">
															<div class="product-extra-link">
																<a class="wishlist-link" href="#"><i class="fa fa-heart-o"></i></a>
																<a class="compare-link" href="#"><i class="fa fa-toggle-on"></i></a>
																<a class="quickview-link fancybox.ajax" href="quick-view.html"><i class="fa fa-search"></i></a>
															</div>
															<a class="addcart-link" href="#"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
														</div>
													</div>
													<div class="product-info">
														<h3 class="title-product"><a href="#">Burberry Pink & black</a></h3>
														<div class="info-price">
															<span>$59.52</span><del>$17.96</del>
														</div>
														<div class="product-rating">
															<div class="inner-rating"  style="width:60%"></div>
															<span>(6s)</span>
														</div>
													</div>
													<div class="percent-saleoff">
														<span><label>55%</label> OFF</span>
													</div>
												</div>
											</li>
											<li class="col-md-4 col-sm-6 col-xs-12">
												<div class="item-product">
													<div class="product-thumb">
														<a class="product-thumb-link" href="detail.html">
															<img class="first-thumb" alt="" src="images/photos/extras/13.jpg">
															<img class="second-thumb" alt="" src="images/photos/extras/11.jpg">
														</a>
														<div class="product-info-cart">
															<div class="product-extra-link">
																<a class="wishlist-link" href="#"><i class="fa fa-heart-o"></i></a>
																<a class="compare-link" href="#"><i class="fa fa-toggle-on"></i></a>
																<a class="quickview-link fancybox.ajax" href="quick-view.html"><i class="fa fa-search"></i></a>
															</div>
															<a class="addcart-link" href="#"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
														</div>
													</div>
													<div class="product-info">
														<h3 class="title-product"><a href="#">Burberry Pink & black</a></h3>
														<div class="info-price">
															<span>$59.52</span><del>$17.96</del>
														</div>
														<div class="product-rating">
															<div class="inner-rating" style="width:100%"></div>
															<span>(6s)</span>
														</div>
													</div>
												</div>
											</li>
											<li class="col-md-4 col-sm-6 col-xs-12">
												<div class="item-product">
													<div class="product-thumb">
														<a class="product-thumb-link" href="detail.html">
															<img class="first-thumb" alt="" src="images/photos/extras/14.jpg">
															<img class="second-thumb" alt="" src="images/photos/extras/12.jpg">
														</a>
														<div class="product-info-cart">
															<div class="product-extra-link">
																<a class="wishlist-link" href="#"><i class="fa fa-heart-o"></i></a>
																<a class="compare-link" href="#"><i class="fa fa-toggle-on"></i></a>
																<a class="quickview-link fancybox.ajax" href="quick-view.html"><i class="fa fa-search"></i></a>
															</div>
															<a class="addcart-link" href="#"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
														</div>
													</div>
													<div class="product-info">
														<h3 class="title-product"><a href="#">Burberry Pink & black</a></h3>
														<div class="info-price">
															<span>$59.52</span><del>$17.96</del>
														</div>
														<div class="product-rating">
															<div class="inner-rating" style="width:100%"></div>
															<span>(6s)</span>
														</div>
													</div>
												</div>
											</li>
											<li class="col-md-4 col-sm-6 col-xs-12">
												<div class="item-product">
													<div class="product-thumb">
														<a class="product-thumb-link" href="detail.html">
															<img class="first-thumb" alt="" src="images/photos/extras/3.jpg">
															<img class="second-thumb" alt="" src="images/photos/extras/4.jpg">
														</a>
														<div class="product-info-cart">
															<div class="product-extra-link">
																<a class="wishlist-link" href="#"><i class="fa fa-heart-o"></i></a>
																<a class="compare-link" href="#"><i class="fa fa-toggle-on"></i></a>
																<a class="quickview-link fancybox.ajax" href="quick-view.html"><i class="fa fa-search"></i></a>
															</div>
															<a class="addcart-link" href="#"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
														</div>
													</div>
													<div class="product-info">
														<h3 class="title-product"><a href="#">Burberry Pink & black</a></h3>
														<div class="info-price">
															<span>$59.52</span><del>$17.96</del>
														</div>
														<div class="product-rating">
															<div class="inner-rating" style="width:100%"></div>
															<span>(6s)</span>
														</div>
													</div>
													<div class="percent-saleoff">
														<span><label>55%</label> OFF</span>
													</div>
												</div>
											</li>
											<li class="col-md-4 col-sm-6 col-xs-12">
												<div class="item-product">
													<div class="product-thumb">
														<a class="product-thumb-link" href="detail.html">
															<img class="first-thumb" alt="" src="images/photos/extras/18.jpg">
															<img class="second-thumb" alt="" src="images/photos/extras/17.jpg">
														</a>
														<div class="product-info-cart">
															<div class="product-extra-link">
																<a class="wishlist-link" href="#"><i class="fa fa-heart-o"></i></a>
																<a class="compare-link" href="#"><i class="fa fa-toggle-on"></i></a>
																<a class="quickview-link fancybox.ajax" href="quick-view.html"><i class="fa fa-search"></i></a>
															</div>
															<a class="addcart-link" href="#"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
														</div>
													</div>
													<div class="product-info">
														<h3 class="title-product"><a href="#">Burberry Pink & black</a></h3>
														<div class="info-price">
															<span>$59.52</span><del>$17.96</del>
														</div>
														<div class="product-rating">
															<div class="inner-rating" style="width:100%"></div>
															<span>(6s)</span>
														</div>
													</div>
												</div>
											</li>
											<li class="col-md-4 col-sm-6 col-xs-12">
												<div class="item-product">
													<div class="product-thumb">
														<a class="product-thumb-link" href="detail.html">
															<img class="first-thumb" alt="" src="images/photos/extras/21.jpg">
															<img class="second-thumb" alt="" src="images/photos/extras/20.jpg">
														</a>
														<div class="product-info-cart">
															<div class="product-extra-link">
																<a class="wishlist-link" href="#"><i class="fa fa-heart-o"></i></a>
																<a class="compare-link" href="#"><i class="fa fa-toggle-on"></i></a>
																<a class="quickview-link fancybox.ajax" href="quick-view.html"><i class="fa fa-search"></i></a>
															</div>
															<a class="addcart-link" href="#"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
														</div>
													</div>
													<div class="product-info">
														<h3 class="title-product"><a href="#">Burberry Pink & black</a></h3>
														<div class="info-price">
															<span>$59.52</span><del>$17.96</del>
														</div>
														<div class="product-rating">
															<div class="inner-rating" style="width:100%"></div>
															<span>(6s)</span>
														</div>
													</div>
												</div>
											</li>
											<li class="col-md-4 col-sm-6 col-xs-12">
												<div class="item-product">
													<div class="product-thumb">
														<a class="product-thumb-link" href="detail.html">
															<img class="first-thumb" alt="" src="images/photos/extras/19.jpg">
															<img class="second-thumb" alt="" src="images/photos/extras/15.jpg">
														</a>
														<div class="product-info-cart">
															<div class="product-extra-link">
																<a class="wishlist-link" href="#"><i class="fa fa-heart-o"></i></a>
																<a class="compare-link" href="#"><i class="fa fa-toggle-on"></i></a>
																<a class="quickview-link fancybox.ajax" href="quick-view.html"><i class="fa fa-search"></i></a>
															</div>
															<a class="addcart-link" href="#"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
														</div>
													</div>
													<div class="product-info">
														<h3 class="title-product"><a href="#">Burberry Pink & black</a></h3>
														<div class="info-price">
															<span>$59.52</span><del>$17.96</del>
														</div>
														<div class="product-rating">
															<div class="inner-rating" style="width:100%"></div>
															<span>(6s)</span>
														</div>
													</div>
													<div class="percent-saleoff">
														<span><label>55%</label> OFF</span>
													</div>
												</div>
											</li>
										</ul>
										<div class="row">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="sort-pagi-bar">
													<div class="product-order">
														<a href="#" class="product-order-toggle">Position</a>
														<ul class="product-order-list">
															<li><a href="#">Name</a></li>
															<li><a href="#">Price</a></li>
														</ul>
													</div>
													<div class="product-per-page">
														<a href="#" class="per-page-toggle">show <span>6</span></a>
														<ul class="per-page-list">
															<li><a href="#">6</a></li>
															<li><a href="#">9</a></li>
															<li><a href="#">12</a></li>
															<li><a href="#">18</a></li>
															<li><a href="#">24</a></li>
														</ul>
													</div>
													<div class="product-pagi-nav">
														<a href="#" class="active">1</a>
														<a href="#">2</a>
														<a href="#">3</a>
														<a href="#" class="next">next <i class="fa fa-angle-double-right"></i></a>
													</div>
												</div>
											</div>
										</div>
										<!-- End Sort Pagibar -->
									</div>
									<div role="tabpanel" class="tab-pane fade in active" id="product-list">
										<ul class="product-list">
											<li>
												<div class="item-product">
													<div class="row">
														<div class="col-md-4 col-sm-12 col-xs-12">
															<div class="product-thumb">
																<a class="product-thumb-link" href="detail.html">
																	<img class="first-thumb" alt="" src="images/photos/extras/16.jpg">
																	<img class="second-thumb" alt="" src="images/photos/extras/19.jpg">
																</a>
															</div>
														</div>
														<div class="col-md-8 col-sm-12 col-xs-12">
															<div class="product-info">
																<h3 class="title-product"><a href="#">Burberry Pink & black</a></h3>
																<div class="info-price">
																	<span>$59.52</span><del>$17.96</del>
																</div>
																<div class="product-rating">
																	<div class="inner-rating" style="width:100%"></div>
																	<span>(6s)</span>
																</div>
																<div class="product-code">
																	<label>Item Code: </label> <span>#12980496023</span>
																</div>
																<div class="product-stock">
																	<label>Availability: </label> <span>In stock</span>
																</div>
																<div class="product-info-cart">
																	<a class="addcart-link" href="#"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
																	<div class="product-extra-link">
																		<a class="wishlist-link" href="#"><i class="fa fa-heart-o"></i></a>
																		<a class="compare-link" href="#"><i class="fa fa-toggle-on"></i></a>
																		<a class="quickview-link fancybox.ajax" href="quick-view.html"><i class="fa fa-search"></i></a>
																	</div>
																</div>
															</div>
															<p class="product-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis tincidunt condimentum felis, et tempor neque rhoncus ac. Proin elementum, felis id placerat dapibus, purus ipsum lobortis tellus, ut vehicula nisl metus eget arcu. </p>
														</div>
													</div>
												</div>
											</li>
											<li>
												<div class="item-product">
													<div class="row">
														<div class="col-md-4 col-sm-12 col-xs-12">
															<div class="product-thumb">
																<a class="product-thumb-link" href="detail.html">
																	<img class="first-thumb" alt="" src="images/photos/extras/15.jpg">
																	<img class="second-thumb" alt="" src="images/photos/extras/20.jpg">
																</a>
																<div class="percent-saleoff">
																	<span><label>55%</label> OFF</span>
																</div>
															</div>
														</div>
														<div class="col-md-8 col-sm-12 col-xs-12">
															<div class="product-info">
																<h3 class="title-product"><a href="#">Burberry Pink & black</a></h3>
																<div class="info-price">
																	<span>$59.52</span><del>$17.96</del>
																</div>
																<div class="product-rating">
																	<div class="inner-rating" style="width:100%"></div>
																	<span>(6s)</span>
																</div>
																<div class="product-code">
																	<label>Item Code: </label> <span>#12980496023</span>
																</div>
																<div class="product-stock">
																	<label>Availability: </label> <span>In stock</span>
																</div>
																<div class="product-info-cart">
																	<a class="addcart-link" href="#"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
																	<div class="product-extra-link">
																		<a class="wishlist-link" href="#"><i class="fa fa-heart-o"></i></a>
																		<a class="compare-link" href="#"><i class="fa fa-toggle-on"></i></a>
																		<a class="quickview-link fancybox.ajax" href="quick-view.html"><i class="fa fa-search"></i></a>
																	</div>
																</div>
															</div>
															<p class="product-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis tincidunt condimentum felis, et tempor neque rhoncus ac. Proin elementum, felis id placerat dapibus, purus ipsum lobortis tellus, ut vehicula nisl metus eget arcu. </p>
														</div>
													</div>
												</div>
											</li>
											<li>
												<div class="item-product">
													<div class="row">
														<div class="col-md-4 col-sm-12 col-xs-12">
															<div class="product-thumb">
																<a class="product-thumb-link" href="detail.html">
																	<img class="first-thumb" alt="" src="images/photos/extras/17.jpg">
																	<img class="second-thumb" alt="" src="images/photos/extras/21.jpg">
																</a>
																<div class="percent-saleoff">
																	<span><label>55%</label> OFF</span>
																</div>
															</div>
														</div>
														<div class="col-md-8 col-sm-12 col-xs-12">
															<div class="product-info">
																<h3 class="title-product"><a href="#">Burberry Pink & black</a></h3>
																<div class="info-price">
																	<span>$59.52</span><del>$17.96</del>
																</div>
																<div class="product-rating">
																	<div class="inner-rating" style="width:100%"></div>
																	<span>(6s)</span>
																</div>
																<div class="product-code">
																	<label>Item Code: </label> <span>#12980496023</span>
																</div>
																<div class="product-stock">
																	<label>Availability: </label> <span>In stock</span>
																</div>
																<div class="product-info-cart">
																	<a class="addcart-link" href="#"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
																	<div class="product-extra-link">
																		<a class="wishlist-link" href="#"><i class="fa fa-heart-o"></i></a>
																		<a class="compare-link" href="#"><i class="fa fa-toggle-on"></i></a>
																		<a class="quickview-link fancybox.ajax" href="quick-view.html"><i class="fa fa-search"></i></a>
																	</div>
																</div>
															</div>
															<p class="product-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis tincidunt condimentum felis, et tempor neque rhoncus ac. Proin elementum, felis id placerat dapibus, purus ipsum lobortis tellus, ut vehicula nisl metus eget arcu. </p>
														</div>
													</div>
												</div>
											</li>
											<li>
												<div class="item-product">
													<div class="row">
														<div class="col-md-4 col-sm-12 col-xs-12">
															<div class="product-thumb">
																<a class="product-thumb-link" href="detail.html">
																	<img class="first-thumb" alt="" src="images/photos/extras/18.jpg">
																	<img class="second-thumb" alt="" src="images/photos/extras/22.jpg">
																</a>
																<div class="percent-saleoff">
																	<span><label>55%</label> OFF</span>
																</div>
															</div>
														</div>
														<div class="col-md-8 col-sm-12 col-xs-12">
															<div class="product-info">
																<h3 class="title-product"><a href="#">Burberry Pink & black</a></h3>
																<div class="info-price">
																	<span>$59.52</span><del>$17.96</del>
																</div>
																<div class="product-rating">
																	<div class="inner-rating" style="width:100%"></div>
																	<span>(6s)</span>
																</div>
																<div class="product-code">
																	<label>Item Code: </label> <span>#12980496023</span>
																</div>
																<div class="product-stock">
																	<label>Availability: </label> <span>In stock</span>
																</div>
																<div class="product-info-cart">
																	<a class="addcart-link" href="#"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
																	<div class="product-extra-link">
																		<a class="wishlist-link" href="#"><i class="fa fa-heart-o"></i></a>
																		<a class="compare-link" href="#"><i class="fa fa-toggle-on"></i></a>
																		<a class="quickview-link fancybox.ajax" href="quick-view.html"><i class="fa fa-search"></i></a>
																	</div>
																</div>
															</div>
															<p class="product-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis tincidunt condimentum felis, et tempor neque rhoncus ac. Proin elementum, felis id placerat dapibus, purus ipsum lobortis tellus, ut vehicula nisl metus eget arcu. </p>
														</div>
													</div>
												</div>
											</li>
										</ul>
										<div class="row">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="sort-pagi-bar">
													<div class="product-order">
														<a href="#" class="product-order-toggle">Position</a>
														<ul class="product-order-list">
															<li><a href="#">Name</a></li>
															<li><a href="#">Price</a></li>
														</ul>
													</div>
													<div class="product-per-page">
														<a href="#" class="per-page-toggle">show <span>6</span></a>
														<ul class="per-page-list">
															<li><a href="#">6</a></li>
															<li><a href="#">9</a></li>
															<li><a href="#">12</a></li>
															<li><a href="#">18</a></li>
															<li><a href="#">24</a></li>
														</ul>
													</div>
													<div class="product-pagi-nav">
														<a href="#" class="active">1</a>
														<a href="#">2</a>
														<a href="#">3</a>
														<a href="#" class="next">next <i class="fa fa-angle-double-right"></i></a>
													</div>
												</div>
											</div>
										</div>
										<!-- End Sort Pagibar -->
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
    @endsection
