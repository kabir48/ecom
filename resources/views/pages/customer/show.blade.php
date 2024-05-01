@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<?php
   use  Carbon\Carbon;
?>
 <link rel="stylesheet" href="{{asset('public/frontend/assets/css/user.css')}}" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<style>
    rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}
rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}

.footer-links a {
    font-size: 14px;
    text-decoration: none;
}
.display-table-cell p{
    font-size: 14px;
}
.btn {
    -moz-user-select: none;
    -ms-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    display: inline-block;
    width: auto;
    height: auto;
    text-decoration: none;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid transparent;
    border-radius: 0;
    padding: 8px 15px 8px;
    background-color: #000;
    color: #fff;
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
    text-transform: uppercase;
    letter-spacing: 1px;
    line-height: normal;
    white-space: normal;
    font-size: 13px;
    -ms-transition: all 0.3s ease-in-out;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}
.btn-primary:hover {
    color: #fff;
    background-color: #5e5e5e;
    border-color: #0a58ca;
}
.btn:hover {
    color: #fff;
}
.review_bt_a{
        font-size: 10px;
    background: #897676;
    color: #fff;
    padding: 0p;
    padding: 4px 4px;
    border-radius: 5px;
    text-decoration: none !important;
}

</style>
    <!-- User Dashboard Section Start -->
    <section class="user-dashboard-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-2 col-lg-2">
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
                                <a href="{{url('customer/dashboard')}}" class="nav-link" id="pills-security-tab" ><i data-feather="shield"></i>
                                    Back To Panel</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xxl-10 col-lg-10">
                    <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">Show
                        Menu</button>
                    <div class="dashboard-right-sidebar">
                        <div class="tab-content" id="pills-tabContent">
                                <!--=========order Table======-->
                            <div class="fade show" id="pills-order" role="tabpanel"
                                aria-labelledby="pills-order-tab">
                                <div class="dashboard-order">
                                    <div class="title">
                                        <h2>History Of Products And Review</h2>
                                        <span class="title-leaf title-leaf-gray">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                                            </svg>
                                        </span>
                                        @if($orderDetails['status']==4)
                                        <a class="btn btn-success " style="float:left;margin-top:20px" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addExchange">Product Exchange</a>
                                        @endif
                                    </div>
                                    
                                     <div class="dashboard-user-name">
                                        <p class="text-content">If You Feel The Product Is Good Please Provide Us Review</p>
                                    </div>
                                    
                                    <div class="dashboard-user-name">
                                        <p class="text-content">If you want to Return the Product Please make it within <strong style="color:red;font-weight:800">3 Days</strong>, and Provide Valid Reason</p>
                                    </div>
                                   @if($orderDetailCount>0)
                                   <div class="table-responsive dashboard-bg-box">
                                         <table class="bg-white table table-bordered table-hover text-center">
                                            <thead class="alt-font">
                                                <tr>
                                                    <th>Product Code</th>
                                                    <th>Image</th>
                                                    <th>name</th>
                                                    <th>Size</th>
                                                    <th>Date</th>
                                                    <th>Total</th>
                                                    <th>Return/Cancel</th>
                                                    <th>Review</th>
                                                    <th>Exchange/Return Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orderDetails['products'] as $order)
                                                
                                                <tr>
                                                    <td>{{$order['product_code']}}</td>
                                                    <td>
                                                        <?php $getProductImage=App\Product::getProductImage($order['product_id']);?>
                                                        <img  src="{{asset($getProductImage)}}" alt="" height="60">
                                                    </td>
                                                    <td>{{$order['product_name']}}</td>
                                                    <td>{{$order['product_size']}}</td>
                                                    <td>{{$order['date']}}</td>
                                                    <td>Tk.{{ $order['total_price_amount'] }}</td>
                                                    <td>
                                                        @if($orderDetails['payment_gateway'] != 'COD') 
                                                            <!--<a title="return" target="_blank" style="color:#0da487" href="{{url('/customer-order-return-product/'.$order['id'])}}"><i class="fas fa-undo-alt"></i></a>-->
                                                            <?php
                                                               $getReturnCount=App\ReturnProduct::select('status')->where('order_id',$orderDetails['id'])->where('user_id',Auth::user()->id)->where('product_size',$order['product_size'])->where('product_code',$order['product_code'])->count();
                                                               $getReturn=App\ReturnProduct::select('status')->where('order_id',$orderDetails['id'])->where('user_id',Auth::user()->id)->where('product_size',$order['product_size'])->where('product_code',$order['product_code'])->first();
                                                            ?>
                                                            @if($getReturnCount>0)
                                                                @if($getReturn->status=='Pending')
                                                                <span class="text-warning">{{$getReturn->status}}</span>
                                                                @elseif($getReturn->status=='Approved')
                                                                <span class="text-success">{{$getReturn->status}}</span>
                                                                @else
                                                                <span class="text-danger">{{$getReturn->status}}</span>
                                                                @endif
                                                            @else
                                                                <?php
                                                                    $expectedDate = Carbon::parse($orderDetails['Expected_date']);
                                                                    $currentDate = Carbon::now(); // Removed ->toDateString()
                                                                    $sevenDaysFromExpected = $expectedDate->copy()->addDays(3)->toDateString();
                                                                    // dd($sevenDaysFromExpected);
                                                                ?>
                                                                
                                                                @if($currentDate->lte(Carbon::parse($sevenDaysFromExpected)))
                                                                    <a title="return" style="color:#0da487" data-bs-toggle="modal" onclick="returnView({{$order['id']}})" id="{{$order['id']}}" data-bs-target="#addReturn" href="javascript:void();"><i class="fas fa-undo-alt"></i></a>
                                                                @else
                                                                    <a target="_blank" href="{{url('/all-pages/refund')}}">Return Policy</a>
                                                                @endif
                                                            @endif
                                                        @else
                                                            @if($orderDetails['status'] == 0) 
                                                                <button style="color:red" class="btn mt-lg-0 mt-3" data-bs-toggle="modal" onclick="cancelView({{ $order['id'] }})" id="{{ $order['id'] }}" data-bs-target="#add-cancel">
                                                                   <i class="fa fa-ban"></i>
                                                                </button>
                                                            @else
                                                                @if($orderDetails['status'] == 4)
                                                                    <?php
                                                                       
                                                                       $getReturnCount=App\ReturnProduct::select('status')->where('order_id',$orderDetails['id'])->where('user_id',Auth::user()->id)->where('product_size',$order['product_size'])->where('product_code',$order['product_code'])->count();
                                                                       $getReturn=App\ReturnProduct::select('status')->where('order_id',$orderDetails['id'])->where('user_id',Auth::user()->id)->where('product_size',$order['product_size'])->where('product_code',$order['product_code'])->first();
                                                                    ?>
                                                                    @if($getReturnCount>0)
                                                                        @if($getReturn->status=='Pending')
                                                                        <span class="text-warning">{{$getReturn->status}}</span>
                                                                        @elseif($getReturn->status=='Approved')
                                                                        <span class="text-success">{{$getReturn->status}}</span>
                                                                        @else
                                                                        <span class="text-danger">{{$getReturn->status}}</span>
                                                                        @endif
                                                                    @else
                                                                        <?php
                                                                            $expectedDate = Carbon::parse($orderDetails['Expected_date']);
                                                                            $currentDate = Carbon::now(); // Removed ->toDateString()
                                                                            $sevenDaysFromExpected = $expectedDate->copy()->addDays(3)->toDateString();
                                                                            // dd($sevenDaysFromExpected);
                                                                        ?>
                                                                        
                                                                        @if($currentDate->lte(Carbon::parse($sevenDaysFromExpected)))
                                                                            <a title="return" style="color:#0da487" data-bs-toggle="modal" onclick="returnView({{$order['id']}})" id="{{$order['id']}}" data-bs-target="#addReturn" href="javascript:void();"><i class="fas fa-undo-alt"></i></a>
                                                                        @else
                                                                            <a target="_blank" href="{{url('/all-pages/refund')}}">Return Policy</a>
                                                                        @endif

                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </td>
                                                    @if($orderDetails['status']==4)
                                                        <?php
                                                           $getRatingCount=App\ProductRating::where('user_id',Auth::user()->id)->where('product_id',$order['product_id'])->where('order_id',$order['order_id'])->count();
                                                           $getRating=App\ProductRating::where('user_id',Auth::user()->id)->where('product_id',$order['product_id'])->where('order_id',$order['order_id'])->first();
                                                           //dd($getRating);
                                                        ?>
                                                        @if($getRatingCount>0)
                                                        <td>
                                                            @for($i=1;$i<=$getRating->rating;$i++)
                                                            <i class="fas fa-star"></i>
                                                            @endfor
                                                        </td>
                                                        @else
                                                        <td>
                                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addReview" class="review_bt_a">Add Review</a>
                                                                 <!--=========Review Submit======-->
                                                            <div class="modal fade theme-modal" id="addReview" tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel8">Provide Your Review</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form method="post" action="{{url('/check-user-review-post')}}" id="profileForm" enctype="multipart/form-data">
                                                                                <div class="row g-4">
                                                                                        @csrf
                                                                                        <input type="hidden" name="product_id" value="{{$order['product_id']}}">
                                                                                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                                                                        <input type="hidden" name="order_id" value="{{$order['order_id']}}">
                                                                                       
                                                                                        
                                                                                        <div class="col-xxl-6">
                                                                                            <div class="form-floating theme-form-floating">
                                                                                                <textarea rows="5" cols="40" class="form-control" id="review" name="color_review"></textarea>
                                                                                                <label for="finame">About Color</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                        <div class="col-xxl-6">
                                                                                            <div class="form-floating theme-form-floating">
                                                                                                <div class="rate">
                                                                                                    <input type="radio" id="color_rating5" name="color_rating" value="5" />
                                                                                                    <label for="color_rating5" title="text">5 stars</label>
                                                                                                    
                                                                                                    <input type="radio" id="color_rating4" name="color_rating" value="4" />
                                                                                                    <label for="color_rating4" title="text">4 stars</label>
                                                                                                    
                                                                                                    <input type="radio" id="color_rating3" name="color_rating" value="3" />
                                                                                                    <label for="color_rating3" title="text">3 stars</label>
                                                                                                    
                                                                                                    <input type="radio" id="color_rating2" name="color_rating" value="2" />
                                                                                                    <label for="color_rating2" title="text">2 stars</label>
                                                                                                    
                                                                                                    <input type="radio" id="color_rating1" name="color_rating" value="1" />
                                                                                                    <label for="color_rating1" title="text">1 star</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>  
                                                                                        
                                                                                        <div class="col-xxl-6">
                                                                                            <div class="form-floating theme-form-floating">
                                                                                                <textarea rows="5" cols="40" class="form-control" id="review" name="size_review"></textarea>
                                                                                                <label for="finame">About Size</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                        <div class="col-xxl-6">
                                                                                            <div class="form-floating theme-form-floating">
                                                                                                <div class="rate">
                                                                                                    <input type="radio" id="size_rating5" name="size_rating" value="5" />
                                                                                                    <label for="size_rating5" title="text">5 stars</label>
                                                                                                    
                                                                                                    <input type="radio" id="size_rating4" name="size_rating" value="4" />
                                                                                                    <label for="size_rating4" title="text">4 stars</label>
                                                                                                    
                                                                                                    <input type="radio" id="size_rating3" name="size_rating" value="3" />
                                                                                                    <label for="size_rating3" title="text">3 stars</label>
                                                                                                    
                                                                                                    <input type="radio" id="size_rating2" name="size_rating" value="2" />
                                                                                                    <label for="size_rating2" title="text">2 stars</label>
                                                                                                    
                                                                                                    <input type="radio" id="size_rating1" name="size_rating" value="1" />
                                                                                                    <label for="size_rating1" title="text">1 star</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                        <div class="col-xxl-6">
                                                                                            <div class="form-floating theme-form-floating">
                                                                                                <textarea rows="5" cols="40" class="form-control" id="review" name="review"></textarea>
                                                                                                <label for="finame">Overall Comment</label>
                                                                                            </div>
                                                                                        </div>
                                                                
                                                                                        <div class="col-xxl-6">
                                                                                            <div class="form-floating theme-form-floating">
                                                                                                <div class="rate">
                                                                                                    <input type="radio" id="star5" name="rating" value="5" />
                                                                                                    <label for="star5" title="text">5 stars</label>
                                                                                                    <input type="radio" id="star4" name="rating" value="4" />
                                                                                                    <label for="star4" title="text">4 stars</label>
                                                                                                    <input type="radio" id="star3" name="rating" value="3" />
                                                                                                    <label for="star3" title="text">3 stars</label>
                                                                                                    <input type="radio" id="star2" name="rating" value="2" />
                                                                                                    <label for="star2" title="text">2 stars</label>
                                                                                                    <input type="radio" id="star1" name="rating" value="1" />
                                                                                                    <label for="star1" title="text">1 star</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                       <div class="modal-footer">
                                                                                            <button type="submit" class="btn theme-bg-color btn-md fw-bold text-light">Submit</button>
                                                                                        </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @endif
                                                    @else
                                                    <td>Please Wait---</td>
                                                    @endif
                                                    
                                                    <td>{{$order['item_status']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @foreach($orderDetails['products'] as $detail)
                                    <?php
                                        $ratings=App\ProductRating::where('user_id',Auth::user()->id)->where('product_id',$detail['product_id'])->where('order_id',$detail['order_id'])->get();
                                        $ratingCount=App\ProductRating::where('user_id',Auth::user()->id)->where('product_id',$detail['product_id'])->where('order_id',$detail['order_id'])->count();
                                    ?>
                                    @if($ratingCount>0)
                                    <div class="table-responsive dashboard-bg-box">
                                        <table class="table product-table">
                                            <thead>
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Review</th>
                                                    <th>Rating Review</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($ratings as $rating)
                                                <tr>
                                                    <td>{{$rating->product->product_name}}</td>
                                                    <td>{{Illuminate\Support\Str::limit($rating->review, 20)}}</td>
                                                    <td>{{$rating->rating}}</td>
                                                    <td>
                                                        <button class="btn theme-bg-color text-white btn-sm fw-bold mt-lg-0 mt-3"
                                            data-bs-toggle="modal" onclick="reviewView({{ $rating->id }})" id="{{ $rating->id }}" data-bs-target="#add-review"><i data-feather="plus"
                                                class="me-2"></i> Edit Review
                                                </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif
                                    @endforeach
                                    @endif
                                </div>
                            </div
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- User Dashboard Section End -->
    
    
            <!--=========Product Exchange========-->
            <div class="modal fade theme-modal" id="addExchange" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel8">Provide Your Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                        <form method="post" action="{{url('/exchange-products/'.$orderDetails['id'])}}" id="profileForm" enctype="multipart/form-data">
                            <div class="row g-4">
                                    @csrf
                                     <div class="col-xxl-6">
                                        <div class="form-floating theme-form-floating" >
                                            <select class="form-control" name="product_info" id="product_info">
                                                <option>select product</option>
                                                @foreach($orderDetails['products'] as $product)
                                                @if($product['item_status'] !="Return Initiated")
                                                <option value="{{$product['product_code']}}-{{$product['product_size']}}"> {{$product['product_name']}} - {{$product['product_code']}} - {{$product['product_size']}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <label for="finame">Return Product Reason</label>
                                        </div>
                                    </div>
                                    
                                     <div class="col-xxl-6">
                                        <div class="form-floating theme-form-floating" >
                                            <select class="form-control" name="required_size" id="productSize">
                                            </select>
                                            <label for="finame">Required Product</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xxl-6">
                                        <div class="form-floating theme-form-floating" >
                                            <select class="form-control" name="exchange_reason" id="reasonStatus">
                                                <option>Select Reason</option>
                                                <option value="Require Narrow">Require Narrow</option>
                                                <option value="Require  Smaller Size">Require  Smaller Size</option>
                                                <option value="Require Medium Size">Require Medium Size</option>
                                                <option value="Require Larager Size">Require Larager Size</option>
                                                <option value="Product was Exchanged">Product was Exchanged</option>
                                                <option value="Quality Problems">Quality Problems</option>
                                            </select>
                                            <label for="finame">Return Product Reason</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xxl-6">
                                        <div class="form-floating theme-form-floating">
                                            <textarea rows="5" cols="40" class="form-control" id="review" name="note"></textarea>
                                            <label for="finame">Note (only 200 words)</label>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <button type="submit" class="btn theme-bg-color btn-md fw-bold text-light btnExchangeOrder">Submit</button>
                                    </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
    
 
    
            <!--Review update modal-->
            <div class="modal fade theme-modal" id="add-review" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down" id="modal-rating">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Rating</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="ratingView-modal-body">
                           
                        </div>
                    </div>
                </div>
            </div>
            
            
             <!-- =================Return Product update modal =============-->
            <div class="modal fade theme-modal" id="addReturn" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down" id="modal-return">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Product Return</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="returnView-modal-body">
                           
                        </div>
                    </div>
                </div>
            </div>
            
            <!--====Cancel Update modal====-->
            <div class="modal fade theme-modal" id="add-cancel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down" id="modal-cancel">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmation Delete Product?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="cancel-modal-body">
                           
                        </div>
                    </div>
                </div>
            </div>
            
   
    <!--===========products rating==========-->
    
    <script type="text/javascript">
        function reviewView(id){
            if(!$('#modal-rating').hasClass('modal-dialog')){
                $('#modal-rating').addClass('modal-dialog');
            }
            $('#ratingView-modal-body').html(null);
            $('#add-address').modal();
            $.get('{{url('/check-user-review-update') }}/'+id, function(data){
                $('#ratingView-modal-body').html(data);
            });
        }
    </script>
    
    <!--======Return products===========-->
    
    <script type="text/javascript">
        function returnView(id){
            if(!$('#modal-return').hasClass('modal-dialog')){
                $('#modal-return').addClass('modal-dialog');
            }
            $('#returnView-modal-body').html(null);
            $('#add-address').modal();
            $.get('{{url('/customer-order-return-product') }}/'+id, function(data){
                $('#returnView-modal-body').html(data);
            });
        }
    </script>
    
    <!--======Cancel products===========-->
    
    <script type="text/javascript">
        function cancelView(id){
            if(!$('#modal-cancel').hasClass('modal-dialog')){
                $('#modal-cancel').addClass('modal-dialog');
            }
            $('#ratingView-modal-body').html(null);
            $('#add-address').modal();
            $.get('{{url('/customer-order-cancel') }}/'+id, function(data){
                $('#cancel-modal-body').html(data);
            });
        }
    </script>
    
    
    <script>
        $("#product_info").change(function(){
            var product_info =$(this).val();
            //alert(product_info);
           // var productSize=$("productSize").val();
            $.ajax({
                type:'post',
                url:"{{url('exchange-product-size')}}",
                data:{product_info:product_info},
                success:function(resp){
                   $("#productSize").html(resp)
                },error:function(){
                    alert("Error")
                }
            })
        })
    </script>
    
    <script>
        $(document).on('click','.btnExchangeOrder',function(){
            var productSize=$("productSize").val();
            if(productSize==''){
                 alert('Please Select Exchange Product Info');
                return false;
            }
            var product_info =$("#product_info").val();
            if(product_info==''){
               alert('Please Select Product Info');
                return false; 
            }
            var reasonStatus=$("#reasonStatus").val();
            if(reasonStatus==""){
                alert('Please Select Reason');
                return false;
            }
            
            var result =confirm("Want to Exchange This Product?");
            if(!result){
                return false;
            }
        })
    </script>
    
@endsection





