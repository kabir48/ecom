  @extends('layouts.app')
  @section('content')
  @php
    $setting=DB::table('sitesettings')->first();
    $settingCount=DB::table('sitesettings')->count();
   @endphp

  @if($url_two == "about")
   <div id="page-content">        
        <!--Body Container-->
        <!--Breadcrumbs-->
        <div class="breadcrumbs-wrapper">
        	<div class="container">
            	<div class="breadcrumbs"><a href="{{url('/')}}" title="Back to the home page">Home</a> <span aria-hidden="true">|</span> <span>{{$page->section}}</span></div>
            </div>
        </div>
        <!--End Breadcrumbs-->
        <div class="container">
        	<div class="page-title"><h1>{{$page->section}}</h1></div>
			<div class="top-text-block">
            	<p class="mb-4">{{$page->sub_title}}</p>
            </div>
        	<div class="row">
            	<div class="col-12 text-center mt-3 mb-3">
                	<img src="{{asset('public/media/page/'.$page->banner)}}" alt=""/>
                </div>
            </div>
            <div class="row mt-4">
            	<div class="col-4 col-sm-3 col-md-3 col-lg-3 text-center">
                	<h3><b>Our Mission</b></h3>
                </div>
                <div class="col-8 col-sm-8 col-md-8 col-lg-8">
                	<p>{!!$page->mission!!}</p>
                </div>
            </div>
            <div class="row mt-4">
            	<div class="col-4 col-sm-3 col-md-3 col-lg-3 text-center">
                	<h3><b>Our Vision</b></h3>
                </div>
                <div class="col-8 col-sm-8 col-md-8 col-lg-8">
                	<p>{!!$page->vission!!}</p>
                </div>
            </div>
       
           <div class="row">
            	<div class="col-12 text-center mt-3 mb-3">
                	<div id="map" style="width:100%; height: 450px">
                </div>
            </div>
        </div><!--End Body Container-->
    </div><!--End Page Wrapper-->
    @elseif($url_two == "policy")
    <div id="page-content">        
        <!--Body Container-->
        <!--Breadcrumbs-->
        <div class="breadcrumbs-wrapper">
        	<div class="container">
            	<div class="breadcrumbs"><a href="{{url('/')}}" title="Back to the home page">Home</a> <span aria-hidden="true">|</span> <span>{{$page->section}}</span></div>
            </div>
        </div>
        <!--End Breadcrumbs-->
        <div class="container">
        	<div class="page-title"><h1>{{$page->section}}</h1></div>
			<div class="top-text-block">
            	<p class="mb-4">{{$page->sub_title}}</p>
            </div>
        	<div class="row">
            	<div class="col-12 text-center mt-3 mb-3">
                	<img src="{{asset('public/media/page/'.$page->banner)}}" alt=""/>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-8 col-sm-8 col-md-12 col-lg-12">
                	<p>{!! $page->text !!}</p>
                </div>
            </div>
         
        </div><!--End Body Container-->
    </div><!--End Page Wrapper-->
    @else
        <div id="page-content">        
        <!--Body Container-->
        <!--Breadcrumbs-->
        <div class="breadcrumbs-wrapper">
        	<div class="container">
            	<div class="breadcrumbs"><a href="{{url('/')}}" title="Back to the home page">Home</a> <span aria-hidden="true">|</span> <span>{{$page->section}}</span></div>
            </div>
        </div>
        <!--End Breadcrumbs-->
        <div class="container">
        	<div class="page-title"><h1>{{$page->section}}</h1></div>
			<div class="top-text-block">
            	<p class="mb-4">{{$page->sub_title}}</p>
            </div>
        	<div class="row">
            	<div class="col-12 text-center mt-3 mb-3">
                	<img src="{{asset('public/media/page/'.$page->banner)}}" alt=""/>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-8 col-sm-8 col-md-12 col-lg-12">
                	<p>{!! $page->text !!}</p>
                </div>
            </div>
         
        </div><!--End Body Container-->
    </div><!--End Page Wrapper-->
    @endif
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDC3Ip9iVC0nIxC6V14CKLQ1HZNF_65qEQ"></script>
    <script>
        //google map
        var googleMapSelector = $('#map'),
            myCenter = new google.maps.LatLng(23.7387929, 90.3930435);

        function initialize() {
            var mapProp = {
                center: myCenter,
                zoom: 17,
                color: "#fff",
                scrollwheel: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("map"), mapProp);
            var marker = new google.maps.Marker({
                position: myCenter,
                title: 'BIGBEN +8801771770199',
                animation: google.maps.Animation.BOUNCE,
                icon: "@if($settingCount>0){{asset('public/media/logo/'.$setting->logo)}}@endif"
            });
            marker.setMap(map);
        }
        if (googleMapSelector.length) {
            google.maps.event.addDomListener(window, 'load', initialize);
        }
    </script>
    @endsection
