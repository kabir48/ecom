<?php
$products_one=DB::table('most_populars')
->leftJoin('products','most_populars.product_id','products.id')
->select('product_id','product_name','product_name_bangla','image_one','image_two','selling_price','discount_price',DB::raw('count(*) as total'))
->groupBy('product_id','product_name','product_name_bangla','image_one','image_two','selling_price','discount_price')
->orderby('total','DESC')
->take(5)
->get()->toArray();
//dd($products_one);die;

if(Auth::check()){
$products_two=DB::table('most_populars')
->leftJoin('products','most_populars.product_id','products.id')
->where('user_id',Auth::user()->id)
->inRandomOrder()
->take(5)
->get();

}else{
$products_two=DB::table('most_populars')
->leftJoin('products','most_populars.product_id','products.id')
->inRandomOrder()
->take(5)
->get()->toArray();
}
?>
<!--Recently Product Slider-->
        <div class="related-product grid-products">
                <div class="section-header">
                    <h2 class="section-header__title text-center h2"><span>Recently Viewed Product</span></h2>
                    <p class="sub-heading">You can manage this section from store admin as describe in above section</p>
                </div>
                <div class="productPageSlider">
                    @foreach($products_one as $data)
                    <div class="col-12 item">
                        <!-- start product image -->
                        <div class="product-image">
                            <!-- start product image -->
                            <a href="{{url('product/details/'.$data->product_id.'/'.$data->product_name)}}" class="product-img">
                                <!-- image -->
                                <img class="primary blur-up lazyload" data-src="{{ asset($data->image_one)}}" src="{{ asset($data->image_one)}}" alt="" title="">
                                <!-- End image -->
                                <!-- Hover image -->
                                <img class="hover blur-up lazyload" data-src="{{ asset($data->image_two)}}" src="{{ asset($data->image_two)}}" alt="" title="">
                                <!-- End hover image -->
                            </a>
                            <!-- end product image -->

                            <!--Product Button-->
                            <div class="button-set style1">
                                <ul>
                                    <li>
                                        <!--Quick View Button-->
                                        <a href="javascript:void(0)" title="Quick View" class="btn-icon quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview" onclick="productview(this.id)" id="{{ $data->product_id }}">
                                            <i class="fa-solid fa-eye"></i>
                                            <span class="tooltip-label">Quick View</span>
                                        </a>
                                        <!--End Quick View Button-->
                                    </li>
                                    <li>
                                        <!--Wishlist Button-->
                                        <div class="wishlist-btn">
                                            <a class="btn-icon wishlist add-to-wishlist" href="my-wishlist.html">
                                                <i class="fa-solid fa-heart"></i>
                                                <span class="tooltip-label">Add To Wishlist</span>
                                            </a>
                                        </div>
                                        <!--End Wishlist Button-->
                                    </li>
                                </ul>
                            </div>
                            <!--End Product Button-->
                        </div>
                        <!-- end product image -->
                        <!--start product details -->
                        <div class="product-details text-center">
                            <!-- product name -->
                            <div class="product-name">
                                <a href="{{url('product/details/'.$data->product_id.'/'.$data->product_name)}}">
                                    @if(session()->get('lang') == 'english'){{$data->product_name}}
                                    @elseif (session()->get('lang') == 'bangla')
                                    {{$data->product_name_bangla}}
                                    @else
                                    {{ $data->product_name}}
                                    @endif

                                </a>
                            </div>
                            <!-- End product name -->
                            <!-- product price -->
                            <div class="product-price">
                             <?php
                                $discounted_price=App\Product::getProductdiscount($data->product_id);
                              ?>
                              @if($discounted_price>0)
                              <span>${{$discounted_price}}</span> <del style="color:red">${{$data->selling_price }}</del>
                              @else
                              <span class="price">TK.{{$data->selling_price}}</span>
                              @endif
                            </div>
                            <!-- End product price -->
                        </div>
                        <!-- End product details -->
                    </div>
                    @endforeach

                    @foreach($products_two as $data)
                    <div class="col-12 item">
                        <!-- start product image -->
                        <div class="product-image">
                            <!-- start product image -->
                            <a href="{{url('product/details/'.$data->product_id.'/'.$data->product_name)}}" class="product-img">
                                <!-- image -->
                                <img class="primary blur-up lazyload" data-src="{{ asset($data->image_one)}}" src="{{ asset($data->image_one)}}" alt="" title="">
                                <!-- End image -->
                                <!-- Hover image -->
                                <img class="hover blur-up lazyload" data-src="{{ asset($data->image_two)}}" src="{{ asset($data->image_two)}}" alt="" title="">
                                <!-- End hover image -->
                            </a>
                            <!-- end product image -->

                            <!--Product Button-->
                            <div class="button-set style1">
                                <ul>
                                    <li>
                                        <!--Quick View Button-->
                                        <a href="javascript:void(0)" title="Quick View" class="btn-icon quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview" onclick="productview(this.id)" id="{{ $data->product_id }}">
                                            <i class="fa-solid fa-eye"></i>
                                            <span class="tooltip-label">Quick View</span>
                                        </a>
                                        <!--End Quick View Button-->
                                    </li>
                                    <li>
                                        <!--Wishlist Button-->
                                        <div class="wishlist-btn">
                                            <a class="btn-icon wishlist add-to-wishlist" href="my-wishlist.html">
                                                <i class="fa-solid fa-heart"></i>
                                                <span class="tooltip-label">Add To Wishlist</span>
                                            </a>
                                        </div>
                                        <!--End Wishlist Button-->
                                    </li>
                                </ul>
                            </div>
                            <!--End Product Button-->
                        </div>
                        <!-- end product image -->
                        <!--start product details -->
                        <div class="product-details text-center">
                            <!-- product name -->
                            <div class="product-name">
                                <a href="{{url('product/details/'.$data->product_id.'/'.$data->product_name)}}">
                                    @if(session()->get('lang') == 'english'){{$data->product_name}}
                                    @elseif (session()->get('lang') == 'bangla')
                                    {{$data->product_name_bangla}}
                                    @else
                                    {{ $data->product_name}}
                                    @endif

                                </a>
                            </div>
                            <!-- End product name -->
                            <!-- product price -->
                            <div class="product-price">
                             <?php
                                $discounted_price=App\Product::getProductdiscount($data->product_id);
                              ?>
                              @if($discounted_price>0)
                              <span>${{$discounted_price}}</span> <del style="color:red">${{$data->selling_price }}</del>
                              @else
                              <span class="price">TK.{{$data->selling_price}}</span>
                              @endif
                            </div>
                            <!-- End product price -->
                        </div>
                        <!-- End product details -->
                    </div>
                    @endforeach


            </div>
        </div>
        <!--End Recently Product Slider-->
