@extends('admin.admin_layouts')
@section('admin_content')
@php
  use Carbon\Carbon;
  $date=date("d-m-y");
  $month=date("F");
  $year=date('Y');

  //echo "<pre>";print_r($last_month);die;
  $productCountQuickee=App\Product::where('select_type','Quickee')->pluck('id');
  $ordCountQuickee=App\Order::where('status',3)->where('return_order','!=',2)->pluck('id');
  $today=DB::table('order_details')->where('date',$date)->whereIn('product_id',$productCountQuickee)->whereIn('order_id',$ordCountQuickee)->sum('total_price_amount');
  $delevery=DB::table('orders')->where('date',$date)->where('status',3)->get();
  $month=DB::table('order_details')->whereMonth('created_at',Carbon::now()->month)->whereIn('product_id',$productCountQuickee)->whereIn('order_id',$ordCountQuickee)->sum('total_price_amount');
  $year=DB::table('order_details')->whereYear('created_at',Carbon::now()->year)->whereIn('product_id',$productCountQuickee)->whereIn('order_id',$ordCountQuickee)->sum('total_price_amount');
  $Allyear=DB::table('order_details')->whereIn('product_id',$productCountQuickee)->whereIn('order_id',$ordCountQuickee)->sum('total_price_amount');
  $return=DB::table('orders')->where('return_order',2)->get();
  $product=DB::table('products')->where('select_type','Quickee')->get();
  $productLady=DB::table('products')->where('select_type','Ladystore')->get();
  $brand=DB::table('brands')->where('select_types','Quickee')->get();
  $totalIncome=DB::table('orders')->where('status',3)->where('return_order','!=',2)->sum('total');

  $brandLady=DB::table('brands')->where('select_types','Ladystore')->get();
  $user=DB::table('users')->get();
 //echo $total_count=$today-$ReturnOrder;die;
  // order count
  $todayOrdercount=DB::table('orders')->where('date',$date)->where('status',3)->count();
  $todayPendingcount=DB::table('orders')->where('date',$date)->where('status',0)->count();

  $productCount=App\Product::where('select_type','Ladystore')->pluck('id');
  $ordCount=App\Order::where('status',3)->where('return_order','!=',2)->pluck('id');
  //$productCountId=App\Product::where('select_type','Ladystore')->pluck('id')->toArray();
  $orders = App\OrderDetail::whereIn('product_id',$productCount)->whereIn('order_id',$ordCount)->sum('total_price_amount');
  $todayOrders = App\OrderDetail::where('date',$date)->whereIn('product_id',$productCount)->whereIn('order_id',$ordCount)->sum('total_price_amount');
  $monthOrders = App\OrderDetail::whereMonth('created_at',Carbon::now()->month)->whereIn('product_id',$productCount)->whereIn('order_id',$ordCount)->sum('total_price_amount');
  $yearOrders = App\OrderDetail::whereYear('created_at',Carbon::now()->year)->whereIn('product_id',$productCount)->whereIn('order_id',$ordCount)->sum('total_price_amount');
  $allyearOrders = App\OrderDetail::whereIn('product_id',$productCount)->whereIn('order_id',$ordCount)->sum('total_price_amount');


  //$id=$product['id'];
  //dd($todayOrders);die;
  //$orderCount=App\OrderDetail::where('product_id',$product)->sum('totalprice');
  //echo "<pre>";print_r($orderCount);die;
  $product=App\Product::where('select_type','Ladystore')->pluck('id')->toArray();
  $commentLady=App\ProductComment::with(['users', 'product'])->whereIn('product_id',$product)->latest()->count();

  $productQuickee=App\Product::where('select_type','Quickee')->pluck('id')->toArray();
  $commentQuickee=App\ProductComment::with(['users', 'product'])->whereIn('product_id',$productQuickee)->latest()->count();

  $current_order_income=DB::table('order_details')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->whereIn('product_id',$productQuickee)->whereIn('order_id',$ordCount)->sum('total_price_amount');
  $current_last_order_income=DB::table('order_details')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(1))->whereIn('product_id',$productQuickee)->whereIn('order_id',$ordCount)->sum('total_price_amount');
  $current_last_to_order_income=DB::table('order_details')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(2))->whereIn('product_id',$productQuickee)->whereIn('order_id',$ordCount)->sum('total_price_amount');


  $current_order_income_ladystore=DB::table('order_details')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->whereIn('product_id',$productCount)->whereIn('order_id',$ordCount)->sum('total_price_amount');
  $current_last_order_income_ladystore=DB::table('order_details')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(1))->whereIn('product_id',$productCount)->whereIn('order_id',$ordCount)->sum('total_price_amount');
  $current_last_to_order_income_ladystore=DB::table('order_details')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(2))->whereIn('product_id',$productCount)->whereIn('order_id',$ordCount)->sum('total_price_amount');

@endphp

 @if(Auth::user()->Ladystore == 1)
 <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <span class="breadcrumb-item active">Dashboard</span>
      </nav>
      <div class="sl-pagebody">
           <div class="row row-sm">
          <div class="col-sm-6 col-xl-3">
            <div class="card pd-20 bg-primary"  style="background-color:#9F85A9 !important">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Todays Income</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                 <h3 class="mg-b-0 tx-white tx-lato tx-bold">TK.{{$todayOrders}}</h3>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-3 -->

          <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0" >
            <div class="card pd-20 bg-info" style="background-color:#C86EC1 !important">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">This Month Income</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">TK.{{$monthOrders}}</h3>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-3 -->



          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-purple" style="background-color:#6EC5C8 !important">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">This Year Income</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">TK.{{$yearOrders}}</h3>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-3 -->

          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-sl-primary" style="background-color:#C5CA41 !important">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">All Income Year</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">TK.{{$allyearOrders}}</h3>
              </div><!-- card-body -->

            </div><!-- card -->
          </div><!-- col-3 -->
        </div><!-- row -->
         <br>
       <div class="row row-sm">
           <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-sl-primary">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total Customer</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{ count($user) }}</h3>
              </div><!-- card-body -->

            </div><!-- card -->
          </div><!-- col-3 -->

          <div class="col-sm-6 col-xl-3">
            <div class="card pd-20 bg-primary">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total Return</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{count($return)}}</h3>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
            <div class="card pd-20 bg-info">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Product</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{count($productLady)}}</h3>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-3 -->

          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-purple">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Brand Item </h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{count($brandLady)}}</h3>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-3 -->


        </div><!-- row -->


          <div class="row row-sm" style="margin-top: 20px">
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-purple" style="background-color:#A1B4A9 !important">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Todays Order Delivered</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{$todayOrdercount}}</h3>
              </div><!-- card-body -->

            </div><!-- card -->
          </div><!-- col-3 -->
           <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-purple" style="background-color:#67829B !important">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Todays Order Pending</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{$todayPendingcount}}</h3>
              </div><!-- card-body -->

            </div><!-- card -->
          </div><!-- col-3 -->
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-purple" style="background-color:#ff66d9 !important">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Customer Comments</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{$commentLady}}</h3>
              </div><!-- card-body -->

            </div><!-- card -->
          </div><!-- col-3 -->

        </div><!-- row -->


  <?php

    $current_month=date('M');
    $last_month=date('M',strtotime("-1 month"));
    $last_to_month=date('M',strtotime("-2 month"));

$dataPoints = array(
	array("label"=> $current_month, "y"=>$current_order_income_ladystore),
	array("label"=> $last_month, "y"=>$current_last_order_income_ladystore),
	array("label"=>$last_to_month, "y"=>$current_last_to_order_income_ladystore),

)

?>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Numbers of Income Over a Month"
	},
	axisY: {
		title: "Numbers of Income Over a Month"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

}
</script>
<div id="chartContainer" style="height: 370px; width: 100%;margin-top:40px"></div>
</div><!-- sl-pagebody -->
</div><!-- sl-mainpanel -->
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

@elseif(Auth::user()->BPTI == 1)
@php
$BannerCount=DB::table('bpti_cars')->where('status',1)->count();
$supplierCount=DB::table('bpti_suppliers')->where('status',1)->count();
$supplierCountUser=DB::table('bpti_forms')->where('status',1)->count();
$AboutCountUser=DB::table('about_bptis')->where('status',1)->count();
@endphp
 <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <span class="breadcrumb-item active">Dashboard</span>
      </nav>
      <div class="sl-pagebody">
        <div class="row row-sm">

           <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-purple" style="background-color:#67829B !important">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total Car Insert</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{$BannerCount}}</h3>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-3 -->
           <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-purple" style="background-color:#A1B4A9 !important">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total Stuff</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{$supplierCount}}</h3>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-sl-primary" style="background-color:#C5CA41 !important">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Customer Supplier</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{$supplierCountUser}}</h3>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-purple" style="background-color:#6EC5C8 !important">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">About Page</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{$AboutCountUser}}</h3>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-3 -->
        </div><!-- row -->

 @elseif(Auth::user()->flygharholiday == 1)
@php
$BannerCount=DB::table('info_flygars')->where('status',1)->count();
$supplierCount=DB::table('flygars')->where('status',1)->count();
$AboutCountUser=DB::table('about_flygers')->where('status',1)->count();
@endphp
 <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <span class="breadcrumb-item active">Dashboard</span>
      </nav>
      <div class="sl-pagebody">
        <div class="row row-sm">
           <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-purple" style="background-color:#67829B !important">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Customer Information</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{$BannerCount}}</h3>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-3 -->
           <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-purple" style="background-color:#A1B4A9 !important">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Flyger Information</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{$supplierCount}}</h3>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-3 -->

          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-purple" style="background-color:#6EC5C8 !important">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">About Page</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{$AboutCountUser}}</h3>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-3 -->
        </div><!-- row -->
 @else
 <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <span class="breadcrumb-item active">Dashboard</span>
      </nav>
      <div class="sl-pagebody">
        <div class="row row-sm">
          <div class="col-sm-6 col-xl-3">
            <div class="card pd-20 bg-primary"  style="background-color:#9F85A9 !important">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Todays Income</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">TK.{{$today}}</h3>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-3 -->

          <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0" >
            <div class="card pd-20 bg-info" style="background-color:#C86EC1 !important">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">This Month Income</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">TK.{{$month}}</h3>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-3 -->



          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-purple" style="background-color:#6EC5C8 !important">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">This Year Income</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">TK.{{$year}}</h3>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-3 -->

          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-sl-primary" style="background-color:#C5CA41 !important">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">All Income Year</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">TK.{{$Allyear}}</h3>
              </div><!-- card-body -->

            </div><!-- card -->
          </div><!-- col-3 -->
        </div><!-- row -->
        <br>
       <div class="row row-sm">
          <div class="col-sm-6 col-xl-3">
            <div class="card pd-20 bg-primary">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total Return</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{count($return)}}</h3>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-3 -->


           <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
            <div class="card pd-20 bg-info">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Product</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{count($product)}}</h3>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-3 -->


          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-purple">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Brand Item </h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{count($brand)}}</h3>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-sl-primary">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total Customer</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{ count($user) }}</h3>
              </div><!-- card-body -->

            </div><!-- card -->
          </div><!-- col-3 -->
        </div><!-- row -->

          <div class="row row-sm" style="margin-top: 20px">
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-purple" style="background-color:#A1B4A9 !important">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Todays Order Delivered</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{$todayOrdercount}}</h3>
              </div><!-- card-body -->

            </div><!-- card -->
          </div><!-- col-3 -->
           <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-purple" style="background-color:#67829B !important">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Todays Order Pending</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{$todayPendingcount}}</h3>
              </div><!-- card-body -->

            </div><!-- card -->
          </div><!-- col-3 -->
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-purple" style="background-color:#6bb691 !important">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Quickee And Ladystore Income</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">TK.{{$totalIncome}}</h3>
              </div><!-- card-body -->

            </div><!-- card -->
          </div><!-- col-3 -->
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-purple" style="background-color:#b68f6b !important">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Cutomer Comment</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{$commentQuickee}}</h3>
              </div><!-- card-body -->

            </div><!-- card -->
          </div><!-- col-3 -->
        </div><!-- row -->


  <?php

    $current_month=date('M');
    $last_month=date('M',strtotime("-1 month"));
    $last_to_month=date('M',strtotime("-2 month"));

$dataPoints = array(
	array("label"=> $current_month, "y"=>$current_order_income),
	array("label"=> $last_month, "y"=>$current_last_order_income),
	array("label"=>$last_to_month, "y"=>$current_last_to_order_income),

)

?>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Numbers of Income Over a Months"
	},
	axisY: {
		title: "Numbers of Income Over a Months"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

}
</script>
<div id="chartContainer" style="height: 370px; width: 100%;margin-top:40px"></div>
</div><!-- sl-pagebody -->
</div><!-- sl-mainpanel -->
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
 @endif
@endsection
