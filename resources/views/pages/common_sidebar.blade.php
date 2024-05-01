<?php
    use App\Model\Admin\Category;
    $cateDetail=Category::cateDetail();
    //echo"<pre>";print_r($mainProduct);die;
    ?>
                   
                    <div class="sidebar-shop sidebar-left">
                       <div class="widget widget-filter">
                            @if(isset($page_name) && $page_name=="listing")
    						<div class="widget widget-cat">
    							<h2 class="widget-title">Category</h2>
    						     <p>Select your Category filter</p>
    							<ul>
                                    <?php
                                    $cats=DB::table('categories')->orderBy('id','ASC')->where('select_kinds','Quickee')->get();
                                    ?>
                                    @foreach($cats as $cate)
                                        <li style="margin: 10px 0px"><a href="{{url('/'.$cate->url)}}" class="category_id">{{$cate->category_name}} &nbsp;<span style="color:#0B7CBB">({{App\Product::where('category_id',$cate->id)->count()}})</span></a>
                                    </li>
                                    @endforeach
    							</ul>
    						</div>
                            @endif
					 </div>

                    <div class="widget widget-filter">
                         @if(isset($page_name) && $page_name=="listing")
    					<div class="widget widget-cat">
    							<h2 class="widget-title">Brand</h2>
    					         <p>Select your Brand filter</p>
    						<ul>
                                <?php
                                $brands=DB::table('brands')->orderBy('id','ASC')->get();
                                ?>
                                @foreach($brands as $brand)
                                  <li style="margin: 10px 0px"><a href="#" class="brand_id">{{$brand->brand_name}} &nbsp;<span style="color:##0B7CBB">({{App\Product::where('brand_id',$brand->id)->count()}})</span></a>
                                </li>
                                @endforeach
    						</ul>
    					</div>
                        @endif
    					<!-- End Category -->
    				</div>
					   <div class="widget widget-adv">
    						<h2 class="title-widget-adv">
    							<span>Week</span>
    							<strong>big sale</strong>
    						</h2>
						    <div class="wrap-item" data-navigation="false" data-pagination="true" data-itemscustom="[[0,1]]">
                               <?php
                                $products=DB::table('products')->orderBy('id','ASC')->where('select_type','Quickee')->where('hot_new',1)->limit(3)->get();
                                ?>
                                @foreach($products as $product)
                                <div class="item">
                                    <div class="item-widget-adv">
                                        <div class="adv-widget-thumb">
                                            <a href="{{url('/')}}"><img src="{{asset($product->image_one)}}" alt="" /></a>
                                        </div>
                                        <div class="adv-widget-info">
                                            <h3>{{$product->product_name}}</h3>
                                            <h2><span>from</span>{{$product->discount_price}}% off</h2>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
						    </div>
					    </div>
					</div>
              


