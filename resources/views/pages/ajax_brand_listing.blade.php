<?php
  use App\Product;
  $currentDateTime = Carbon\Carbon::now();
?>

   @forelse($categoryPro as $data)
   <?php
        $total_stock=App\AttributeProduct::where('product_id',$data['id'])->sum('stock');
        $qty=App\Product::where('id',$data['id'])->where('status',1)->sum('product_quantity');
   ?>
        <div class="col-lg-4 col-md-4 col-sm-6 product_box quick_product_data @if($qty == 0 || $total_stock==0) product-disable @else   @endif">
               <?php
            $discounted_price=Product::getProductdiscount($data['id']);
            $groupProducts=array();
            if(!empty($data['group_code'])){
                $groupProducts=App\Product::select('id','product_color')->where(['group_code'=>$data['group_code'],'status'=>1])->get()->toArray();
                //dd($groupProducts);die;
            }
            $productSizes =App\AttributeProduct::select('weight_size')->where('product_id',$data['id'])->where('status',1)->where('stock','>',0)->get();
             
            $getMostPopular=App\ProductRating::with('product')->where('product_id',$data['id'])->get();
                $getOrderDetailStarCount=$getMostPopular->count();
                $sumRating=$getMostPopular->sum('rating');
                if($getOrderDetailStarCount>0){
                    $avg=round($sumRating/$getOrderDetailStarCount,2);
                    $roundAvg=round($sumRating/$getOrderDetailStarCount);
                }else{
                    $roundAvg=0;
            }
            
            $productCount=App\OrderDetail::where('product_id',$data['id'])->count();
        ?>
            <div class="image_box">
                @if($data['discount_date'] > $currentDateTime)
                <h4 class="product_tag">{{Str::ucfirst('on sale')}} ({{$productCount}})</h4>
                @else
                <?php
                   $isNewProduct=Product::isNewProduct($data['id']);
                ?>
                @if($isNewProduct =='Yes')
                <h4 class="product_tag">({{$isNewProduct}})</h4>
                @endif
                @endif
                <a href="{{url('product/details/'.$data['id'].'/'.$data['product_name'])}}">
                    <img src="{{ asset($data['image_one'])}}" alt="Product Image" class="product_image">
                </a>
                <button class="product-wish wish"><i class="fas fa-heart"></i></button>
                @if(count($productSizes)>0)
                <input class="form-control input-number qty_cart" type="hidden" value="1">
                <input type="hidden" value="{{$data['id']}}" class="product_id_cart">
                <button class="quick_add addToCartProduct">
                    <i class="far fa-plus"></i> 
                    Quick Add
                </button>
                @endif
            </div>
            <!-- Product Content Box -->
            
             <div class="product_meta_box">
                <ul class="product_size">
                    @foreach($groupProducts as $color)
                    <li class="radio_check" style="background: {{$color['product_color']}};" ><input type="radio" name="color_cart" class="color_cart" value="{{$color['product_color']}}" style="width: 20px;height: 20px;"></li>
                    @endforeach
                </ul>
                <a href="{{url('product/details/'.$data['id'].'/'.$data['product_name'])}}">
                    <h2 class="product_title">{{$data['product_name']}}</h2>
                </a>
                
                <a href="javascript:void(0)" title="Quick View" class="btn-icon quick-view-popup quick-view" data-bs-toggle="modal" data-bs-target="#eligibleModal" onclick="eligibleView(this.id)" id="{{ $data['id'] }}">
                    <i class="fa-solid fa-eye"></i>
                    <span class="tooltip-label">Quick View</span>
                </a>

                <h4 class="product_price"> @if($discounted_price>0)<span>{{$discounted_price}}</span>&nbsp;&nbsp;<del style="color:red">{{$data['selling_price']}}</del> @else <span>{{$data['selling_price']}}</span> @endif</h4>
               <ul class="" style="display:flex">
                    @foreach($productSizes as $size)
                    <li  class="li_weight_size">
                        @if($size->sum('stock') > 0)
                        <input type="radio" name="w_size_cart" class="size_cart" value="{{$size->weight_size}}" style="width: 20px;height: 20px;" >&nbsp;&nbsp; {{$size->weight_size}}
                        @else
                       <input type="radio"  class="weight_size_cart" value="{{$size->weight_size}}" disabled style="width: 20px;height: 20px;"> {{$size->weight_size}}
                        @endif
                    </li>
                    @endforeach
                </ul>
                <?php
                    $star=1;
                    while ($star <= $roundAvg) {?>
                    <i style="color:#b17714ab;" class="fa fa-star"></i>
                    <?php $star++;
                }?>
            </div>
        </div>
       @empty
       <h3>No Products</h3>
       @endforelse

     <!-- Modal for Eligible-->
        <div class="modal fade" id="eligibleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document" id="modal-eligible">
            <div class="modal-content">
              <div class="modal-body" id="eligibleView-modal-body">
              </div>

            </div>
          </div>
        </div>
        
        <script type="text/javascript">
            function eligibleView(id){
                if(!$('#modal-eligible').hasClass('modal-dialog')){
                    $('#modal-eligible').addClass('modal-dialog');
                }
                $('#eligibleView-modal-body').html(null);
                $('#eligibleModal').modal();
                $.get('{{  url('/cart/product/view/') }}/'+id, function(data){
                    $('#eligibleView-modal-body').html(data);
                });
            }
        </script>












  


