<?php
    use App\Model\Admin\Category;
    use App\ProductFilter;
    $productFilters=ProductFilter::productFilters();
?>

    <?php
        $getBrandSizes=ProductFilter::getBrandSizes($url);
        $getbrandColors=ProductFilter::getbrandColors($url);
    ?> 
    
    <div class="sidebar_tags" style="margin-top:120px">
            @if(isset($page_name) && $page_name=="listing")
            <!--Categories-->
            <div class="sidebar_widget filterBox filter-widget size-swacthes">
                <div class="widget-title"><h2>Related Category</h2></div>
                <div class="filter-color swacth-list">
                    <ul>
                        <?php
                           $getParentCategory=Category::with('subcategories')->where('parent_id',0)->take(5)->latest()->get()->toArray();
                        ?>
                        @if(count($getParentCategory)>0)
                        @foreach ($getParentCategory as $parentCat)
                        
                        <li>
                            <span class="swacth-btn"><a href="{{url('category-products/'.$parentCat['url'])}}">{{$parentCat['category_name']}} ({{App\Product::where('category_id',$parentCat['id'])->count()}})</a></span>
                            <ul>
                                @if(count($parentCat['subcategories'])>0)
                                @foreach($parentCat['subcategories'] as $catB)
                                @if(App\Product::where('category_id',$catB['id'])->count()>0)
                                <li>
                                    <span class="swacth-btn"><a href="{{url('category-products/'.$catB['url'])}}">{{$catB['category_name']}} ({{App\Product::where('category_id',$catB['id'])->count()}})</a></span>
                                </li>
                                @endif
                                @endforeach
                                @endif
                            </ul>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <!--Size Filter-->
            <div class="sidebar_widget filterBox filter-widget size-swacthes">
                <div class="widget-title"><h2>Product Brand</h2></div>
                <div class="filter-color swacth-list">
                    <?php
                        $getBrands=App\Model\Admin\Brand::where('url','!=',$url)->get();
                    ?>
                    <ul>
                        @foreach($getBrands as $key=>$brand)
                        <li>
					       <span class="swacth-btn"><a href="{{url('brand-products/'.$brand['url'])}}">{{$brand['brand_name']}}</a></span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
            <!--Size Filter-->
            <div class="sidebar_widget filterBox filter-widget size-swacthes">
                <div class="widget-title"><h2>Product Size</h2></div>
                <div class="filter-color swacth-list">
                    <ul>
                        @foreach($getBrandSizes as $key=>$size)
                        <li>
                            <input class="size" type="checkbox" name="size[]" id="size{{$key}}" value="{{$size}}">
					        <label for="size{{$key}}"><span>{{$size}}</span></label>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!--End Price Filter-->
           
            <!--Color Swatches-->
            <div class="sidebar_widget filterBox filter-widget">
                <div class="widget-title"><h2>Product Color</h2></div>
                <div class="filter-color swacth-list clearfix">
                    <ul>
                        @forelse($getbrandColors as $key=>$data)
                        <?php
                            $getColorName=App\Color::where('id',$data)->first()->toArray();
                        ?>
                        <li>
                          <input class="family_color" type="checkbox" name="family_color[]" id="family_color{{$key}}" value="{{$data}}">
					      <label for="family_color{{$key}}"><span style="background-color:{{$getColorName['name']}}">{{$getColorName['name']}}</span></label>
                        </li>
                        @empty
                        <span class="tooltip-label">No Color</span>
                        @endforelse
                    </ul>
                </div>
            </div>
            <!--End Color Swatches-->
            
            <!--====Prices Filter====-->
            <div class="sidebar_widget filterBox filter-widget size-swacthes">
                <div class="widget-title"><h2>Product Prices</h2></div>
                <div class="filter-color swacth-list">
                    <ul>
                        <?php $prices=array('0-500','501-1000','1001-2000','2001-3000','3001-4000');?>
                        @foreach($prices as $key=>$price)
                        <li>
                            <input class="price" type="checkbox" name="price[]" id="price{{$key}}" value="{{$price}}">
					        <label for="price{{$key}}"><span>$.{{$price}}</span></label>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!--End Price Filter-->
          
            <!--End Brand-->
            @endif
        </div>