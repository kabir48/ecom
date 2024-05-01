@extends('layouts.admin.main')
@section('admin_content')
<!-- Start right Content here -->
<?php use Carbon\Carbon;?>
@php
    $numberController = app(\App\Http\Controllers\Admin\AdminController::class);
    $totalIncome = $totalIncome;
    $formattedIncome = $numberController->formatLargeNumber($totalIncome);
    //$numericValue = floatval($formattedIncome);
@endphp

 <main class="ContentBody">
        <div class="row ContentBodyWrapper">
            <!-- Left Content -->
            <div class="col-md-7 leftSide">
                <div class="row">

                    <!-- Total sale -->
                    <div class="col-sm-6">
                        <div class="infoCard">
                            <div class="leftBox">
                                <!-- Icon -->
                                <span class="icon">
                                    <img src="{{asset('public/backend/asset/img/dashboard_shopping_cart.svg')}}" alt="img">
                                </span>
                                <div class="infoCon">
                                    {{-- <h3>@if($total_order >= 1000) <?php  $value=$total_order / 1000 ; ?> {{ $value }} k
                                    @else
                                    {{$total_order}}
                                    @endif
                                    </h3> --}} 
                                    <h3>@if($total_order_count) {{ $total_order_count }} @endif</h3>
                                    <p>Order lists</p>
                                </div>
                            </div>
                            <a href="{{ url('/admin/order-lists') }}" class="cbtn" type="button">
                                <img src="{{asset('public/backend/asset/img/right-angle.png')}}" class="rightAngleIcon">
                            </a>
                        </div>
                    </div>

                    <!-- Pending order -->
                    <div class="col-sm-6">
                        <div class="infoCard">
                            <div class="leftBox">
                                <!-- Icon -->
                                <span class="icon">
                                    <img src="{{asset('public/backend/asset/img/watch_later.svg')}}" alt="Watch Icon">
                                </span>
                                <div class="infoCon">
                                    {{-- <h3>
                                        @if($pending_order_sum >=1000)
                                         <?php  $p_value=$pending_order_sum / 1000 ; ?>{{ $p_value }} k
                                         @else
                                         {{$pending_order_sum}}
                                         @endif
                                    </h3> --}}
                                    <h3>@if($pending_order_count) {{ $pending_order_count }} @endif</h3>
                                    <p>Pending order</p>
                                </div>
                            </div>
                            <a href="{{ url('/admin/order-lists') }}" class="cbtn" type="button">
                                <img src="{{asset('public/backend/asset/img/right-angle.png')}}" class="rightAngleIcon">
                            </a>
                        </div>
                    </div>

                    <!-- Active order -->
                    <div class="col-sm-6">
                        <div class="infoCard">
                            <div class="leftBox">
                                <!-- Icon -->
                                <span class="icon">
                                    <img src="{{asset('public/backend/asset/img/assignment.svg')}}" alt="Image">
                                </span>
                                <div class="infoCon">
                                    <h3>{{$formattedIncome}}</h3>
                                    <p>Total Income</p>
                                </div>
                            </div>
                            <a href="{{ url('/admin/inventory-product-lists') }}" class="cbtn" type="button">
                                <img src="{{asset('public/backend/asset/img/right-angle.png')}}" class="rightAngleIcon">
                            </a>
                        </div>
                    </div>

                    <!-- Delivered -->
                    <div class="col-sm-6">
                        <div class="infoCard">
                            <div class="leftBox">
                                <!-- Icon -->
                                <span class="icon">
                                    <img src="{{asset('public/backend/asset/img/alarm_on.svg')}}" alt="Image">
                                </span>
                                <div class="infoCon">
                                    {{--<h3>
                                        @if($return_order_count>=1000)
                                        <?php
                                           $return_value=$return_order_count/1000;
                                        ?>
                                        {{$return_value}} k
                                        @else
                                        {{$return_order_count}}
                                        @endif
                                    </h3>--}}
                                    <h3>@if($delivered_order_count) {{ $delivered_order_count }} @endif</h3>
                                    <p>Delivered</p>
                                </div>
                            </div>
                            <a href="{{ url('/admin/order-lists') }}" class="cbtn" type="button">
                                <img src="{{asset('public/backend/asset/img/right-angle.png')}}" class="rightAngleIcon">
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Traffic Canvas -->
                <div class="traffic_Canvas">
                    <div class="canvas_header">
                        <h2>Traffic</h2>
                        <select id="trafficCanvasSelect">
                            <option value="Monthly" selected>Monthly</option>
                            <option value="Yearly">Yearly</option>
                        </select>
                    </div>
                    <div id="MonTrafficGraphs" style="width: 100%;"></div>
                    <div id="YerTrafficGraphs" style="width: 100%;"></div>
                </div>
                
                <!-- Order List -->
                <div class="orderListArea">
                    <div class="canvas_header">
                        <h2>Order List</h2>
                        <select id="OrderListTime">
                            <option value="Monthly" selected>Monthly</option>
                            <option value="Yearly">Yearly</option>
                        </select>
                    </div>  

                    <!-- orders -->
                    <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                        <table class="dashboard_Order_status">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID <span type="button" class="AscDecTriggerBtn"><img src="{{asset('public/backend/asset/img/arrowdownup.png')}}" alt=""></span></th>
                                    <th>Date</th>
                                    {{--<th>Transection</th>--}}
                                    {{--<th>Payment Type</th>--}}
                                    <th>Location</th>
                                    <th>Amount <span type="button" class="AscDecTriggerBtn"><img src="{{asset('public/backend/asset/img/arrowdownup.png')}}" alt=""></span></th>
                                    <th>Status Order <span type="button" class="AscDecTriggerBtn"><img src="{{asset('public/backend/asset/img/arrowdownup.png')}}" alt=""></span></th>
                                </tr>
                            </thead>
                            <tbody class="dashboard_Order_status_body">
                                @foreach($orders as $key=>$order)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>#{{$order->order_no}}</td>
                                    <td>{{date('d M,Y',strtotime($order->date))}}</td>
                                    {{--<td>{{ substr($order->blnc_transection, 0, 7) . '...' }}</td>--}}
                                    {{--<td>@if($order->payment_type=='prepaid') <span style="color:green">Paid</span> @else Hand Cash @endif</td>--}}
                                    <?php
                                   
                                    $getAddress=DB::table('shipping_addresses')->where('order_id',$order->id)->first();
                                    ?>
                                    <td>{{trim($getAddress->address)}}</td>
                                    <td>Taka. {{$order->total}}</td>
                                    <td>
                                        @if($order->status==1)
                                        <span class="statusTag pending"></span>
                                        On Prosseing
                                        @elseif($order->status==2)
                                        <span class="statusTag pending"></span>Delivery
                                        @else
                                        <span class="statusTag complete"></span>
                                        New Order
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <?php 
            $current_month_order_income=DB::table('orders')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->where('status',4)->sum('total');
            $startOfWeek = Carbon::now()->startOfWeek();
            $endOfWeek = Carbon::now()->endOfWeek();
            
            // Calculate the income for the entire week
            $weeklyOrdersIncome = App\Order::whereBetween('date', [$startOfWeek, $endOfWeek])
                ->where('status',4)
                ->sum('total');
                
            $yearlyIncome=DB::table('orders')->whereYear('created_at',Carbon::now()->year)->where('status',4)->sum('total');
            ?>
            <!-- Right Content -->
            <div class="col-md-5 rightSide">
                <!-- Profits Canvas -->
                <div class="profits_Canvas">
                    <div class="canvas_header">
                        <h2 id="weekly">
                            Profits this day <b>Taka. {{round($weeklyOrdersIncome,2)}}</b>
                        </h2>
                        <h2 id="yearly" style="display:none">
                            Profits this day <b>Taka. {{round($yearlyIncome,2)}}</b>
                        </h2>
                        <select id="ProfitsCanvasSelect">
                            <option value="Weekly" selected>Weekly</option>
                            <option value="Monthly">Monthly</option>
                        </select>
                    </div>                    
                    <div id="WeekProfitsGraphs" style="max-width: 98%;margin-left: 3px;max-width: calc(100% - 12px);"></div>
                    <div class="monthgraphwrap" data-simplebar data-simplebar-auto-hide="false">
                        <div id="MontProfitsGraphs" style="max-width: 100%; min-width: 520px"></div>
                    </div>
                </div>

                <!-- Products -->
                <div class="products_wrpper">
                    <div class="canvas_header">
                        <h2>
                            Top Products
                        </h2>
                        <select id="ProductGrothTime" class="changeTimeLine">
                            {{--<option value="monthly" selected>Monthly</option>
                            <option value="yearly">Yearly</option>
                            <option value="none">None</option>--}}
                            <option id="MonthlyTopProductTrigger">Monthly</option>
                            <option id="YearlyTopProductTrigger">Yearly</option>
                        </select>
                    </div>
                    <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                        <table class="Products_inner" id="MonthlyTopProduct">
                            <tbody id="getValues">
                                
                               
                                <?php
                                //dd(Carbon\Carbon::now()->month);
                                //$brandIds=Product::select('brand_id')->whereIn('id',$getProductIds)->groupBy('brand_id')->pluck('brand_id')->toArray();
                          
                                $getOrderDetails=App\OrderDetail::with('product')->select('product_id')->whereIn('order_id',$getOrder)->groupBy('product_id')->pluck('product_id')->toArray();
                                $getProducts=App\Product::with('category')->whereIn('id',$getOrderDetails)->get()->toArray();
                                //dd($getProducts);die;
                            
                                ?>
                               
                                @if(count($getProducts)>0)
                                @foreach($getProducts as $key=>$data)
                              
                               
                                <?php
                                    $getOrderDetailCount=App\Order::with('product')->where('status',4)->count();
                                    $getOrderDetailSingleCount=App\OrderDetail::with('product')->where(['product_id'=>$data['id']])->whereIn('order_id',$getOrder)->count();
                                    //dd($getOrderDetailSingleCount);
                                    $per=$getOrderDetailSingleCount/$getOrderDetailCount * 100;
                                ?>
                                <tr>
                                    <td>
                                        <img src="{{ asset($data['image_one'])}}" alt="Product Image" class="productImage">
                                    </td>
                                    <td class="con_wrpper">
                                        <h3 class="title">{{$data['product_name']??""}} (sale {{ $getOrderDetailSingleCount}})</h3>
                                        <ul>
                                            <li>
                                                <span class="cstatus"></span>
                                                <span>{{$data['category']['category_name']}}</span>
                                            </li>
                                            <li>|</li>
                                            <li>
                                                <img src="{{asset('public/image/trend-up.png')}}" alt="">
                                               <span>{{round($per,2)}}%</span>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <a target="_blank" href="{{url('admin/product-lists')}}" class="cbtn"><img src="{{asset('public/image/right_angle.png')}}" class="rightAngleIcon"></a>
                                    </td>
                                </tr>
                                
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        <table class="Products_inner" style="display: none;" id="YearlyTopProduct">
                            <tbody id="getValues">
                                
                               
                                <?php
                                
                                $getYearOrder=App\Order::where('status',4)->orWhere('payment_type','prepaid')->whereYear('date',date('Y'))->pluck('id');
                                $getYearOrderDetails=App\OrderDetail::with('product')->select('product_id')->whereIn('order_id',$getYearOrder)->groupBy('product_id')->pluck('product_id');
                                $getYearProducts=App\Product::whereIn('id',$getYearOrderDetails)->get(); 
                   
                            
                                ?>
                               
                                @if(count($getYearProducts)>0)
                                @foreach($getYearProducts as $key=>$data)
                              
                               
                                <?php
                                    $getOrderDetailCount=App\Order::where('status',4)->orWhere('payment_type','prepaid')->whereYear('date',date('Y'))->count();
                                    $getOrderDetailSingleCount=App\OrderDetail::with('product')->where(['product_id'=>$data['id']])->whereIn('order_id',$getOrder)->count();
                                    $per=$getOrderDetailSingleCount/$getOrderDetailCount * 100;
                                ?>
                                <tr>
                                    <td>
                                        <img src="{{ asset($data['image_one'])}}" alt="Product Image" class="productImage">
                                    </td>
                                    <td class="con_wrpper">
                                        <h3 class="title">{{$data['product_name']??""}} (sale {{ $getOrderDetailSingleCount}})</h3>
                                        <ul>
                                            <li>
                                                <span class="cstatus"></span>
                                                <span>{{$data['category']['category_name']}}</span>
                                            </li>
                                            <li>|</li>
                                            <li>
                                                <img src="{{asset('public/image/trend-up.png')}}" alt="">
                                               <span>{{round($per,2)}}%</span>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="" class="cbtn"><img src="{{asset('public/image/right_angle.png')}}" class="rightAngleIcon"></a>
                                    </td>
                                </tr>
                                
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <?php
    $months = array("Jan", "Feb", "Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
     
    //   $current_week=Carbon::setWeekStartsAt(Carbon::SUNDAY);
    //   dd($current_week);
    //   $date = Carbon::now()->subDays(7);
    //   dd($date);
        $now = Carbon::now();
        
        $current_month=date('M');
        $last_month=date('M',strtotime("-1 month"));
        $last_last_month=date('M',strtotime("-2 month"));
        $prev_month=date('M',strtotime("-3 month"));
        $prev_prev_month=date('M',strtotime("-4 month"));
        $prev_last_month=date('M',strtotime("-5 month"));
        
        // Year
        $current_year=date('Y');
        $one_year_back=date('Y',strtotime("-1 year"));
        $two_year_back=date('Y',strtotime("-2 year"));
        $three_year_back=date('Y',strtotime("-3 year"));
        $four_year_back=date('Y',strtotime("-4 year"));
        $five_year_back=date('Y',strtotime("-5 year"));
        $currentYear=App\VisitorIp::whereYear('date',Carbon::now()->year)->count();
        
          $one_year_back_value=App\VisitorIp::whereYear('date', now()->subYear(1))->count();
          //dd($one_year_back_vlaue);
           $two_year_back_value=App\VisitorIp::whereYear('date',Carbon::now()->subYear(2))->count(); 
           $three_year_back_value=App\VisitorIp::whereYear('date',Carbon::now()->subYear(3))->count(); 
           $four_year_back_value=App\VisitorIp::whereYear('date',Carbon::now()->subYear(4))->count(); 
           $five_year_back_value=App\VisitorIp::whereYear('date',Carbon::now()->subYear(5))->count(); 
           
           
        $current_day=$now->subDays(0)->format('l');
        $prev_day=$now->subDays(1)->format('l');
        $last_pre_day=$now->subDays(2)->format('l');
        
       
      // dd($current_day_order_income);
      
      $dateTime=date('d-m-Y');
      //dd($dateTime);
        
       $yesterday=date('d-m-Y',strtotime('-1 Days'));
       $dayBeforeyesterday=date('d-m-Y',strtotime('-2 Days'));
       $last3days=date('d-m-Y',strtotime('-3 Days'));
       $last4days=date('d-m-Y',strtotime('-4 Days'));
       //dd($last3days);
       
       $current_day_order_income=DB::table('orders')->where('date',$dateTime)->where('status',4)->sum('total');
       $yestersay_day_order_income=DB::table('orders')->where('date',$dayBeforeyesterday)->where('status',4)->sum('total');
       $dayBeforeYesterday_order_income=DB::table('orders')->where('date',$last3days)->where('status',4)->sum('total');
       $lastFourDay_order_income=DB::table('orders')->where('date',$last4days)->where('status',4)->sum('total');
        
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('d-m-Y');
        $weekEndDate = $now->endOfWeek()->format('d-m-Y');
        
        // $startDate=date('d-m-Y',strtotime($weekStartDate));
        // $endDate=date('d-m-Y',strtotime($weekEndDate));
       // dd($weekEndDate);
        
      
    //   $end=date('d-m-Y',strtotime('last day of this month')) ;
    //   $start=date('d-m-Y',strtotime('last monday')) ;
       
       $allWeeks=DB::table('orders')->whereBetween('date',[$weekStartDate,$weekEndDate])
      ->where('status',4)->sum('total');
      //dd($current_day_order_income);
      
      if($current_day_order_income !=0 || $yestersay_day_order_income !=0 ||$dayBeforeYesterday_order_income !=0 ||$lastFourDay_order_income !=0){
        //  $currentDayProfitMargin=($current_day_order_income / $allWeeks) * 100;  
        //  //dd($currentDayProfitMargin);
        //  $YesterProfitMargin=($yestersay_day_order_income / $allWeeks) * 100;  
        //  $dayBeforeYesterdayProfitMargin=($dayBeforeYesterday_order_income / $allWeeks) * 100;
        //  $dayBeforeYesterdayProfitMargin=($dayBeforeYesterday_order_income / $allWeeks) * 100;
        //  $last4ProfitMargin=($lastFourDay_order_income / $allWeeks) * 100;
         
        //  $combibeTodayAndYesterDay=$currentDayProfitMargin - $YesterProfitMargin;
        //  //dd($combibeTodayAndYesterDay);
        //  $combibeYesterdayAndDayYesterDay=$YesterProfitMargin - $dayBeforeYesterdayProfitMargin;
        //  $combibeLastandFour=$dayBeforeYesterdayProfitMargin - $lastFourDay_order_income;
      }else{
          $currentDayProfitMargin=0;
          $YesterProfitMargin=0;
          $dayBeforeYesterdayProfitMargin=0;
          $last4ProfitMargin=0;
          $combibeLastandFour=0;
      }
    ?>
    
    


    
    <script>
        $(document).ready(function(){
            $('#ProductGrothTime').change(function(){
                var MonthlyVal = $(this).children('#MonthlyTopProductTrigger').val();
                var YearlyVal = $(this).children('#YearlyTopProductTrigger').val();
                if(MonthlyVal == $(this).val()){
                    $('#YearlyTopProduct').hide();
                    $('#MonthlyTopProduct').show();
                }else if(YearlyVal == $(this).val()){
                    $('#MonthlyTopProduct').hide();
                    $('#YearlyTopProduct').show();
                }
            });
            $(".changeTimeLine").on("change",function(){
                var value=$(this).val();
                //alert(value)
                $.ajax({
                    url:"{{url('admin/get-multiple-highest-products')}}",
                    type:"post",
                    data:{'value':value},
                    success:function(resp){
                        if(value=='none'){
                            $("#getValues").html("");
                        }
                        $("#getValues").html(resp)
                    }
                })
            })
        })
    </script>
    
    

    
  <script>
      window.onload = function () {
    
    // /*=============================================
    // =            Trafic Chat Graphs            =
    // =============================================*/
    var MonTrafficGraphsop = {
        colors : ['#5E6DA0'],
        series: [{
        name: 'Traffic',
        data: [{{$current_month_user_ip}},{{$last_month_user_ip}},{{$last_last_month_user_ip}},{{$prev_month_user_ip}},{{$prev_prev_month_user_ip}},{{$prev_last_month_user_ip}}]
      }],
        chart: {
        height: 280,
        type: 'area'
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth'
      },
      xaxis: {
          categories: ['{{$current_month}}','{{$last_month}}','{{$last_last_month}}','{{$prev_month}}','{{$prev_prev_month}}','{{$prev_last_month}}'],
      },
      yaxis: {
          labels: {
              formatter: function(val) {
                if(val >= 1000 && val < 1000000){
                    return val / 1000 + 'K'
                } else if (val >= 1000000 && val < 1000000000) {
                  return val / 1000000 + 'M'
                } else if (val >= 1000000000 && val < 1000000000000) {
                  return val / 1000000000 + 'B'
                } else if (val >= 1000000000000) {
                  return val / 1000000000000 + 'T'
                } else{
                    return val
                }
              }
          }
      },
      tooltip: {
        x: {
          format: 'dd/MM/yy HH:mm'
        },
      },
    };
    var chart = new ApexCharts(document.querySelector("#MonTrafficGraphs"), MonTrafficGraphsop);
    chart.render();
    
    var YerTrafficGraphsop = {
        colors : ['#5E6DA0'],
        series: [{
        name: 'Traffic',
        data:['{{$currentYear}}','{{$one_year_back_value}}','{{$two_year_back_value}}','{{$three_year_back_value}}','{{$four_year_back_value}}','{{$five_year_back_value}}'],
      }],
        chart: {
        height: 280,
        type: 'area'
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth'
      },
      xaxis: {
          categories:[{{$current_year}},{{$one_year_back}},{{$two_year_back}},{{$three_year_back}},{{$four_year_back}},{{$five_year_back}}],
      },
      yaxis: {
          labels: {
              formatter: function(val) {
                if(val >= 1000 && val < 1000000){
                    return val / 1000 + 'K'
                } else if (val >= 1000000 && val < 1000000000) {
                  return val / 1000000 + 'M'
                } else if (val >= 1000000000 && val < 1000000000000) {
                  return val / 1000000000 + 'B'
                } else if (val >= 1000000000000) {
                  return val / 1000000000000 + 'T'
                } else{
                    return val
                }
              }
          }
      },
      tooltip: {
        x: {
          format: 'dd/MM/yy HH:mm'
        },
      },
    };
    var chart = new ApexCharts(document.querySelector("#YerTrafficGraphs"), YerTrafficGraphsop);
    chart.render();


    var selectedOption = $("#trafficCanvasSelect").val();
    if (selectedOption === "Monthly") {  
        $("#MonTrafficGraphs").show(1);
        $("#YerTrafficGraphs").hide(1);
    }else{
        $("#YerTrafficGraphs").show(1);
        $("#MonTrafficGraphs").hide(1);
    }
  
    $("#trafficCanvasSelect").change(function() {
      var selectedOption = $(this).val();
      
      if (selectedOption === "Monthly") {
        $("#MonTrafficGraphs").show(1);
        $("#YerTrafficGraphs").hide(1);
      } else if (selectedOption === "Yearly") {
        $("#YerTrafficGraphs").show(1);
        $("#MonTrafficGraphs").hide(1);
      }
    });

    /*=====  End of Section comment block  ======*/


    
    /*=============================================
    =            Profits Graphs            =
    =============================================*/
    
    @php 
        // Get the current date
        $today = Carbon::now();
        $yesterday = Carbon::yesterday();
        $dayBeforeYesterday = Carbon::yesterday()->subDay();
       // dd($today,$yesterday,$dayBeforeYesterday);
        
        //=======Profit By Days=====//
        $current_day_income=DB::table('orders')->where('date',$today)->where('status',4)->sum('total');
        $yestersay_day_income=DB::table('orders')->where('date',$yesterday)->where('status',4)->sum('total');
        $dayBeforeYesterday_income=DB::table('orders')->where('date',$dayBeforeYesterday)->where('status',4)->sum('total');
        
        //=====Profit By Months=====//
        $current_month_income=DB::table('orders')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->where('status',4)->sum('total');
        $previous_month_income=DB::table('orders')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(1))->where('status',4)->sum('total');
        $last_previous_income=DB::table('orders')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(2))->where('status',4)->sum('total');
        
        //======Days Name====//
        $dayNameToday = $today->format('l');
        $dayNameYesterday = $yesterday->format('l');
        $dayNameDayBeforeYesterday = $dayBeforeYesterday->format('l');
         //dd($dayNameToday,$dayNameYesterday,$dayNameDayBeforeYesterday);
        //====Months Name====//
        $current_month=date('M');
        $last_month=date('M',strtotime("-1 month"));
        $last_last_month=date('M',strtotime("-2 month"));
        
        //====Total Week Income====//
        
        
        
        
        
    @endphp
    
    
    var weeklyoptions = { 
        colors : ['#964B00'],
        series: [
            {
                name: 'Recent',
                data: ["{{$dayNameToday}}","{{$dayNameYesterday}}","{{$dayNameDayBeforeYesterday}}"]
            }
        ],
        chart: {
        type: 'bar',
        height: 220
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded',
        },
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        show: true,
        width: 1.5,
        colors: ['transparent']
    },
    xaxis: {
        categories: ['{{$current_day_income}}', '{{$yestersay_day_income}}', '{{$dayBeforeYesterday_income}}'],
        offsetY: -10
    },
    yaxis: {
        labels: {
            formatter: function(val) {
                if(val >= 1000 && val < 1000000){
                    return val / 1000 + 'K'
                } else if (val >= 1000000 && val < 1000000000) {
                  return val / 1000000 + 'M'
                } else if (val >= 1000000000 && val < 1000000000000) {
                  return val / 1000000000 + 'B'
                } else if (val >= 1000000000000) {
                  return val / 1000000000000 + 'T'
                } else{
                    return val
                }
            }
        }
    },
    fill: {
        opacity: 1
    },
    tooltip: {
        y: {
        formatter: function (val) {
            if(val >= 1000 && val < 1000000){
                return "TK. " + val / 1000 + 'thousand'
            } else if (val >= 1000000 && val < 1000000000) {
              return "TK. " + val / 1000000 + 'million'
            } else if (val >= 1000000000 && val < 1000000000000) {
              return "TK. " + val / 1000000000 + 'billion'
            } else if (val >= 1000000000000) {
              return "TK. " + val / 1000000000000 + 'trillion'
            } else{
                return val
            }
        }
        }
    }
    };
    var chart = new ApexCharts(document.querySelector("#WeekProfitsGraphs"), weeklyoptions);
    chart.render();

    var monthlyoptions = { 
        colors : ['#5E6DA0'],
        series: [{
        name: 'Active Profit',
        data: ["{{$current_month_income}}","{{$previous_month_income}}","{{$last_previous_income}}"]
    }],
        chart: {
        type: 'bar',
        height: 220
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
        },
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
    },
    xaxis: {
        categories: ['{{$current_month}}','{{$last_month}}','{{$last_last_month}}'],
        offsetY: -10
    },
    yaxis: {
        labels: {
            formatter: function(val) {
                if(val >= 1000 && val < 1000000){
                    return val / 1000 + 'K'
                } else if (val >= 1000000 && val < 1000000000) {
                  return val / 1000000 + 'M'
                } else if (val >= 1000000000 && val < 1000000000000) {
                  return val / 1000000000 + 'B'
                } else if (val >= 1000000000000) {
                  return val / 1000000000000 + 'T'
                } else{
                    return val
                }
            }
        }
    },
    fill: {
        opacity: 1
    },
    tooltip: {
        y: {
        formatter: function (val) {
            if(val >= 1000 && val < 1000000){
                return "TK. " + val / 1000 + 'thousand'
            } else if (val >= 1000000 && val < 1000000000) {
              return "TK. " + val / 1000000 + 'million'
            } else if (val >= 1000000000 && val < 1000000000000) {
              return "TK. " + val / 1000000000 + 'billion'
            } else if (val >= 1000000000000) {
              return "TK. " + val / 1000000000000 + 'trillion'
            } else{
                return val
            }
        }
        }
    }
    };
    var chart = new ApexCharts(document.querySelector("#MontProfitsGraphs"), monthlyoptions);
    chart.render();

    


    var selectedOption = $("#ProfitsCanvasSelect").val();
    if (selectedOption === "Weekly") {      
        $("#WeekProfitsGraphs").show(1);
        $("#MontProfitsGraphs").hide(1);
    }else{
        $("#WeekProfitsGraphs").hide(1);
        $("#MontProfitsGraphs").show(1);
    }
  
    $("#ProfitsCanvasSelect").change(function() {
        var selectedOption = $(this).val();
        if (selectedOption === "Weekly") {    
            $("#WeekProfitsGraphs").show(1);
            $("#MontProfitsGraphs").hide(1);
            $("#weekly").show(1);
            $("#yearly").hide(1);
        } else if (selectedOption === "Monthly") {
            $("#WeekProfitsGraphs").hide(1);
            $("#MontProfitsGraphs").show(1);
            $("#weekly").hide(1);
            $("#yearly").show(1);
        }
    });

    
    /*=====  End of Profits Graphs  ======*/

    
}
  </script>
@endsection

