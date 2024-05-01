    <?php
        use App\Section;
        use App\Product;
        use App\CartModal;
        use App\Model\Admin\Category;
        $sections=Section::sections();
        $mainCategory=Category::mainCategory();
        $setting=DB::table('sitesettings')->first();
        $settingCount=DB::table('sitesettings')->count();
        $language=session()->get('lang');
        //echo "<pre>";print_r($mainCategory);die;
    ?>
    
   
    <style>
        .searchItem{
            position: relative;
        }
        #suggestProduct{
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: #fff;
            z-index: 999;
            border-radius: 4px;
            margin-top: 2px;
        }
        .c{
            float:left !important;
        }
    </style>
    <!--Header-->
    <header class="header animated d-flex align-items-center header-1">
        <div class="container">
            <div class="row">
                <!--Mobile Icons-->
                <div class="col-4 col-sm-4 col-md-4 d-block d-lg-none mobile-icons">
                    <!--Mobile Toggle-->
                    <button type="button" class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>
                    <!--End Mobile Toggle-->
                    <!--Search-->
                    <div class="site-search iconset">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </div>
                    <!--End Search-->
                </div>
                <!--Mobile Icons-->
                <!--Desktop Logo-->
                <div class="logo col-5 col-sm-5 col-md-5 col-lg-3 align-self-center">
                    <a href="{{ url('/') }}">
                        @if($settingCount>0)
                        <img src="{{asset('public/media/logo/'.$setting->logo)}}" alt="@if($settingCount>0) {{$setting->company_name}} @endif" title="@if($settingCount>0) {{$setting->company_name}} @endif"/>
                        @else
                        <img src="{{ asset('public/frontend/assets/images/avon-logo.svg') }}" alt="{{Config::get('app.name')}}" title="{{Config::get('app.name')}}"/>
                        @endif
                    </a>
                    <!--<a href="javascript:void(0);">-->
                    <!--    <img src="{{ asset('public/image/iso.png') }}" alt="Bigben" title="Bigben" />-->
                    <!--</a>-->
                    
                    <!--<a href="javascript:void(0);">-->
                    <!--    <img src="{{ asset('public/image/bsti.png') }}" alt="Bigben" title="Bigben" />-->
                    <!--</a>-->
                </div>
                <!--End Desktop Logo-->
                <div class="col-4 col-sm-4 col-md-4 col-lg-7 align-self-center d-menu-col">
                    <!--Desktop Menu-->
                    <nav class="grid__item" id="AccessibleNav">
                        <ul id="siteNav" class="site-nav medium center hidearrow">
                        <li class="lvl1 parent megamenu mdropdown"><a href="{{url('/')}}">
                            @if(session()->get('lang') == 'bangla')
                            {{__('heading.home_bn')}}
                            @elseif (session()->get('lang') == 'english')
                            {{__('heading.home')}}
                            @else
                            {{__('heading.home_bn')}}
                            @endif
                            <i class="anm anm-angle-down-l"></i>
                            </a>
                        </li>
                        @foreach($sections as $section)
                        @if (count($section['categories'])>0)
                        <li class="lvl1 parent megamenu"><a href="{{ url('section-products/'.$section['url']) }}">
                            @if(session()->get('lang') == 'bangla') {{$section['bangla_name']}}
                            @elseif (session()->get('lang') == 'english')
                            {{$section['name']}}
                            @else
                            {{$section['bangla_name']}}
                            @endif
                            <i class="anm anm-angle-down-l"></i></a>
                            <div class="megamenu style4">
                                <ul class="grid grid--uniform mmWrapper">
                                    @foreach($section['categories'] as $category)
                                    <li class="grid__item lvl-1 col-md-3 col-lg-3">
                                    <a href="{{url('category-products/'.pregName($category['url']))}}" class="site-nav lvl-1 menu-title">
                                        @if(session()->get('lang') == 'english'){{$category['bangla_name']}}
                                        @elseif (session()->get('lang') == 'bangla')
                                        {{$category['category_name']}}
                                        @else
                                       {{$category['bangla_name']}}
                                        @endif
                                    </a>
                                        <ul class="subLinks">
                                            @foreach($category['subcategories'] as $subcategory)
                                            <li class="lvl-2">
                                                <a href="{{ url('category-products/'.pregName($subcategory['url'])) }}" class="site-nav lvl-2">
                                                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                                    @if(session()->get('lang') == 'bangla')
                                                    {{$subcategory['bangla_name']}}
                                                    @elseif (session()->get('lang') == 'english')
                                                    {{$subcategory['category_name']}}
                                                    @else
                                                   {{$subcategory['bangla_name']}}
                                                    @endif
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                  @endforeach
    
                                </ul>
                                <div class="row clear">
                                    <?php
                                        $catImage=DB::table('categories')->where('parent_id',0)->latest()->take(3)->get();
                                    ?>
                                    @forelse($catImage as $data)
                                    <div class="col-md-4 col-lg-4">
                                        <a href="{{url('category-products/'.pregName($data->url))}}"><img  src="{{url('public/media/category/medium/'.$data->image)}}" data-src="{{url('public/media/category/medium/'.$data->image)}}" alt="{{$data->category_name}}"/></a>
                                    </div>
                                    @empty
                                    @endforelse
                                   
                                </div>
                            </div>
                        </li>
                        @endif
                        @endforeach
                        <li class="lvl1 parent dropdown"><a href="{{ url('/contact-view') }}">
                            @if(session()->get('lang') == 'bangla')
                            {{__("heading.pre_order_bn")}}
                            @elseif (session()->get('lang') == 'english')
                             {{__("heading.pre_order_en")}}
                            @else
                            {{__("heading.pre_order_bn")}}
                            @endif
                        <i class="anm anm-angle-down-l"></i></a></li>
                      </ul>
                    </nav>
                    <!--End Desktop Menu-->
                </div>
                <div class="col-3 col-sm-4 col-md-4 col-lg-2 align-self-center icons-col text-right">
                    <!--Search-->
                    <div class="site-search iconset">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                     <div class="search-drawer">
                        <div class="container">
                            <span class="closeSearch anm anm-times-l"></span>
                            <h3 class="title">What are you looking for?</h3>
                            <div class="block block-search">
                                <div class="block block-content searchItem">
                                    <form class="form minisearch search_form" id="header-search" action="{{url('/get-products-value')}}" method="GET">
                                        <label for="search" class="label"><span>Search</span></label>
                                        <div class="control">
                                            <div class="searchField">
                                                <div class="input-box">
                                                    <input type="search" id="searchProduct" name="search" placeholder="Search for products" class="input-text">
                                                    <button type="submit" title="Search" class="action search"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div id="suggestProduct"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Setting Dropdown-->
                    <div class="setting-link iconset">
                        <i class="fa-solid fa-gear"></i>
                    </div>
                    <div id="settingsBox">
                        @if(Auth::check())
                        <div class="customer-links">
                            <p><a href="{{url('customer/dashboard')}}" class="btn">My Dashbord</a></p>
                        </div>
                        @else
                        <div class="customer-links">
                            <p><a href="{{ url('user/login-registers') }}" class="btn">Login</a></p>
                        </div>
                        @endif
                        <div class="language-picker">
                            <span class="ttl">SELECT LANGUAGE</span>
                            <ul id="language" class="cnrLangList">
                                <li><a href="{{url('language/english') }}">English</a></li><li><a href="{{url('language/bangla') }}">Bangla</a></li>
                            </ul>
                        </div>
                    </div>
                    <!--End Setting Dropdown-->
                    <div class="wishlist-link iconset">
                        <i class="fa-solid fa-heart"></i>
                        <span class="wishlist-count totalWish">0</span>
                    </div>
                    <!--End Wishlist-->
                    <!--Minicart Dropdown-->
                    <div class="header-cart iconset">
                        <a href="#" class="site-header__cart btn-minicart addToCardSidebarTriggar" data-toggle="modal" data-target="#minicart-drawer">
                            <i class="fa fa-bag-shopping"></i>
                            <span class="site-cart-count totalCartItems empty">{{totalCartIteams()}}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--End Header-->
    
   
    
  

