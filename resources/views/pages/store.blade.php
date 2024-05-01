 @extends('layouts.app')
 @section('bodyclass','store-page')
 @section('content')
  <link href="{{asset('public/frontend/assets/css/single.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('public/frontend/assets/css/kits-new-store.css')}}" rel="stylesheet" type="text/css" />
   
     <main>
        <!--========== Content area ===========-->
        <div class="content_area">
            <div class="container">
                <div class="content_inner">
                    <!-- sidebar area -->
                    <div class="sidebar_area pt-md-5">
                        <button class="cbtn d-md-none d-flex mb_20" id="hidecategorybtn">
                            <i class="fal fa-angle-left"></i>
                            Hide Category
                        </button>
                        <h2 class="sidebar_title">Shop All</h2>
                        <h5 class="sub_title">COLLECTIONS</h5>
                        <ul class="categroy_list" id="categroy_list">
                            <li new_value="4" value="4"><a class="top" >Top Sell</a></li>
                            <li new_value="Yes" value="Yes"><a>New Releases</a></li>
                            @foreach($events as $event)
                            <li new_value="{{$event->id}}"><a>{{$event->name}} {{date('Y')}}</a></li>
                            @endforeach
                        </ul>
                        
                        <h5 class="sub_title">TOPS</h5>
                        <ul class="categroy_list_top" id="categroy_list_top">
                            @foreach($topCategories as $top)
                            <li top_bottom_value="{{$top->id}}"><a>{{$top->category_name}}</a></li>
                            @endforeach
                        </ul>
                        
                        <h5 class="sub_title">BOTTOMS</h5>
                        <ul class="categroy_list_top" id="categroy_list_top">
                            @foreach($bottomCategories as $top)
                            <li top_bottom_value="{{$top->id}}"><a>{{$top->category_name}}</a></li>
                            @endforeach
                        </ul>

                        <h5 class="sub_title">CLOTHES</h5>
                        <ul class="filter_list" id="filter_list">
                            @foreach($filters as $filter)
                            <li filter_name="{{$filter->filter_value}}"><a >{{$filter->filter->filter_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- All products Area  -->
                    <div class="product_area">
                        <div class="porduct_wrapper">
                            <!-- Grid view system -->
                            <div class="grid_view_wrapper text-end">
                                <button class="d-md-none cbtn" id="showcategroybtn">
                                    Show Category 
                                    <i class="fal fa-angle-right"></i>
                                </button>
                                <ul>
                                    <li>View</li>
                                    <li id="onecol" class="d-block d-lg-none">
                                        <i class="far fa-ellipsis-v"></i>
                                    </li>
                                    <li id="towcol" class="d-block d-lg-none">
                                        <i class="far fa-ellipsis-v"></i>
                                        <i class="far fa-ellipsis-v"></i>
                                    </li>
                                    <li id="threecol" class="d-none d-lg-block">
                                        <i class="far fa-ellipsis-v"></i>
                                        <i class="far fa-ellipsis-v"></i>
                                        <i class="far fa-ellipsis-v"></i>
                                    </li>
                                    <li id="fourcol" class="d-none d-lg-block">                                        
                                        <i class="far fa-ellipsis-v"></i>
                                        <i class="far fa-ellipsis-v"></i>
                                        <i class="far fa-ellipsis-v"></i>
                                        <i class="far fa-ellipsis-v"></i>
                                    </li>
                                </ul>
                            </div>
                            <div class="row product_inner" id="storeProduct">
                                 @include('pages.include.storeproduct')
                            </div>
                            <!-- pagination -->
                            <div class="pagination">
                                {{$storeProducts->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    
    <script>
       $(document).ready(function () {
           
           $("#categroy_list li").on('click',function(){
                var value =$(this).attr('new_value');
                //alert(value);
                $.ajax({
                    headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{url('new-product-filter')}}",
                    type:'POST',
                    data:{value:value},
                    success:function(resp){
                        $("#storeProduct").html(resp.newProductView);
                    },error:function(error){
                        alert(error.status)
                    }
                })
           })
       }) 
    </script> 
    
    <script>
       $(document).ready(function () {
            $("#categroy_list_top li").on('click',function(){
                var top_bottom =$(this).attr('top_bottom_value');
                //alert(value);
                $.ajax({
                    headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{url('top-category-product-filter')}}",
                    type:'POST',
                    data:{top_bottom:top_bottom},
                    success:function(resp){
                        $("#storeProduct").html(resp.topProductView);
                    },error:function(error){
                        alert(error.status)
                    }
                })
           })
       }) 
    </script>  
    
    <script>
       $(document).ready(function () {
            $("#filter_list li").on('click',function(){
                var filter_name =$(this).attr('filter_name');
                //alert(filter_name);
                $.ajax({
                    headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{url('product-filter-name')}}",
                    type:'POST',
                    data:{filter_name:filter_name},
                    success:function(resp){
                        $("#storeProduct").html(resp.filterProductView);
                    },error:function(error){
                        alert(error.status)
                    }
                })
           })
       }) 
    </script> 
    
   
    @endsection
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

