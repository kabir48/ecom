@extends('layouts.app')
@section('content') 
    <div id="page-content" class="py-5">        
        <!--Body Container-->
        <!--Breadcrumbs-->
        <div class="breadcrumbs-wrapper">
        	<div class="container">
            	<div class="breadcrumbs"><a href="{{url('/')}}" title="Back to the home page">Home</a> <span aria-hidden="true">|</span> <span>
            	    @if(session()->get('lang') == 'english')
                	{{$about->name}} 
                	@elseif (session()->get('lang') == 'bangla')
                	{{$about->name_bn}}
                	@else
                	{{$about->name}}
                	@endif
            	</span></div>
            </div>
        </div>
        <!--End Breadcrumbs-->
        <div class="container">
        	<div class="page-title"><h1>
        	     @if(session()->get('lang') == 'english')
                	{{$about->name}} 
                	@elseif (session()->get('lang') == 'bangla')
                	{{$about->name_bn}}
                	@else
                	{{$about->name}}
                	@endif
        	</h1></div>
			<div class="top-text-block">
            	<p class="mb-4">
            	     @if(session()->get('lang') == 'english')
                	{{$about->text}} 
                	@elseif (session()->get('lang') == 'bangla')
                	{{$about->text_bn}}
                	@else
                	{{$about->text}}
                	@endif
            	</p>
            </div>
        	<div class="row">
            	<div class="col-12 text-center mt-3 mb-3">
                	<img src="{{'public/media/about/'.$about->banner}}" alt=""/>
                </div>
            </div>
            <div class="row mt-3">
            	<div class="col-4 col-sm-3 col-md-3 col-lg-3 text-center">
                	<h3><b>   
                	@if(session()->get('lang') == 'english')
                	{{$about->why}} 
                	@elseif (session()->get('lang') == 'bangla')
                	{{$about->why_bn}}
                	@else
                	{{$about->why}}
                	@endif</b></h3>	
                </div>
                <div class="col-8 col-sm-8 col-md-8 col-lg-8">
                	<p>
                	 @if(session()->get('lang') == 'english')
                	{{$about->why_text}} 
                	@elseif (session()->get('lang') == 'bangla')
                	{{$about->why_text_bn}}
                	@else
                	{{$about->why_text}}
                	@endif
                	 </p>
                </div>
            </div>
            <div class="row mt-4">
            	<div class="col-4 col-sm-3 col-md-3 col-lg-3 text-center">
                	<h3><b>
                	 @if(session()->get('lang') == 'english')
                	{{$about->vision}} 
                	@elseif (session()->get('lang') == 'bangla')
                	{{$about->vision_bn}}
                	@else
                	{{$about->vision}}
                	@endif
                	</b></h3>
                </div>
                <div class="col-8 col-sm-8 col-md-8 col-lg-8">
                	<p>
                	 @if(session()->get('lang') == 'english')
                	{{$about->vision_text}} 
                	@elseif (session()->get('lang') == 'bangla')
                	{{$about->vision_text_bn}}
                	@else
                	{{$about->vision_text}}
                	@endif
                	</p>
                </div>
            </div>
            <div class="row mt-4">
            	<div class="col-4 col-sm-3 col-md-3 col-lg-3 text-center">
                	<h3><b>
                	     @if(session()->get('lang') == 'english')
                	{{$about->mission}} 
                	@elseif (session()->get('lang') == 'bangla')
                	{{$about->mission_bn}}
                	@else
                	{{$about->mission}}
                	@endif
                	</b></h3>
                </div>
                <div class="col-8 col-sm-8 col-md-8 col-lg-8">
                	<p>
                	 @if(session()->get('lang') == 'english')
                	{{$about->mission_text}} 
                	@elseif (session()->get('lang') == 'bangla')
                	{{$about->mission_text_bn}}
                	@else
                	{{$about->mission_text}}
                	@endif
                	</p>
                </div>
            </div>
           
        </div><!--End Body Container-->
    </div><!--End Page Wrapper-->
    @endsection
    

