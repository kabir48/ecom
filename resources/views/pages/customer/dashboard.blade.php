@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
 <link rel="stylesheet" href="{{asset('public/frontend/assets/css/user.css')}}" />
 <link href="{{asset('public/frontend/assets/css/single.css')}}" rel="stylesheet" type="text/css" />
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <?php
use App\Product;
?>
<?php
use App\AttributeProduct;
?>

<style>
a{
    text-decoration:none;
}
    .weight_list li{
           float: left;
    padding: 2px 14px;
    position: relative;
    left: -35px;
    } 
    
    .color_list li{
           float: left;
    padding: 2px 14px;
    position: relative;
    left: -35px;
    }
    .color_radio{
           
    width: 12px;
    border-radius: 50%;
    height: 10px;
    /* display: flex; */
    display: inline-block;
    margin: 0px 4px;
    height: 12px;
    }
    .product-form__item{
       display:flex; 
       justify-content:center;
    }
    .swatchInput{
        height:16px !important;
    }
</style>

    <!-- User Dashboard Section Start -->
    <section class="user-dashboard-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-3 col-lg-4">
                    <div class="dashboard-left-sidebar">
                        <div class="close-button d-flex d-lg-none">
                            <button class="close-sidebar">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="profile-box">
                            <div class="cover-image">
                                <img src="{{asset('public/frontend/assets/img/cover-img.jpg')}}" class="img-fluid blur-up lazyload"
                                    alt="">
                            </div>

                            <div class="profile-contain">
                                <div class="profile-image">
                                    <div class="position-relative">
                                        @if(Auth::user()->image)
                                        <img src="{{asset('public/media/user/'.Auth::user()->image)}}" class="blur-up lazyload update_img"
                                        alt="">
                                        @else
                                        <img src="{{asset('public/avatar.jpg')}}" class="blur-up lazyload update_img"
                                        alt="">
                                        @endif
                                    </div>
                                </div>

                                <div class="profile-name">
                                    <h3>{{Auth::user()->name}}</h3>
                                    <h6 class="text-content">{{Auth::user()->email}}</h6>
                                </div>
                            </div>
                        </div>

                        <ul class="nav nav-pills user-nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-dashboard-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-dashboard" type="button" role="tab"
                                    aria-controls="pills-dashboard" aria-selected="true"><i data-feather="home"></i>
                                    DashBoard</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-order-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-order" type="button" role="tab" aria-controls="pills-order"
                                    aria-selected="false"><i data-feather="shopping-bag"></i>Order</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-wishlist-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-wishlist" type="button" role="tab"
                                    aria-controls="pills-wishlist" aria-selected="false"><i data-feather="heart"></i>
                                    Wishlist</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-address-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-address" type="button" role="tab"
                                    aria-controls="pills-address" aria-selected="false"><i data-feather="map-pin"></i>
                                    Address</button>
                            </li>

                           

                            <li class="nav-item" role="presentation">
                                <a href="{{url('user/logout')}}" class="nav-link" id="pills-security-tab" ><i data-feather="shield"></i>
                                    Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <?php
                   $announcement=DB::table('announcements')->where('trigger','customer_page')->first();
                ?>

                <div class="col-xxl-9 col-lg-8">
                    <button class="btn left-dashboard-show btn-md fw-bold d-block mb-4 d-lg-none" id="showButton">Show
                        Menu
                    </button>
                    <div class="dashboard-right-sidebar">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel"
                                aria-labelledby="pills-dashboard-tab">
                                <div class="dashboard-home">
                                    <div class="title">
                                        <h2>My Dashboard</h2>
                                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="dashboard-user-name">
                                        <h6 class="text-content">Hello, <b class="text-title">{{Auth::user()->name}}</b></h6>
                                        <p class="text-content">{{$announcement->note??"From your My Account Dashboard you have the ability to
                                            view a snapshot of your recent account activity and update your account
                                            information. Select a link below to view or edit information."}}</p>
                                    </div>

                                    <div class="total-box">
                                        <div class="row g-sm-4 g-3">
                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="totle-contain">
                                                    <img src="{{asset('public/frontend/assets/img/order.svg')}}"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="{{asset('public/frontend/assets/img/order.svg')}}" class="blur-up lazyload"
                                                        alt="">
                                                    <div class="totle-detail">
                                                        <h5>Total Order</h5>
                                                        <h3>{{round($totalOrder,2)}}</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="totle-contain">
                                                    <img src="{{asset('public/frontend/assets/img/pending.svg')}}"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="{{asset('public/frontend/assets/img/pending.svg')}}" class="blur-up lazyload"
                                                        alt="">
                                                    <div class="totle-detail">
                                                        <h5>Total Active Orders</h5>
                                                        <h3>{{$activeOrders}}</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="totle-contain">
                                                    <img src="{{asset('public/frontend/assets/img/wishlist.svg')}}"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="{{asset('public/frontend/assets/img/wishlist.svg')}}"
                                                        class="blur-up lazyload" alt="">
                                                    <div class="totle-detail">
                                                        <h5>Total Return Order</h5>
                                                        <h3>{{$cancledOrders}}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="dashboard-title">
                                        <h3>Account Information</h3>
                                    </div>

                                    <div class="row g-4">
                                        <div class="col-xxl-6">
                                            <div class="dashboard-contant-title">
                                                <h4>Password Change <a href="javascript:void(0)"
                                                        data-bs-toggle="modal" data-bs-target="#editPassword">Change Password</a>
                                                </h4>
                                            </div>
                                            <div class="dashboard-detail">
                                                <h6 class="text-content">{{Auth::user()->name}}</h6>
                                                <h6 class="text-content">{{Auth::user()->email}}</h6>
                                            </div>
                                        </div>

                                        <div class="col-xxl-6">
                                            <div class="dashboard-contant-title">
                                                <h4> Your Profile <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#editProfile">Edit</a></h4>
                                            </div>
                                            <div class="dashboard-detail">
                                                <h6 class="text-content">{{Auth::user()->name}}</h6>
                                                <h6 class="text-content">{{Auth::user()->email}}</h6>
                                                <h6 class="text-content">{{Auth::user()->phone}}</h6>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>

                            <!--======wish list strt from here=======-->
                            <div class="tab-pane fade show" id="pills-wishlist" role="tabpanel"
                                aria-labelledby="pills-wishlist-tab">
                                <div class="dashboard-wishlist">
                                    <div class="title">
                                        <h2>My Wishlist History</h2>
                                        <span class="title-leaf title-leaf-gray">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="row g-sm-4 g-3">
                                        @foreach($wishlists as $key=>$row)
                                           <?php
                                               $discounted_price=Product::getProductdiscount($row['products']['id']);
                                               $total_stock=AttributeProduct::where('product_id',$row['products']['id'])->sum('stock');
                                               $getProductStock=Product::where('id',$row['products']['id'])->sum('product_quantity');
                                               $getProduct=Product::with(['category'])->where('id',$row['products']['id'])->first()->toArray();
                                               $color=$getProduct['product_color'];
                                               $product_color = explode(',', $color);
                                               $productDetails =AttributeProduct::select('weight_size')->where('product_id',$row['products']['id'])->where('status',1)->get();
                                               //dd($getProductStock);
                                            ?>
                                          @if($getProductStock > 0)
                                        <div class="col-xxl-3 col-lg-6 col-md-4 col-sm-6">
                                            <div class="product-box-3 theme-bg-white h-100 wish_content">
                                                <div class="product-header">
                                                    <div class="product-image">
                                                        <a href="product-left-thumbnail.html">
                                                            <img src="{{asset( $row['products']['image_one'])}}"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                        </a>

                                                        <div class="product-header-top">
                                                            <input type="hidden" value="{{$row['id']}}" class="wish_id">
                                                            <button class="btn wishlist-button close_button">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-footer product_data">
                                                    <div class="product-detail">
                                                        <span class="span-name">{{$getProduct['category']['category_name']}}</span>
                                                        <a href="{{url('product/details/'.$row['products']['id'].'/'.$row['products']['product_name'])}}">
                                                            <h5 class="name">{{$row['products']['product_name']}}</h5>
                                                        </a>
                                                         
                                                        <h5 class="price">
                                                            @if($discounted_price>0)
                                                            <span class="theme-color">{{$discounted_price}}</span>
                                                            <del style="color:red">{{$row['products']['selling_price']}}</del>
                                                            @else
                                                            <span class="theme-color">{{$row['products']['selling_price']}}</span>
                                                            @endif
                                                        </h5>
                                                        <div class="weight_color">
                                                            <ul class="weight_list" style="list-style-type: none;">
                                                                @foreach ($productDetails as $item)
                                                                <li>
                                                                    <input type="radio" name="size" class="weight_size" value="{{$item['weight_size']}}"> {{$item['weight_size']}}
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                            <br>
                                                        </div>
                                                        
                                                          <div class="add-to-cart-box mt-2">
                                                            @if($total_stock>0)
                                                            <div class="cart_qty qty-box open">
                                                                <div class="input-group">
                                                                    <button type="button" class="qty-left-minus bg-gray" data-type="minus" data-field="">
                                                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                                                    </button>
                                                                    <input class="form-control input-number qty-input" type="text"  value="1" style="border: 1px solid #ffffff !important" disabled>
                                                                    <button type="button" class="qty-right-plus bg-gray" data-type="plus" data-field="">
                                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                                    </button>
                                                                </div>
                                                            </div> 
                                                            @endif
                                                             <input type="hidden" value="{{$row['products']['id']}}" class="product_id">
                                                            <button class="btn-add-cart addcart-button addToCart"
                                                                >Add To Cart
                                                                <span class="add-icon">
                                                                    <i class="fas fa-plus"></i>
                                                                </span>
                                                            </button>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                          @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                                <!--=========order Table======-->
                            <div class="tab-pane fade show" id="pills-order" role="tabpanel"
                                aria-labelledby="pills-order-tab">
                                <div class="dashboard-order">
                                    <div class="title">
                                        <h2>My Orders History</h2>
                                        <span class="title-leaf title-leaf-gray">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                                            </svg>
                                        </span>
                                    </div>

                                   <div class="table-responsive dashboard-bg-box">
                                        <table class="table product-table">
                                            <thead>
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Product</th>
                                                    <th>Payment</th>
                                                    <th>Total</th>
                                                    <th>Tracking Code</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Manage Product</th>
                                                    <th>Invoice</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orders as $row)
                                                <tr>
                                                    <td>{{$row['order_no']}}</td>
                                                    <td>
                                                        @foreach($row['products'] as $pro)
                                                        {{$pro['product_name']}},<br>
                                                        @endforeach
                                                    </td>
                                                    <td>{{$row['payment_gateway']}}</td>
                                                    <td>TK.{{$row['total']}}</td>
                                                    <td>{{$row['status_code']}}</td>
                                                    @if($row['status'] == 1 || $row['status'] == 2)
                                                    <td>{{date('d-m-Y',strtotime($row['Expected_date']))}}</td>
                                                    @else
                                                    <td>{{date('d-m-Y',strtotime($row['date']))}}</td>
                                                    @endif
                                                    <td>
                                                        @if($row['status'] == 0)
                                                        <span class="btn btn-warning">Pending</span>
                                                        @elseif($row['status'] == 1)
                                                        <span class="btn btn-primary">Processing</span>
                                                        @elseif($row['status'] == 2)
                                                        <span class="btn btn-info"> Shipped </span>
                                                        @elseif($row['status'] == 3|| $row['status'] == 4)
                                                        <span class="btn btn-success">Delivered </span>
                                                        @else
                                                        <span class="btn btn-danger">Cancel </span>
                                                        @endif
                                                    </td>
                                                    <td><a target="_blank" style="color:#0da487" href="{{url('/customer/orders-show/'.$row['id'])}}"><i class="fa fa-eye"></i></a></td>
                                                    <td><a target="_blank" style="color:orange" href="{{url('/customer/orders-invoice/'.$row['id'])}}"><i class="fas fa-file-invoice"></i></a></td>
                                                    
                                                </tr>
                                                    @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                                    <!--=========Shipping Address=========-->
                            <div class="tab-pane fade show" id="pills-address" role="tabpanel"
                                aria-labelledby="pills-address-tab">
                                <div class="dashboard-address">
                                    <div class="title title-flex">
                                        <div>
                                            <h2>My Address Book</h2>
                                            <span class="title-leaf">
                                                <svg class="icon-width bg-gray">
                                                    <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row g-sm-4 g-3">
                                        @foreach($shippings as $key=>$row)
                                        <div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6">
                                            <div class="address-box">
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="jack"
                                                            id="flexRadioDefault2" checked>
                                                    </div>

                                                    <div class="label">
                                                        <label>Billing Address {{$key+1}}</label>
                                                    </div>

                                                    <div class="table-responsive address-table">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <td>Name :</td>
                                                                    <td>{{$row->name}}</td>
                                                                </tr>
                                                                
                                                                <tr>
                                                                     <td>Phone :</td>
                                                                    <td>{{$row->phone}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Address :</td>
                                                                    <td>
                                                                        <p>{{$row->address}}
                                                                        </p>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Area :</td>
                                                                    <td>{{$row->area}}</td>
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <td>Country Name :</td>
                                                                    <td>{{$row->country}}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="button-group">
                                                    <button class="btn theme-bg-color text-white btn-sm fw-bold mt-lg-0 mt-3"
                                            data-bs-toggle="modal" onclick="eligibleView({{ $row->id }})" id="{{ $row->id }}" data-bs-target="#add-address"><i data-feather="plus"
                                                class="me-2"></i> Edit Address</button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Add address modal box start -->
                                       
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="row" style="margin-top:60px">
                 <h2 class="sec_titel">For You</h2>
                        <?php
                           
                           $uniqueProductIds = App\OrderDetail::distinct()->where('user_id',Auth::user()->id)->pluck('product_id');
                           //dd($uniqueProductIds);
                           $getOrderDetails=App\Product::with(['category','section'])->whereIn('id',$uniqueProductIds)->latest()->take(8)->get()->toArray();
                           
                           $clientIP = \Request::ip();
                           $getIp=geoip()->getLocation($clientIP=null);
                            $query = App\Product::with(['category', 'section'])->latest();
                            
                            if (!empty($uniqueProductIds)) {
                                $query->whereIn('id', $uniqueProductIds);
                            }
                            
                            $getOrderDetails = $query->take(8)->get()->toArray();
                        ?>
                            @if(count($getOrderDetails)>0)
                            <div class="container-fluid">
                              <div class="row">
                    			<!--Main Content-->
                    			<div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                                    <!--Product Grid-->
                                    <div class="grid-products grid--view-items">
                                        <div class="row">
                                            @foreach($getOrderDetails as $key=>$data)
                                            <div class="col-12 col-sm-12 col-md-4 col-lg-2 item quick_product_data">
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
                                                <!-- start product image -->
                                                <div class="product-image">
                                                    <!-- start product image -->
                                                    <a href="{{url('product/details/'.$data['id'].'/'.$name)}}" class="product-img">
                                                        <!-- image -->
                                                        <img style="height:300px" class="primary blur-up lazyload" data-src="{{asset($data['image_one'])}}" src="{{asset($data['image_one'])}}" alt="{{$data['product_name']}}" title="{{$data['product_name']}}">
                                                        <!-- End image -->
                                                        <!-- Hover image -->
                                                        <img style="height:300px" class="hover blur-up lazyload" data-src="{{asset($data['image_two'])}}" src="{{asset($data['image_two'])}}" alt="{{$data['product_name']}}" title="{{$data['product_name']}}">
                                                        <!-- End hover image -->
                                                        @if($data['discount_price'])
                                                        <div class="product-labels"><span class="lbl on-sale">New</span></div>
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
                                                    
                                                    
                                                    <!-- Product Sizes -->
                                                    <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                                                        <div class="product-form__item">
                                                           <!-- Your Blade template code -->
                                                        @foreach($productSizes as $key => $size)
                                                            <div data-value="{{$size['weight_size']}}" class="swatch-element xs available">
                                                                <input class="swatchInput" id="swatch-{{$key}}" type="radio" name="w_size" value="{{$size['weight_size']}}">
                                                                <label class="swatchLbl" name="title" for="swatch-{{$size['weight_size']}}" title="{{$size['weight_size']}}">
                                                                    {{$size['weight_size']}}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                        </div>
                                                    </div>
                                                    <!-- End Product Sizes -->
                                                </div>
                                                <!-- End product details -->
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!--End Product Grid-->
                                   
                    			</div>
                    			<!--End Main Content-->
                    		</div>
                            </div>
                            @endif
                </div>
                    
                    
                   
            </div>
    </section>
    <!-- User Dashboard Section End -->
    
    
        
        
        <!--address update modal-->
         <div class="modal fade theme-modal" id="add-address" tabindex="-1" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down" id="modal-eligible">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Billing  Address</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        
                        <div class="modal-body" id="eligibleView-modal-body">
                           
                        </div>
                    </div>
                </div>
            </div>
            
            
            
             <!--address update modal-->
         <div class="modal fade theme-modal" id="add-address" tabindex="-1" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down" id="modal-eligible">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Billing  Address</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        
                        <div class="modal-body" id="eligibleView-modal-body">
                           
                        </div>
                    </div>
                </div>
            </div>
    
     
    <!-- Add address modal box end -->
    
    <!--======Update Profile======-->
    <div class="modal fade theme-modal" id="editProfile" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel8">Update Your Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{url('/user-profile-update')}}" id="profileForm" enctype="multipart/form-data">
                        <div class="row g-4">
                                @csrf
                                <div class="col-xxl-4">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" class="form-control" id="name" name="name" value="{{Auth::user()->name}}">
                                        <label for="finame">Name</label>
                                        
                                    </div>
                                </div>
        
                                <div class="col-xxl-4">
                                    <div class="form-floating theme-form-floating">
                                        <input type="email" class="form-control" id="email" name="email" value="{{Auth::user()->email}}">
                                        <label for="laname">Email</label>
                                    </div>
                                </div>
                                
                                <div class="col-xxl-4">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{Auth::user()->phone}}">
                                        <label for="laname">Phone</label>
                                    </div>
                                </div>
                                
                                 <div class="col-xxl-4">
                                    <div class="form-floating theme-form-floating">
                                        <input type="file" class="form-control" id="image" name="image">
                                        <label for="laname">Image</label>
                                    </div>
                                </div>
                                
                               <div class="modal-footer">
                                    <button type="submit" class="btn theme-bg-color btn-md fw-bold text-light">Update</button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
      <!-- Edit Password Start -->
    <div class="modal fade theme-modal" id="editPassword" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel8">Password Change</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{url('/check-user-pwd-update')}}" id="passwordForm">
                        <div class="row g-4">
                            
                                @csrf
                                <div class="col-xxl-4">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" class="form-control" id="current_pwd" name="current_pwd">
                                         <label for="finame">Old Password</label>
                                        
                                    </div>
                                </div>
        
                                <div class="col-xxl-4">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" class="form-control" id="new_password" name="new_password">
                                        <label for="laname">New Password</label>
                                        
                                    </div>
                                </div>
                                
                                <div class="col-xxl-4">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" class="form-control" id="password_confirmation" name="password_confirmation">
                                        <label for="laname">Confirm Password</label>
                                    </div>
                                </div>
                               <div class="modal-footer">
                                    <button type="submit" class="btn theme-bg-color btn-md fw-bold text-light">Update</button>
                                </div>
                        </div>
                    </form>
                </div>
               
            </div>
        </div>
    </div>
    
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>

    <script>
          $(document).ready(function(){
       $('.qty-right-plus').click(function(e){
                e.preventDefault();
                var qty=$(this).closest('.wish_content').find('.qty-input').val();
                //alert(qty);
                
                var value=parseInt(qty,10);
                value=isNaN(value) ? 0 :value;
                if(value < 20 ){
                    value++;
                    $(this).closest('.wish_content').find('.qty-input').val(value);
                }
                
            });
            
            $('.qty-left-minus').click(function(e){
                e.preventDefault();
                var qty=$(this).closest('.wish_content').find('.qty-input').val();
                //alert(qty);
                
                var value=parseInt(qty,10);
                value=isNaN(value) ? 0 :value;
                if(value > 1){
                    value--;
                    $(this).closest('.wish_content').find('.qty-input').val(value);
                }
                
            });
       });
    </script>
  
     <script>
       //check current User Password
       $("#current_pwd").keyup(function(){
           var current_pwd=$(this).val();
           //alert(current_pwd);
           $.ajax({
               type:'post',
               url:"{{url('check-user-pwd')}}",
               data:{current_pwd:current_pwd},
               success:function(resp){
                //alert(resp);
                if(resp == false){
                    $("#chkpwd").html("<font color='red'>Current password is incorrect</font>");
                }else if(resp == true){
                $("#chkpwd").html("<font color='green'>Current password is Correct</font>");
                }
                
               },error:function(){
                   alert("Error");
               }
           });
       });
    </script>
         <script>
            $("#passwordForm").validate({
                rules: {
                    current_pwd: {
                        required: true,
                        minlength:6,
                        maxlength:20
                    },
                        new_password: {
                        required: true,
                        minlength: 6,
                        maxlength:20
                    },

                        password_confirmation: {
                        required: true,
                        minlength: 6,
                        maxlength:20,
                        equalTo:"#new_password"
                    },

                },
                messages: {
                    current_pwd: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 6 characters long"
                    },

                    new_password: {
                        required:"Please Enter your New Password",
                        minlength: "Your password must be at least 6 characters long"
                },
                password_confirmation: {
                        required:"Please Enter your New Password",
                        minlength: "Your password must be at least 6 characters long",
                        equalTo:"password does not match"
                },
                }
            });
        </script>
    <!-- Edit Card End -->
    
     <script type="text/javascript">
         

    </script>
        
       
    <script type="text/javascript">
        function eligibleView(id){
            if(!$('#modal-eligible').hasClass('modal-dialog')){
                $('#modal-eligible').addClass('modal-dialog');
            }
            $('#eligibleView-modal-body').html(null);
            $('#add-address').modal();
            $.get('{{url('/user-billing-address-update/') }}/'+id, function(data){
                $('#eligibleView-modal-body').html(data);
            });
        }
    </script>
    
    <script>
        document.getElementById('showButton').addEventListener('click',function(){
            let tabPane=document.getElementsByClassName('tab-pane');
            for(let i=0;i<tabPane.length;i++){
                tabPane[i].style.display='block'
            }
        })
    </script>
@endsection





