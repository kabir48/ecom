<?php
use App\Section;

$sections=Section::sections();
$sectionLadies=Section::sectionLadies();

?>

<?php
use App\CartModal;
?>
<?php
use App\Product;
?>
<?php
use App\Model\Admin\Category;
$mainCategory=Category::mainCategory();
//echo "<pre>";print_r($mainCategory);die;
?>
@php
    $setting=DB::table('sitesetting')->first();
@endphp
<?php
$seo=DB::table('seo')->first();
?>
<!DOCTYPE HTML>
<html lang="en-US">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta name="description" content="Super Shop is new Wordpress theme that we have designed to help you transform your store into a beautiful online showroom. This is a fully responsive Wordpress theme, with multiple versions for homepage and multiple templates for sub pages as well" />
	<meta name="keywords" content="Super Shop,7uptheme" />
	<meta name="robots" content="noodp,index,follow" />
	<meta name='revisit-after' content='1 days' />
	<title>Super Shop | Home style 01</title>
	   <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="{{asset('public/website')}}/css/libs/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('public/website')}}/css/libs/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('public/website')}}/css/libs/font-linearicons.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('public/website')}}/css/libs/bootstrap-theme.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('public/website')}}/css/libs/jquery.fancybox.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('public/website')}}/css/libs/jquery-ui.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('public/website')}}/css/libs/animate.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('public/website')}}/css/libs/owl.carousel.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('public/website')}}/css/libs/owl.transitions.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('public/website')}}/css/libs/owl.theme.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('public/website')}}/css/color.css" media="all"/>
    <link rel="stylesheet" type="text/css" href="{{asset('public/website/css/theme.css')}}" media="all"/>
    <link rel="stylesheet" href="{{asset('public/website/css/toastr.min.css')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/website/css/responsive.css')}}" media="all"/>
    <link rel="stylesheet" type="text/css" href="{{asset('public/website/css/style.css')}}" media="all"/>
    <script type="text/javascript" src="{{asset('public/website')}}/js/libs/jquery-3.1.1.min.js"></script>

    <script type="text/javascript" src="{{asset('public/website/js/toastr.min.js')}}"></script>
</head>
<body>
<div class="wrap">
	<header id="header">
		<div class="header3 header5">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="logo5">
							<a href="index-2.html"><img src="images/home/home1/logo.png" alt="" /></a>
						</div>
					</div>
					<div class="col-md-6 col-sm-5 col-xs-12">
						<div class="smart-search search-form3 search-form5">
							<div class="select-category">
								<a href="#" class="category-toggle-link">All</a>
								<ul class="list-category-toggle sub-menu-top">
									<li><a href="#">Computer &amp; Office</a></li>
									<li><a href="#">Elextronics</a></li>
									<li><a href="#">Jewelry &amp; Watches</a></li>
									<li><a href="#">Home &amp; Garden</a></li>
									<li><a href="#">Bags &amp; Shoes</a></li>
									<li><a href="#">Kids &amp; Baby</a></li>
								</ul>
							</div>
							<form class="smart-search-form">
								<input type="text"  name="search" value="i’m shopping for..." onfocus="if (this.value==this.defaultValue) this.value = ''" onblur="if (this.value=='') this.value = this.defaultValue" />
								<input type="submit" value="" />
							</form>
						</div>
					</div>
					<div class="col-md-3 col-sm-4 col-xs-12">
						<div class="wrap-cart-info3">
							<ul class="top-info top-info3">
								<li class="top-account has-child">
									<a href="#"><i class="fa fa-user"></i></a>
									<ul class="sub-menu-top">
										<li><a href="#"><i class="fa fa-user"></i> Account Info</a></li>
										<li><a href="#"><i class="fa fa-heart-o"></i> Wish List</a></li>
										<li><a href="#"><i class="fa fa-toggle-on"></i> Compare</a></li>
										<li><a href="#"><i class="fa fa-unlock-alt"></i> Sign in</a></li>
										<li><a href="#"><i class="fa fa-sign-in"></i> Checkout</a></li>
									</ul>
								</li>
							</ul>
							<div class="mini-cart mini-cart-3">
								<a class="header-mini-cart3 header-mini-cart5">
									<span class="total-mini-cart-icon"></span>
									<span class="total-mini-cart-item">0</span>
								</a>
								<div class="content-mini-cart">
									<h2>(2) ITEMS IN MY CART</h2>
									<ul class="list-mini-cart-item">
										<li>
											<div class="mini-cart-edit">
												<a class="delete-mini-cart-item" href="#"><i class="fa fa-trash-o"></i></a>
												<a class="edit-mini-cart-item" href="#"><i class="fa fa-pencil"></i></a>
											</div>
											<div class="mini-cart-thumb">
												<a href="#"><img alt="" src="images/home/home1/mini-cart-thumb.png"></a>
											</div>
											<div class="mini-cart-info">
												<h3><a href="#">Burberry Pink &amp; black</a></h3>
												<div class="info-price">
													<span>$59.52</span>
													<del>$17.96</del>
												</div>
												<div class="qty-product">
													<span class="qty-down">-</span>
													<span class="qty-num">1</span>
													<span class="qty-up">+</span>
												</div>
											</div>
										</li>
										<li>
											<div class="mini-cart-edit">
												<a class="delete-mini-cart-item" href="#"><i class="fa fa-trash-o"></i></a>
												<a class="edit-mini-cart-item" href="#"><i class="fa fa-pencil"></i></a>
											</div>
											<div class="mini-cart-thumb">
												<a href="#"><img alt="" src="images/home/home1/mini-cart-thumb.png"></a>
											</div>
											<div class="mini-cart-info">
												<h3><a href="#">Burberry Pink &amp; black</a></h3>
												<div class="info-price">
													<span>$59.52</span>
													<del>$17.96</del>
												</div>
												<div class="qty-product">
													<span class="qty-down">-</span>
													<span class="qty-num">1</span>
													<span class="qty-up">+</span>
												</div>
											</div>
										</li>
									</ul>
									<div class="mini-cart-total">
										<label>TOTAL</label>
										<span>$24.28</span>
									</div>
									<div class="mini-cart-button">
										<a class="mini-cart-view" href="#">view my cart </a>
										<a class="mini-cart-checkout" href="#">Checkout</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Header 3 -->
		<div class="header-nav5 border-bottom">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-12 hidden-xs hidden-sm">
						<div class="category-dropdown hidden-dropdown">
							<h2 class="title-category-dropdown"><span>Categories</span></h2>
							<div class="wrap-category-dropdown">
								<ul class="list-category-dropdown">
										<li class="has-cat-mega">
											<a href="#">Mobiles & Tablets <img src="images/icon/cat1.png" alt="" /></a>
											<div class="cat-mega-menu cat-mega-style1">
												<div class="row">
													<div class="col-md-4 col-sm-3">
														<div class="list-cat-mega-menu">
															<h2 class="title-cat-mega-menu">Women’s</h2>
															<ul>
																<li><a href="#">Dresses</a></li>
																<li><a href="#">Coats & Jackets</a></li>
																<li><a href="#">Blouses & Shirts</a></li>
																<li><a href="#">Tops & Tees</a></li>
																<li><a href="#">Hoodies & Sweatshirts</a></li>
																<li><a href="#">Intimates</a></li>
																<li><a href="#">Swimwear</a></li>
																<li><a href="#">Pants & Capris</a></li>
																<li><a href="#">Sweaters</a></li>
																<li><a href="#">Accessories</a></li>
															</ul>
														</div>
													</div>
													<div class="col-md-4 col-sm-3">
														<div class="list-cat-mega-menu">
															<h2 class="title-cat-mega-menu">Men’s</h2>
															<ul>
																<li><a href="#">Tops & Tees</a></li>
																<li><a href="#">Coats & Jackets</a></li>
																<li><a href="#">Underwear</a></li>
																<li><a href="#">Shirts</a></li>
																<li><a href="#">Hoodies & Sweatshirts</a></li>
																<li><a href="#">Jeans</a></li>
																<li><a href="#">Pants</a></li>
																<li><a href="#">Suits & Blazer</a></li>
																<li><a href="#">Shorts</a></li>
																<li><a href="#">Accessories</a></li>
															</ul>
														</div>
													</div>
													<div class="col-md-4 col-sm-3">
														<div class="zoom-image-thumb">
															<a href="#"><img src="images/home/home1/cat-mega-thumb.png" alt="" /></a>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li  class="has-cat-mega">
											<a href="#">Computers<img src="images/icon/cat2.png" alt="" /></a>
											<div class="cat-mega-menu cat-mega-style2">
												<h2 class="title-cat-mega-menu">Special products</h2>
												<div class="row">
													<div class="col-md-4 col-sm-3">
														<div class="item-category-featured-product first-item">
															<div class="product-thumb">
																<a href="#" class="product-thumb-link">
																	<img class="first-thumb" src="images/photos/extras/3.jpg" alt=""/>
																	<img class="second-thumb" src="images/photos/extras/4.jpg" alt=""/>
																</a>
																<div class="product-info-cart">
																	<div class="product-extra-link">
																		<a href="#" class="wishlist-link"><i class="fa fa-heart-o"></i></a>
																		<a href="#" class="compare-link"><i class="fa fa-toggle-on"></i></a>
																		<a href="#" class="quickview-link"><i class="fa fa-search"></i></a>
																	</div>
																	<a href="#" class="addcart-link"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
																</div>
															</div>
															<div class="product-info">
																<h3 class="title-product"><a href="#">Women Woolen </a></h3>
																<div class="info-price">
																	<span>$59.52 </span>
																	<del>$17.96</del>
																</div>
																<div class="product-rating">
																	<div class="inner-rating"></div>
																	<span>(3s)</span>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-4 col-sm-3">
														<div class="item-category-featured-product">
															<div class="product-thumb">
																<a href="#" class="product-thumb-link">
																	<img class="first-thumb" src="images/photos/extras/21.jpg" alt=""/>
																	<img class="second-thumb" src="images/photos/extras/22.jpg" alt=""/>
																</a>
																<div class="product-info-cart">
																	<div class="product-extra-link">
																		<a href="#" class="wishlist-link"><i class="fa fa-heart-o"></i></a>
																		<a href="#" class="compare-link"><i class="fa fa-toggle-on"></i></a>
																		<a href="#" class="quickview-link"><i class="fa fa-search"></i></a>
																	</div>
																	<a href="#" class="addcart-link"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
																</div>
															</div>
															<div class="product-info">
																<h3 class="title-product"><a href="#">Women Woolen </a></h3>
																<div class="info-price">
																	<span>$59.52 </span>
																	<del>$17.96</del>
																</div>
																<div class="product-rating">
																	<div class="inner-rating"></div>
																	<span>(3s)</span>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-4 col-sm-3">
														<div class="item-category-featured-product">
															<div class="product-thumb">
																<a href="#" class="product-thumb-link">
																	<img class="first-thumb" src="images/photos/extras/11.jpg" alt=""/>
																	<img class="second-thumb" src="images/photos/extras/12.jpg" alt=""/>
																</a>
																<div class="product-info-cart">
																	<div class="product-extra-link">
																		<a href="#" class="wishlist-link"><i class="fa fa-heart-o"></i></a>
																		<a href="#" class="compare-link"><i class="fa fa-toggle-on"></i></a>
																		<a href="#" class="quickview-link"><i class="fa fa-search"></i></a>
																	</div>
																	<a href="#" class="addcart-link"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
																</div>
															</div>
															<div class="product-info">
																<h3 class="title-product"><a href="#">Women Woolen </a></h3>
																<div class="info-price">
																	<span>$59.52 </span>
																	<del>$17.96</del>
																</div>
																<div class="product-rating">
																	<div class="inner-rating"></div>
																	<span>(3s)</span>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li>
											<a href="#">Electronics<img src="images/icon/cat3.png" alt="" /></a>
										</li>
										<li>
											<a href="#">Fashion<img src="images/icon/cat4.png" alt="" /></a>
										</li>
										<li>
											<a href="#">Footwear<img src="images/icon/cat5.png" alt="" /></a>
										</li>
										<li>
											<a href="#">Jewelry & Watches<img src="images/icon/cat6.png" alt="" /></a>
										</li>
										<li>
											<a href="#">Home & Kitchen<img src="images/icon/cat7.png" alt="" /></a>
										</li>
										<li>
											<a href="#">Home Appliances<img src="images/icon/cat8.png" alt="" /></a>
										</li>
										<li>
											<a href="#">Beauty & Perfumes<img src="images/icon/cat9.png" alt="" /></a>
										</li>
										<li>
											<a href="#">Sports & Outdoors<img src="images/icon/cat10.png" alt="" /></a>
										</li>
										<li>
											<a href="#">Computers<img src="images/icon/cat2.png" alt="" /></a>
										</li>
										<li>
											<a href="#">Electronics<img src="images/icon/cat3.png" alt="" /></a>
										</li>
										<li>
											<a href="#">Fashion<img src="images/icon/cat4.png" alt="" /></a>
										</li>
										<li>
											<a href="#">Footwear<img src="images/icon/cat5.png" alt="" /></a>
										</li>
										<li>
											<a href="#">Jewelry & Watches<img src="images/icon/cat6.png" alt="" /></a>
										</li>
									</ul>
								<a class="expand-category-link" href="#"></a>
							</div>
						</div>
					</div>
					<div class="col-md-9 col-sm-12 col-xs-12">
						<nav class="main-nav main-nav5">
							<ul>
								<li class="menu-item-has-children">
									<a href="{{url('/')}}">home</a>
								</li>
								<li class="has-mega-menu">
									<a href="grid.html">Fashion</a>
									<div class="mega-menu mega-menu-style1">
										<div class="row">
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="mega-hot-deal">
													<h2 class="mega-menu-title">Hot deals</h2>
													<div class="mega-hot-deal-slider">
														<div class="wrap-item" data-navigation="true" data-pagination="false" data-itemscustom="[[0,1]]">
															<div class="item-deal-product">
																<div class="product-thumb">
																	<a href="#" class="product-thumb-link">
																		<img src="images/photos/furniture/6.jpg" alt="" class="first-thumb">
																		<img src="images/photos/furniture/5.jpg" alt="" class="second-thumb">
																	</a>
																	<div class="product-info-cart">
																		<div class="product-extra-link">
																			<a href="#" class="wishlist-link"><i class="fa fa-heart-o"></i></a>
																			<a href="#" class="compare-link"><i class="fa fa-toggle-on"></i></a>
																			<a href="#" class="quickview-link"><i class="fa fa-search"></i></a>
																		</div>
																		<a href="#" class="addcart-link"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
																	</div>
																</div>
																<div class="product-info">
																	<h3 class="title-product"><a href="#">Pok Chair Classicle</a></h3>
																	<p class="desc">Lorem Khaled Ipsum is a major key to suc cess. Another one. </p>
																	<div class="info-price-deal">
																		<span>$59.52</span> <label>-30%</label>
																	</div>
																	<div class="deal-shop-social">
																		<a class="deal-shop-link" href="#">shop now</a>
																		<div class="social-deal social-network">
																			<ul>
																				<li><a href="#"><img src="images/icon/s1.png" alt=""></a></li>
																				<li><a href="#"><img src="images/icon/s2.png" alt=""></a></li>
																			</ul>
																		</div>
																	</div>
																</div>
															</div>
															<!-- End Item -->
															<div class="item-deal-product">
																<div class="product-thumb">
																	<a href="#" class="product-thumb-link">
																		<img src="images/photos/extras/17.jpg" alt="" class="first-thumb">
																		<img src="images/photos/extras/16.jpg" alt="" class="second-thumb">
																	</a>
																	<div class="product-info-cart">
																		<div class="product-extra-link">
																			<a href="#" class="wishlist-link"><i class="fa fa-heart-o"></i></a>
																			<a href="#" class="compare-link"><i class="fa fa-toggle-on"></i></a>
																			<a href="#" class="quickview-link"><i class="fa fa-search"></i></a>
																		</div>
																		<a href="#" class="addcart-link"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
																	</div>
																</div>
																<div class="product-info">
																	<h3 class="title-product"><a href="#">Fashion Mangto</a></h3>
																	<p class="desc">Lorem Khaled Ipsum is a major key to suc cess. Another one. </p>
																	<div class="info-price-deal">
																		<span>$59.52</span> <label>-30%</label>
																	</div>
																	<div class="deal-shop-social">
																		<a class="deal-shop-link" href="#">shop now</a>
																		<div class="social-deal social-network">
																			<ul>
																				<li><a href="#"><img src="images/icon/s1.png" alt=""></a></li>
																				<li><a href="#"><img src="images/icon/s2.png" alt=""></a></li>
																			</ul>
																		</div>
																	</div>
																</div>
															</div>
															<!-- End Item -->
															<div class="item-deal-product">
																<div class="product-thumb">
																	<a href="#" class="product-thumb-link">
																		<img src="images/photos/sport/7.jpg" alt="" class="first-thumb">
																		<img src="images/photos/sport/6.jpg" alt="" class="second-thumb">
																	</a>
																	<div class="product-info-cart">
																		<div class="product-extra-link">
																			<a href="#" class="wishlist-link"><i class="fa fa-heart-o"></i></a>
																			<a href="#" class="compare-link"><i class="fa fa-toggle-on"></i></a>
																			<a href="#" class="quickview-link"><i class="fa fa-search"></i></a>
																		</div>
																		<a href="#" class="addcart-link"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
																	</div>
																</div>
																<div class="product-info">
																	<h3 class="title-product"><a href="#">T-Shirt Sport</a></h3>
																	<p class="desc">Lorem Khaled Ipsum is a major key to suc cess. Another one. </p>
																	<div class="info-price-deal">
																		<span>$59.52</span> <label>-30%</label>
																	</div>
																	<div class="deal-shop-social">
																		<a class="deal-shop-link" href="#">shop now</a>
																		<div class="social-deal social-network">
																			<ul>
																				<li><a href="#"><img src="images/icon/s1.png" alt=""></a></li>
																				<li><a href="#"><img src="images/icon/s2.png" alt=""></a></li>
																			</ul>
																		</div>
																	</div>
																</div>
															</div>
															<!-- End Item -->
															<div class="item-deal-product">
																<div class="product-thumb">
																	<a href="#" class="product-thumb-link">
																		<img src="images/photos/extras/14.jpg" alt="" class="first-thumb">
																		<img src="images/photos/extras/13.jpg" alt="" class="second-thumb">
																	</a>
																	<div class="product-info-cart">
																		<div class="product-extra-link">
																			<a href="#" class="wishlist-link"><i class="fa fa-heart-o"></i></a>
																			<a href="#" class="compare-link"><i class="fa fa-toggle-on"></i></a>
																			<a href="#" class="quickview-link"><i class="fa fa-search"></i></a>
																		</div>
																		<a href="#" class="addcart-link"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
																	</div>
																</div>
																<div class="product-info">
																	<h3 class="title-product"><a href="#">Bag Goodscol model</a></h3>
																	<p class="desc">Lorem Khaled Ipsum is a major key to suc cess. Another one. </p>
																	<div class="info-price-deal">
																		<span>$59.52</span> <label>-30%</label>
																	</div>
																	<div class="deal-shop-social">
																		<a class="deal-shop-link" href="#">shop now</a>
																		<div class="social-deal social-network">
																			<ul>
																				<li><a href="#"><img src="images/icon/s1.png" alt=""></a></li>
																				<li><a href="#"><img src="images/icon/s2.png" alt=""></a></li>
																			</ul>
																		</div>
																	</div>
																</div>
															</div>
															<!-- End Item -->
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="mega-new-arrival">
													<h2 class="mega-menu-title">New Arrivals</h2>
													<div class="mega-new-arrival-slider">
														<div class="wrap-item" data-navigation="true" data-pagination="false" data-itemscustom="[[0,1],[480,2]]">
															<div class="item">
																<div class="item-product">
																	<div class="product-thumb">
																		<a href="detail.html" class="product-thumb-link">
																			<img src="images/photos/extras/18.jpg" alt="" class="first-thumb">
																			<img src="images/photos/extras/17.jpg" alt="" class="second-thumb">
																		</a>
																		<div class="product-info-cart">
																			<div class="product-extra-link">
																				<a href="#" class="wishlist-link"><i class="fa fa-heart-o"></i></a>
																				<a href="#" class="compare-link"><i class="fa fa-toggle-on"></i></a>
																				<a href="quick-view.html" class="quickview-link fancybox.ajax"><i class="fa fa-search"></i></a>
																			</div>
																			<a href="#" class="addcart-link"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
																		</div>
																	</div>
																	<div class="product-info">
																		<h3 class="title-product"><a href="#">Burberry Pink &amp; black</a></h3>
																		<div class="info-price">
																			<span>$59.52</span><del>$17.96</del>
																		</div>
																		<div class="product-rating">
																			<div style="width:100%" class="inner-rating"></div>
																			<span>(6s)</span>
																		</div>
																	</div>
																</div>
															</div>
															<!-- End Item -->
															<div class="item">
																<div class="item-product">
																	<div class="product-thumb">
																		<a href="detail.html" class="product-thumb-link">
																			<img src="images/photos/extras/21.jpg" alt="" class="first-thumb">
																			<img src="images/photos/extras/20.jpg" alt="" class="second-thumb">
																		</a>
																		<div class="product-info-cart">
																			<div class="product-extra-link">
																				<a href="#" class="wishlist-link"><i class="fa fa-heart-o"></i></a>
																				<a href="#" class="compare-link"><i class="fa fa-toggle-on"></i></a>
																				<a href="quick-view.html" class="quickview-link fancybox.ajax"><i class="fa fa-search"></i></a>
																			</div>
																			<a href="#" class="addcart-link"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
																		</div>
																	</div>
																	<div class="product-info">
																		<h3 class="title-product"><a href="#">Burberry Pink &amp; black</a></h3>
																		<div class="info-price">
																			<span>$59.52</span><del>$17.96</del>
																		</div>
																		<div class="product-rating">
																			<div style="width:100%" class="inner-rating"></div>
																			<span>(6s)</span>
																		</div>
																	</div>
																</div>
															</div>
															<!-- End Item -->
															<div class="item">
																<div class="item-product">
																	<div class="product-thumb">
																		<a href="detail.html" class="product-thumb-link">
																			<img src="images/photos/extras/19.jpg" alt="" class="first-thumb">
																			<img src="images/photos/extras/15.jpg" alt="" class="second-thumb">
																		</a>
																		<div class="product-info-cart">
																			<div class="product-extra-link">
																				<a href="#" class="wishlist-link"><i class="fa fa-heart-o"></i></a>
																				<a href="#" class="compare-link"><i class="fa fa-toggle-on"></i></a>
																				<a href="quick-view.html" class="quickview-link fancybox.ajax"><i class="fa fa-search"></i></a>
																			</div>
																			<a href="#" class="addcart-link"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
																		</div>
																	</div>
																	<div class="product-info">
																		<h3 class="title-product"><a href="#">Burberry Pink &amp; black</a></h3>
																		<div class="info-price">
																			<span>$59.52</span><del>$17.96</del>
																		</div>
																		<div class="product-rating">
																			<div style="width:100%" class="inner-rating"></div>
																			<span>(6s)</span>
																		</div>
																	</div>
																</div>
															</div>
															<!-- End Item -->
															<div class="item">
																<div class="item-product">
																	<div class="product-thumb">
																		<a href="detail.html" class="product-thumb-link">
																			<img src="images/photos/extras/3.jpg" alt="" class="first-thumb">
																			<img src="images/photos/extras/4.jpg" alt="" class="second-thumb">
																		</a>
																		<div class="product-info-cart">
																			<div class="product-extra-link">
																				<a href="#" class="wishlist-link"><i class="fa fa-heart-o"></i></a>
																				<a href="#" class="compare-link"><i class="fa fa-toggle-on"></i></a>
																				<a href="quick-view.html" class="quickview-link fancybox.ajax"><i class="fa fa-search"></i></a>
																			</div>
																			<a href="#" class="addcart-link"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
																		</div>
																	</div>
																	<div class="product-info">
																		<h3 class="title-product"><a href="#">Burberry Pink &amp; black</a></h3>
																		<div class="info-price">
																			<span>$59.52</span><del>$17.96</del>
																		</div>
																		<div class="product-rating">
																			<div style="width:100%" class="inner-rating"></div>
																			<span>(6s)</span>
																		</div>
																	</div>
																</div>
															</div>
															<!-- End Item -->
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</li>
								<li class="has-mega-menu">
									<a href="list.html">Furniture</a>
									<div class="mega-menu">
										<div class="row">
											<div class="col-md-5 col-sm-5 col-xs-12">
												<div class="mega-adv">
													<div class="mega-adv-thumb zoom-image-thumb">
														<a href="#"><img src="images/photos/newintoday/bag-shoes.jpg" alt="" /></a>
													</div>
													<div class="mega-adv-info">
														<h3><a href="#">Examplui coloniu tencaug</a></h3>
														<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
														<a class="more-detail" href="#">More Detail</a>
													</div>
												</div>
											</div>
											<div class="col-md-7 col-sm-7 col-xs-12">
												<div class="mega-new-arrival">
													<h2 class="mega-menu-title">Featured Product</h2>
													<div class="mega-new-arrival-slider">
														<div class="wrap-item" data-navigation="true" data-pagination="false" data-itemscustom="[[0,1],[480,2]]">
															<div class="item">
																<div class="item-product">
																	<div class="product-thumb">
																		<a href="detail.html" class="product-thumb-link">
																			<img src="images/photos/extras/17.jpg" alt="" class="first-thumb">
																			<img src="images/photos/extras/18.jpg" alt="" class="second-thumb">
																		</a>
																		<div class="product-info-cart">
																			<div class="product-extra-link">
																				<a href="#" class="wishlist-link"><i class="fa fa-heart-o"></i></a>
																				<a href="#" class="compare-link"><i class="fa fa-toggle-on"></i></a>
																				<a href="quick-view.html" class="quickview-link fancybox.ajax"><i class="fa fa-search"></i></a>
																			</div>
																			<a href="#" class="addcart-link"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
																		</div>
																	</div>
																	<div class="product-info">
																		<h3 class="title-product"><a href="#">Burberry Pink &amp; black</a></h3>
																		<div class="info-price">
																			<span>$59.52</span><del>$17.96</del>
																		</div>
																		<div class="product-rating">
																			<div style="width:100%" class="inner-rating"></div>
																			<span>(6s)</span>
																		</div>
																	</div>
																</div>
															</div>
															<!-- End Item -->
															<div class="item">
																<div class="item-product">
																	<div class="product-thumb">
																		<a href="detail.html" class="product-thumb-link">
																			<img src="images/photos/extras/20.jpg" alt="" class="first-thumb">
																			<img src="images/photos/extras/21.jpg" alt="" class="second-thumb">
																		</a>
																		<div class="product-info-cart">
																			<div class="product-extra-link">
																				<a href="#" class="wishlist-link"><i class="fa fa-heart-o"></i></a>
																				<a href="#" class="compare-link"><i class="fa fa-toggle-on"></i></a>
																				<a href="quick-view.html" class="quickview-link fancybox.ajax"><i class="fa fa-search"></i></a>
																			</div>
																			<a href="#" class="addcart-link"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
																		</div>
																	</div>
																	<div class="product-info">
																		<h3 class="title-product"><a href="#">Burberry Pink &amp; black</a></h3>
																		<div class="info-price">
																			<span>$59.52</span><del>$17.96</del>
																		</div>
																		<div class="product-rating">
																			<div style="width:100%" class="inner-rating"></div>
																			<span>(6s)</span>
																		</div>
																	</div>
																</div>
															</div>
															<!-- End Item -->
															<div class="item">
																<div class="item-product">
																	<div class="product-thumb">
																		<a href="detail.html" class="product-thumb-link">
																			<img src="images/photos/extras/15.jpg" alt="" class="first-thumb">
																			<img src="images/photos/extras/19.jpg" alt="" class="second-thumb">
																		</a>
																		<div class="product-info-cart">
																			<div class="product-extra-link">
																				<a href="#" class="wishlist-link"><i class="fa fa-heart-o"></i></a>
																				<a href="#" class="compare-link"><i class="fa fa-toggle-on"></i></a>
																				<a href="quick-view.html" class="quickview-link fancybox.ajax"><i class="fa fa-search"></i></a>
																			</div>
																			<a href="#" class="addcart-link"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
																		</div>
																	</div>
																	<div class="product-info">
																		<h3 class="title-product"><a href="#">Burberry Pink &amp; black</a></h3>
																		<div class="info-price">
																			<span>$59.52</span><del>$17.96</del>
																		</div>
																		<div class="product-rating">
																			<div style="width:100%" class="inner-rating"></div>
																			<span>(6s)</span>
																		</div>
																	</div>
																</div>
															</div>
															<!-- End Item -->
															<div class="item">
																<div class="item-product">
																	<div class="product-thumb">
																		<a href="detail.html" class="product-thumb-link">
																			<img src="images/photos/extras/4.jpg" alt="" class="first-thumb">
																			<img src="images/photos/extras/3.jpg" alt="" class="second-thumb">
																		</a>
																		<div class="product-info-cart">
																			<div class="product-extra-link">
																				<a href="#" class="wishlist-link"><i class="fa fa-heart-o"></i></a>
																				<a href="#" class="compare-link"><i class="fa fa-toggle-on"></i></a>
																				<a href="quick-view.html" class="quickview-link fancybox.ajax"><i class="fa fa-search"></i></a>
																			</div>
																			<a href="#" class="addcart-link"><i class="fa fa-shopping-basket"></i> Add to Cart</a>
																		</div>
																	</div>
																	<div class="product-info">
																		<h3 class="title-product"><a href="#">Burberry Pink &amp; black</a></h3>
																		<div class="info-price">
																			<span>$59.52</span><del>$17.96</del>
																		</div>
																		<div class="product-rating">
																			<div style="width:100%" class="inner-rating"></div>
																			<span>(6s)</span>
																		</div>
																	</div>
																</div>
															</div>
															<!-- End Item -->
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</li>
								<li class="menu-item-has-children">
									<a href="grid.html">Food</a>
									<ul class="sub-menu">
										<li><a href="#">Pizza</a></li>
										<li><a href="#">Noodle</a></li>
										<li class="menu-item-has-children">
											<a href="#">Cake</a>
											<ul class="sub-menu">
												<li><a href="#">lemon cake</a></li>
												<li><a href="#">mousse cake</a></li>
												<li><a href="#">carrot cake</a></li>
												<li><a href="#">chocolate cake</a></li>
											</ul>
										</li>
										<li><a href="#">Drink</a></li>
									</ul>
								</li>
								<li class="menu-item-has-children">
									<a href="grid.html">Electronis</a>
									<ul class="sub-menu">
										<li><a href="#">Mobile</a></li>
										<li><a href="#">Laptop</a></li>
										<li><a href="#">Camera</a></li>
										<li><a href="#">Accessories</a></li>
									</ul>
								</li>
								<li><a href="list.html">Sports</a></li>
								<li class="menu-item-has-children">
									<a href="#">Pages</a>
									<ul class="sub-menu">
										<li><a href="accordions.html">Accordions</a></li>
										<li><a href="buttons.html">Buttons</a></li>
										<li><a href="chart-processbar.html">Charts & Progress Bars</a></li>
										<li><a href="feature-boxes.html">Feature Boxes</a></li>
										<li><a href="message-boxes.html">Message Boxes</a></li>
										<li><a href="teams.html">Teams</a></li>
										<li><a href="testimonial.html">Testimonials</a></li>
									</ul>
								</li>
								<li class="menu-item-has-children">
									<a href="blog-v1.html">Blog</a>
									<ul class="sub-menu">
										<li><a href="blog-v1.html">Blog V1</a></li>
										<li><a href="blog-v2.html">Blog V2</a></li>
										<li><a href="blog-v3.html">Blog V3</a></li>
										<li><a href="blog-full.html">Blog Fullwidth</a></li>
										<li><a href="single.html">Single Post</a></li>
									</ul>
								</li>
							</ul>
							<a href="#" class="toggle-mobile-menu"><span>Menu</span></a>
						</nav>
						<!-- End Main Nav -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Main Nav -->
	</header>
	<!-- End Header -->
@yield('content')
	<!-- End Content -->
	<footer id="footer">
		<div class="newsletter6 bg-color2">
			<div class="container">
				<div class="newsletter-form text-center">
					<label>newsletter</label>
					<form>
						<input type="text" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" value="Enter Your Email...">
						<input type="submit" value="SUBSCRIBE">
					</form>
				</div>
			</div>
		</div>
		<div class="footer6">
			<div class="container">
				<div class="list-footer-box6">
					<div class="row">
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="footer-box6 first-item">
								<h2>INFORMATION</h2>
								<ul class="footer-menu-box">
									<li><a href="#">About Us</a></li>
									<li><a href="#">Customer Service</a></li>
									<li><a href="#">Template Settings</a></li>
									<li><a href="#">Privacy Policy</a></li>
									<li><a href="#">Search Terms</a></li>
									<li><a href="#">Advanced Search</a></li>
									<li><a href="#">Contact Us</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="footer-box6">
								<h2>WHY BUY FROM US</h2>
								<ul class="footer-menu-box">
									<li><a href="#">Shipping & Returns</a></li>
									<li><a href="#">Secure Shopping</a></li>
									<li><a href="#">International Shipping</a></li>
									<li><a href="#">Affiliates</a></li>
									<li><a href="#">Group Sales</a></li>
									<li><a href="#">Orders and Returns</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="footer-box6">
								<h2>MY ACCOUNT</h2>
								<ul class="footer-menu-box">
									<li><a href="#">Sign In</a></li>
									<li><a href="#">View Cart</a></li>
									<li><a href="#">My Wishlist</a></li>
									<li><a href="#">My Compare</a></li>
									<li><a href="#">Track My Order</a></li>
									<li><a href="#">Help</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="footer-box6 footer-contact6">
								<h2>Contact Us</h2>
								<ul class="footer-box-contact">
									<li><i class="fa fa-home"></i> Our business address is 1063 Free</li>
									<li><i class="fa fa-mobile"></i> + 020.566.8866</li>
									<li><i class="fa fa-envelope"></i> <a href="mailto:support@7-Up.com">support@7-Up.com</a></li>
								</ul>
								<div class="social-footer social-network">
									<ul>
										<li><a href="#"><img alt="" src="images/icon/s1.png"></a></li>
										<li><a href="#"><img alt="" src="images/icon/s2.png"></a></li>
										<li><a href="#"><img alt="" src="images/icon/s3.png"></a></li>
										<li><a href="#"><img alt="" src="images/icon/s4.png"></a></li>
										<li><a href="#"><img alt="" src="images/icon/s5.png"></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-bottom6">
			<div class="container">
				<div class="social-copyright3">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<p class="copyrigh4 policy6">&copy;2017 <a href="#">7upthemecom</a></p>
							<div class="policy4 policy6">
								<label>Policies: </label>
								<a href="#">Terms of us</a>
								<a href="#">Security</a>
								<a href="#">Privacy</a>
								<a href="#">Infringement</a>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="payment6 payment-method">
								<label>PAYMENT METHOD</label>
								<a href="#"><img src="images/icon/pay1.png" alt=""></a>
								<a href="#"><img src="images/icon/pay2.png" alt=""></a>
								<a href="#"><img src="images/icon/pay3.png" alt=""></a>
								<a href="#"><img src="images/icon/pay4.png" alt=""></a>
							</div>
						</div>
					</div>
				</div>
				<!-- End Social -->
			</div>
		</div>
	</footer>
	<!-- End Footer -->
</div>
<script type="text/javascript" src="{{asset('public/website/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/website/js/libs/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/website')}}/js/libs/jquery.scrollUp.min.js"></script>
<script type="text/javascript" src="{{asset('public/website')}}/js/libs/jquery.fancybox.js"></script>
<script type="text/javascript" src="{{asset('public/website/js/libs/owl.carousel.js')}}"></script>
<script type="text/javascript" src="{{asset('public/website/js/libs/TimeCircles.js')}}"></script>
<script type="text/javascript" src="{{asset('public/website')}}/js/libs/jquery.jcarousellite.min.js"></script>
<script type="text/javascript" src="{{asset('public/website/js/libs/jquery.elevatezoom.js')}}"></script>
<script type="text/javascript" src="{{asset('public/website/js/theme.js')}}"></script>

<script type="text/javascript" src="{{asset('public/website/js/front_script.js')}}"></script>
<script type="text/javascript" src="{{asset('public/website/js/front_auto.js')}}"></script>
 <script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
 <script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>
</body>

</html>
