@extends('layouts.app')
@section('content')
    <style>
       .watermark {
            position: absolute;
            font-size: 24px;
            font-weight: bold;
            color: rgba(255, 255, 255, 0.5);
            transform: rotate(-45deg);
            pointer-events: none;
            bottom: -61px;
        }
        
        .watermarkTwo {
            position: absolute;
            font-size: 24px;
            font-weight: bold;
            color: rgba(255, 255, 255, 0.5);
            /* transform: rotate(-20deg); */
            pointer-events: none;
            top: -25px;
            left: 480px;
        }
        
        .product-form__item{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
         input[type=radio] {
            width: auto;
            height: auto;
       }
       .style2{
           display:none;
       }
        
        /*.product-form__item .swatchInput {*/
        /*    display: none;*/
        /*}*/
        
        /*.product-form__item .swatchInput:checked+.swatchLbl {*/
        /*    border: 2px solid #111111;*/
        /*    box-shadow: none;*/
        /*}*/
        
       /*.product-form__item .swatchInput+.swatchLbl {*/
       /*     color: #000;*/
       /*     font-size: 12px;*/
       /*     font-weight: 400;*/
       /*     line-height: 26px;*/
       /*     text-transform: capitalize;*/
       /*     display: inline-block;*/
       /*     margin: 0;*/
       /*     min-width: 30px;*/
       /*     height: 30px;*/
       /*     overflow: hidden;*/
       /*     text-align: center;*/
       /*     background-color: #f9f9f9;*/
       /*     padding: 0 10px;*/
       /*     border: 2px solid #fff;*/
       /*     box-shadow: 0 0 0 1px #ddd;*/
       /*     border-radius: 0;*/
       /*     -ms-transition: all 0.5s ease-in-out;*/
       /*     -webkit-transition: all 0.5s ease-in-out;*/
       /*     transition: all 0.5s ease-in-out;*/
       /*     cursor: pointer;*/
       /* }*/
        
       /* .product-form__item .available .swatchLbl {*/
       /*     display: block;*/
       /*     text-transform: uppercase;*/
       /*     font-weight: 600;*/
       /*     margin: 0px 4px;*/
       /*     border-radius: 12%;*/
       /* }*/
        

/* CSS code */
.glow {
    /* Add your glow effect styles here */
    box-shadow: 0 0 10px rgba(0, 0, 255, 0.5); /* Example glow effect with a blue color */
}
    </style>
    <div id="page-content">
        <!--Home slider-->
        <div class="slideshow slideshow-wrapper">
            <div class="home-slideshow">
                 @foreach ($getBanners as $item)
                <div class="slide">
                    <div class="blur-up lazyload">
                        <img class="blur-up lazyload" data-src="{{asset('public/media/banner/'.$item['banner'])}}" src="{{asset('public/media/banner/'.$item['banner'])}}" alt="{{$item['tag_one'] }}" title="{{$item['meta_title'] }}"/>
                        <div class="slideshow__text-wrap slideshow__overlay left">
                            <div class="slideshow__text-content">
                                <div class="wrap-caption anim-tru left style1">
                                    <p class="mega-small-title">{{$item['tag']}}</p>
                                    <h2 class="h1 mega-title slideshow__title">{{$item['meta_title']}}</h2>
                                    <span class="mega-subtitle slideshow__subtitle">{{$item['sub_title']}}</span>
    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!--End Home slider-->
        
        <!--Body Container-->
        <div class="container">
            <!-- Banner Masonary-->
            <div class="collection-banners style1">
                <div class="grid-masonary banner-grid">
                    <div class="grid-sizer"></div>
                        <div class="row">
                            @foreach($cateDetail as $data)
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 banner-item" @if($data['style']) style="{{$data['style']}}" @endif>
                                <div class="collection-grid-item">
                                    <div class="img">
                                        <img class="blur-up lazyload" data-src="{{asset('public/media/category/large/'.$data['image'])}}" src="{{asset('public/media/category/large/'.$data['image'])}}" alt="{{$data['category_name']}}" title=" {{$data['category_name']}}" />
                                    </div>
                                    <div class="details center">
                                        <div class="inner">
                                            <h3 class="title">
                                                @if(session()->get('lang') == 'bangla'){{$data['bangla_name']}}
                                                @elseif (session()->get('lang') == 'english')
                                                {{$data['category_name']}}
                                                @else
                                                {{$data['bangla_name']}}
                                                @endif
                                            </h3>
                                            <p>@if($data['category_discount']) {{$data['category_discount']}} @endif</p>
                                            <a href="{{url('category-products/'.$data['url'])}}" class="btn">
                                                @if(session()->get('lang') == 'bangla')
                                                {{__('heading.read_more_bn')}}
                                                @elseif (session()->get('lang') == 'english')
                                                {{__('heading.read_more_en')}}
                                                @else
                                                {{__('heading.read_more_bn')}}
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            <!-- End Banner Masonary-->
        </div>
        @include('pages.include.men')
        @include('pages.include.women')
    </div>

    <?php
      
       use Carbon\Carbon;
       
       $current=Carbon::now()->toDateString();
       //dd($current);

        $getAdds = DB::table("product_adds")->where('location', 'front')->where('date','>',$current)->first();
        $getAddCount = DB::table("product_adds")->where('location', 'front')->where('date','>',$current)->count();
        //dd($getAddds);
        if($getAddCount>0){
             // Assuming 'created_at' and 'date' are timestamps
        $startDate = Carbon::parse($getAdds->created_at)->startOfDay();
        $endDate = Carbon::parse($getAdds->date)->startOfDay();
        
        $daysDifference = $endDate->diffInDays($startDate);
        }
        
        
       


        //dd($daysDifference);
        
    ?>

 <!--=====Newsletter Popup=====-->
   @if($getAddCount>0)
    <div id="newsletter-modal" class="style2 mfp-with-anim">
        <div class="newsltr-tbl">
            <div class="newsltr-img small--hide"><img src="{{ asset('public/media/addproduct/'.$getAdds->image_one) }}" alt="{{$getAdds->add_title}}"></div>
            <div class="newsltr-text text-center">
                <div class="wraptext">
                    <h2>{{$getAdds->add_title}}</h2>
                    <h5 class="sub-text">{{$getAdds->add_short_detail}} </h5>
                    <h6>This Offer Is Valid for Only {{$daysDifference}} Days</h6>   
                </div>
            </div>
        </div>
        <button title="Close (Esc)" type="button" class="mfp-close" onclick="closeModal()">×</button>
    </div>
    @endif
    <!--End Newsletter Popup-->


    <script>
        // JavaScript code
        document.addEventListener('DOMContentLoaded', function () {
            // Show the modal
            showModal();
        });
        
        function showModal() {
            var modal = document.getElementById('newsletter-modal');
            modal.style.display = 'block';
        }
        
        function closeModal() {
            var modal = document.getElementById('newsletter-modal');
            modal.style.display = 'none';
        }

    </script>
@endsection




















