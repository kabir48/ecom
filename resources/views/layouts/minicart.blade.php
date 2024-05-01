    <?php
        use App\CartModal;
        use App\Product;
        $clientIP = \Request::ip();
        $getIp=geoip()->getLocation($clientIP=null);
    ?> 
        
       <div id="cart-drawer" class="block block-cart">
                    <a href="javascript:void(0);" class="close-cart" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></a>
                    <h4>Your cart (<span class="totalCartItems">{{totalCartIteams()}}</span> items)</h4>
                    <div class="minicart-content">
                        <ul class="clearfix">
                            <?php $total_price = 0; ?>
                            @foreach(userCartItems() as $item)
                             <?php
                                   $attrPrice=Product::getDiscountedAttrPrice($item['product_id'],$item['weight_size']);
                                   $discounted_price=Product::getProductdiscount($item['product_id']);
                                   $currencies=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->first();
                                    $currencieCount=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->count();
                                    
                                    if(getIp()->country !="Bangladesh"){
                                        if($currencieCount>0){
                                            $amount= $currencies->exchange_rate;
                                            $selling_price=$item['product']['selling_price'] * $amount;
                                            $discounte=$discounted_price * $amount;
                                            
                                        }else{
                                            $selling_price=$attrPrice['selling_price'];
                                            $discounte=$discounted_price;
                                        }
                                        
                                    }else{
                                        $selling_price=$item['product']['selling_price'];
                                        $discounte=$discounted_price;
                                    }    
                                    
                                    $name=preg_replace('/\s+/', '',$item['product']['product_name']);
                                ?>
                                     
                            
                            <li class="item clearfix">
                                <a class="product-image" href="{{url('product/details/'.$item['product']['id'].'/'.$name)}}">
                                    <img src="{{asset($item['product']['image_one'])}}" alt="{{$item['product']['product_name']}}" title="{{$item['product']['product_name']}}">
                                </a>
                                <div class="product-details">
                                    <a href="#" class="remove btnItemDelete remove_cart_product" data-cartid="{{$item['id']}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    <a class="product-title" href="cart-style1.html">{{$item['product']['product_name']}}</a>
                                    <div class="variant-cart">{{$item['weight_size']}}</div>
                                    <div class="wrapQtyBtn">
                                        <div class="qtyField">
                                            <input type="text"  name="quantity" value="{{$item['quantity']}}" class="qty qty_cart" readonly>
                                            <a class="qtyBtn minus btnItemUpdate qtyMinus" href="javascript:void(0);" data-cartid="{{$item['id']}}"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                            <a class="qtyBtn plus  btnItemUpdate qtyPlus" href="javascript:void(0);" data-cartid="{{$item['id']}}"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <div class="priceRow">
                                        <?php $total_price= $total_price + ($attrPrice['final_price']*$item['quantity']);?>
                                        <div class="product-price">
                                            <span class="money">{{getIp()->currency}} @if($discounted_price>0) <del style="color:red"> {{round($attrPrice['selling_price'],2)}}</del> <span>{{$discounted_price*$item['quantity']}}</span>  @else {{round($attrPrice['selling_price']*$item['quantity'],2)}} @endif</span>
                                        </div>
                                     </div>
                                  
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <?php
                        $currencies=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->first();
                        $currencieCount=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->count();
                         if(getIp()->country !="Bangladesh"){
                        if($currencieCount>0){
                            $amount= $currencies->exchange_rate;
                            
                            $sum=$total_price - Session::get('couponAmount');
                            $total= $sum * $amount;
                        }else{
                            $total=$total_price - Session::get('couponAmount');
                        }
                         }else{
                            $total=$total_price - Session::get('couponAmount'); 
                         }
                    ?>
                    
                    <div class="minicart-bottom">
                        <div class="subtotal">
                            <span>Total:</span>
                            <span class="product-price">{{getIp()->currency}} {{$total}}</span>
                        </div>
                        <a class="btn proceed-to-checkout" href="{{url('customer/user/checkout-pages')}}">Proceed to Checkout</a>
                        <a class="btn btn-secondary cart-btn" href="{{url('product/cart-page')}}">View Cart</a>
                    </div>
                </div>