   <?php
        use App\Section;
        use App\Model\Admin\Category;
        $sections=Section::sections();
        $mainCategory=Category::mainCategory();
        //echo "<pre>";print_r($mainCategory);die;
    ?>
    <!--Mobile Menu-->
    <div class="mobile-nav-wrapper" role="navigation">
		<div class="closemobileMenu"><i class="fa fa-times" aria-hidden="true"></i> Close Menu</div>
        <ul id="MobileNav" class="mobile-nav">
    	<li class="lvl1 parent megamenu"><a href="{{url('/')}}">Home</a></li>
    	@foreach($sections as $section)
    	<li class="lvl1 parent megamenu">
    	    <a href="{{ url('section-products/'.$section['url']) }}">
    	        @if(session()->get('lang') == 'english'){{$section['name']}}
                @elseif (session()->get('lang') == 'bangla')
                {{$section['bangla_name']}}
                @else
                {{$section['name']}}
                @endif
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
    	    @if (count($section['categories'])>0)
            <ul>
                @foreach($section['categories'] as $category)
                <li><a href="{{ url('category-products/'.$category['url']) }}" class="site-nav"> 
                        @if(session()->get('lang') == 'english'){{$category['category_name']}}
                        @elseif (session()->get('lang') == 'bangla')
                        {{$category['bangla_name']}}
                        @else
                        {{$category['category_name']}}
                        @endif
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                    <ul>
                        @foreach($category['subcategories'] as $subcategory)
                      	<li>
                  	        <a href="{{ url('category-products/'.$subcategory['url']) }}" class="site-nav">
                      	        @if(session()->get('lang') == 'english'){{$subcategory['category_name']}}
                                @elseif (session()->get('lang') == 'bangla')
                                {{$subcategory['bangla_name']}}
                                @else
                                {{$subcategory['category_name']}}
                                @endif
                            </a>
                        </li>
                      	@endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
            @endif
        </li>
        @endforeach
        <li class="lvl1 parent megamenu"><a href="product-layout1.html">Pre-Order</a></li>
      </ul>
	</div>
	<!--End Mobile Menu-->
