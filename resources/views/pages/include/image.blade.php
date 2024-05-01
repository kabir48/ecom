       <!--==== Product Image==== -->
        <div class="d-lg-block d-none">
            <div class="product_image_wrapper">
                <div class="list_of_product_img">
                    <ul id="productImageList">
                        @foreach($attributeImages as $key=>$image)
                        @if(isset($image['product_images']))
                        <li class="@if($key==0) active @endif"><img src="{{asset('public/media/product/multiple/large/'.$image['product_images'])}}" alt="{{$image['product']['product_name']}}"></li>
                        @endif
                        @endforeach
                    </ul>
                    <button id="productImageListScrollDown" style="display:none;">
                        <i class="fal fa-angle-down"></i>
                    </button>
                </div>
                <div class="full_product_image">
                    <!-- Image Tag -->
                    <div class="tags">
                        <span class="bg-light text-dark">New Style</span>
                    </div>
                    <!-- full Size Image -->
                    <img src="{{asset('public/media/product/multiple/large/'.$attributeImages[0]['product_images'])}}" alt="Full Size Product Image" id="full_size_of_product_image">
                </div>
            </div>
        </div>                        
        <!-- Product Image Slider For medium and small Device -->
        <div class="d-lg-none">
            <div class="product_image_slider owl-carousel owl-theme">
                @foreach($attributeImages as $key=>$image)
                <div class="item">
                    <img src="{{asset('public/media/product/multiple/large/'.$image['product_images'])}}" alt="{{$image['product']['product_name']}}">
                </div>
                @endforeach
            </div>
        </div>