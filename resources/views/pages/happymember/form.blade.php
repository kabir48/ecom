@extends('layouts.app')
@section('content')

<style>
    .pcb-container {
    border: 1px solid #C3C8EB;
    max-width: 950px;
    margin: 20px auto 80px;
    background: #fff;
}

.pcb-head {
    background: #F9F9FC;
    border-bottom: 1px solid #C3C8EB;
    padding: 20px;
    display: flex;
}

.pcb-head h4 {
    margin: 0;
    font-size: 18px;
    max-width: 250px;
    color: #666666;
}

.pcb-head .title {
    flex: 0 0 auto;
}

.pcb-head .startech-logo {
    flex: 0 0 auto;
    display: flex;
    justify-content: center;
}

.pcb-head .startech-logo img {
    height: 43px;
    margin-left: 10px;
}

.pcb-head .actions {
    flex: 1 1 auto;
    padding-top: 0;
}

.pcb-head .actions .all-actions {
    display: flex;
    float: right;
}

.pcb-head .actions .action {
    display: inline-block;
    text-align: center;
    padding: 0 15px;
    background: none;
    border: none;
    color: #EF4A23;
    height: auto;
    line-height: normal;
    font-weight: normal;
    border-right: 1px solid rgba(0, 0, 0, 0.1);
    outline: none;
}

.pcb-head .actions .action:hover {
    box-shadow: none;
}

.pcb-head .action .action-text {
    display: block;
    white-space: nowrap;
    font-size: 12px;
    color: #666666;
    padding-top: 2px;
    min-width: 40px;
}

.pcb-head .actions .action:hover .action-text {
    color: #111;
}

.pcb-head .actions .pcb-button {
    margin-left: 20px;
}

.pcb-inner-content {
    margin: 25px auto;
    max-width: 800px;
}

.pcb-top-content {
    display: flex;
    margin: 0 0 30px;
}

.pcb-top-content > div {
    flex: 1 1 50%;
}

.pcb-top-content h5 {
    font-size: 15px;
    color: #3749BB;
    margin: 8px 0 12px;
}

.pcb-container .alert {
    margin: 10px;
}

.pcb-top-content .checkbox-inline {
    color: #666666;
    font-size: 13px;
}
.pcb-top-content .total-amount {
    border: 1px solid #EF4A23;
    float: right;
    padding: 8px;
    min-width: 170px;
    border-radius: 7px;
    text-align: center;
    color: #111;
    box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.1);
}

.pcb-top-content .total-amount .amount {
    font-size: 18px;
    font-weight: bold;
    display: block;
    color: #EF4A23;
    padding-bottom: 6px;
}

.pcb-top-content .total-amount .items {
    font-size: 11px;
    text-transform: uppercase;
    font-weight: bold;
}

.pcb-content .content-label {
    background: #3b7cbf;
    color: #fff;
    line-height: 20px;
    padding: 0 10px;
    font-size: 12px;
    font-weight: bold;
}

.pcb-content .c-item {
    display: flex;
    padding: 15px 10px;

}

.pcb-content .c-item .img {
    background: rgba(55, 73, 187, 0.1);
    border-radius: 3px;
    overflow: hidden;
    width: 60px;
    height: 60px;
    text-align: center;
    flex: 0 0 60px;
}

.pcb-content .c-item .img svg {
    margin-top: 14px;
}

.pcb-content .c-item .img img {
    width: 60px;
}

.pcb-content .c-item .img-ico {
    background: url(../images/cpu.svg) no-repeat center;
    width: 60px;
    height: 60px;
    display: block;
}


.pcb-content .c-item .details {
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 0 50px 0 20px;
}

.c-item .details .component-name {
    font-size: 12px;
    color: #3749BB;
    font-weight: bold;
    padding-bottom: 5px;
}

.c-item.blank .details .component-name {
    color: #666666;
}

.c-item .details .component-name .mark {
    margin-left: 5px;
    background: #666666;
    color: #fff;
    padding: 1px 4px;
    border-radius: 2px;
    font-weight: normal;
}

.c-item .details .product-name {
    line-height: 20px;
}

.c-item .item-price {
    flex: 0 0 100px;
    margin: 10px 0;
    padding-right: 20px;
    display: flex;
    align-items: center;
    border-right: 1px solid #eee;
}

.c-item .item-price .price {
    flex: 1 1 auto;
    font-size: 17px;
    font-weight: bold;
    text-align: right;
}

.c-item .actions {
    flex: 0 0 110px;
    text-align: right;
    padding-top: 8px;
}




.c-item.blank .item-price:after {
    content: "";
    display: block;
    min-height: 12px;
    background: #F2F3F4;
    width: 100%;
}

.c-item .actions .action-items {
    text-align: center;
    padding: 8px 0 0 20px;
}

.c-item .actions .action-items a {
    color: #666666;
}

.c-item .actions .action-items a:hover {
    color: #EF4A23;
}

/*----------------------------------------------- choose products --------------------------------------*/
.top-bar .actions {
    display: flex;
}

.top-bar .search {
    background: #f1f3f5;
    border-radius: 3px;
    position: relative;
    padding: 1px;
    display: flex;
}

.top-bar .search input {
    float: left;
    height: 28px;
    border: none;
    padding: 0 10px;
    background: none;
    outline: none;
}

.top-bar .search  i {
    line-height: 30px;
    font-size: 20px;
    cursor: pointer;
}

.product-thumb {
    display: flex;
    margin-bottom: 10px;
}

.product-thumb .img-holder {
    flex: 0 0 200px;
    padding: 10px;
    margin: 0;
    text-align: center;
}

.product-thumb .product-info {
    padding: 20px;
    flex: 1 1 auto;
    display: flex;
    align-items: center;
}

.product-thumb .product-content-blcok {
    flex: 1 1 auto;
}

.product-thumb .product-info h4 {
    margin-bottom: 10px;
    font-weight: 600;
    font-size: 14px;
    position: relative;
    height: auto;
}

.product-thumb .product-name a {
    color: #111;
}

.product-thumb .short-description {
    padding: 0 0 0 14px;
    flex: 1 1 auto;
    margin-bottom: 5px;
}

.product-thumb .short-description li {
    font-size: 13px;
    padding: 5px 0;
    color: #666666;
    position: relative;
    line-height: 16px;
}

.product-thumb .actions {
    flex: 0 0 95px;
}

.product-thumb .actions .price {
    font-size: 20px;
    text-align: center;
}

.product-thumb .btn {
    display: block;
    min-width: 100px;
    text-align: center;
    margin-top: 15px;
}

.pc-builder-choose-content .pagination-row {
    padding: 10px 0;
    margin: 20px 0 50px;
    border-radius: 5px;
    background: #fff;
}

.pagination-row .number-of-items {
    line-height: 34px;
}

.pc-builder-choose-content .tool-btn i {
    line-height: 30px;
    height: 30px;
    margin-right: 10px;
    color: #111;
}
@media screen and (max-width: 275px) {
    .c-item .actions {
    flex: 0 0 50px !important;
    text-align: right !important;
    padding-top: 0px !important;
}
.s-hide span{
    display: none;
}

}
@media screen and (max-width:300px) {
    .c-item .actions {
    flex: 0 0 50px !important;
    text-align: right !important;
    padding-top: 0px !important;
}
.s-hide span{
    display: none;
}

}
@media screen and (max-width: 991px) {
    .pc-builder-choose-content #content {
        padding-left: 15px;
    }
    .pcb-container {
        margin-bottom: 20px;
        box-shadow: none;
        margin-top: 0;
    }
    .pcb-inner-content {
        margin: 0;
    }

    .pcb-head {
        padding: 10px;
    }
    .pcb-head .startech-logo img {
        height: 38px;
        margin-left: 0;
    }
    .pcb-head .actions {
        display: flex;
        justify-content: flex-end;
    }
    .pcb-head .action .action-text {
        display: none;
    }
    .pcb-head .actions .action {
        padding: 0 8px;
        margin-right: 0;
        display: flex;
        align-items: center;
        height: 42px;
        width: auto;
        float: left;
    }
    .pcb-head .actions .pcb-button {
        margin-left: 10px;
        padding: 0 10px;
        float: right;
        white-space: nowrap;
    }
    .pcb-top-content {
        margin-bottom: 0;
    }
    .pcb-top-content > div {
        padding: 15px 10px;
        flex: 1 1 auto;
    }
    .pcb-top-content > div.right {
        flex: 0 0 125px;
        padding-left: 0;
    }
    .pcb-top-content .total-amount {
        float: none;
        border: none;
        box-shadow: none;
        padding: 0;
        text-align: right;
        min-width: 100px;
        border-left: 1px solid #eee;
    }
    .pcb-content .c-item .details {
        flex: 1 1 auto;
        padding-right: 0px;
    }
    .pcb-content .c-item.selected .details {
        border-right: none;
        max-width: calc(100% - 160px);
    }
    .pcb-content .c-item {
        padding: 10px;
        position: relative;
    }
    .pcb-content .c-item.selected {
        flex-wrap: wrap;
    }
    .c-item.selected .details .component-name {
        padding: 5px 0 10px;
    }
    .c-item .component-name .mark,
    .c-item.blank .item-price {
        display: none;
    }
    .c-item.selected .item-price {
        padding-right: 0;
        border-right: none;
        margin: 28px 0 0;
        align-items: flex-start;
    }
    .c-item.selected .actions {
        position: absolute;
        right: 7px;
        top: 7px;
        padding: 0;
    }
    .c-item.selected .action-items {
        padding: 0;
    }
    .c-item.selected .action-items a {
        display: inline-block;
        padding: 3px;
    }

    .c-item .item-price .price {
        padding-top: 2px;
    }

    .product-thumb .product-info {
        display: block;
        padding: 0 20px 20px;
    }
    .product-thumb .product-content-blcok {
        padding-right: 0;
    }
    .product-thumb .actions {
        padding: 10px 0 0;
        text-align: left;
    }

}

</style>

    <section class="build-your-pc">
    <div class="container">
        <div class="pcb-container">
                <div class="pcb-head">
                <div class="startech-logo">
                    <img class="logo" src="{{ url('public/media/logo/'.$sitesetting->logo) }}" alt="Logo">
                </div>
                <div class="actions">
                    <div class="all-actions">
                        <a class="action m-hide s-hide" href="#">
                            <span>Make Request For The Voucher Item</span>
                        </a>

                        <a class="action m-hide" target="_blank" href="{{ url('user/happy-member-client-form-print') }}">
                            <i class="fa fa-print" aria-hidden="true"></i>
                            <span class="action-text">Print</span>
                        </a>

                    </div>
                </div>
            </div>

           <?php


            $cateA=DB::table('categories')->where('select_kinds','Quickee')->where('parent_id',0)->limit(1)->latest()->pluck('id');
            //dd($cateA);die;
            $cateB=DB::table('categories')->where('select_kinds','Quickee')->where('parent_id',0)->limit(1)->skip(1)->latest()->pluck('id');
            $cateC=DB::table('categories')->where('select_kinds','Quickee')->where('parent_id',0)->limit(1)->skip(2)->latest()->pluck('id');
            $cateD=DB::table('categories')->where('select_kinds','Quickee')->where('parent_id',0)->limit(1)->skip(3)->latest()->pluck('id');
            $cateE=DB::table('categories')->where('select_kinds','Quickee')->where('parent_id',0)->limit(1)->skip(4)->latest()->pluck('id');
            $cateF=DB::table('categories')->where('select_kinds','Quickee')->where('parent_id',0)->limit(1)->skip(5)->latest()->pluck('id');
            $cateG=DB::table('categories')->where('select_kinds','Quickee')->where('parent_id',0)->limit(1)->skip(6)->latest()->pluck('id');
            $cateH=DB::table('categories')->where('select_kinds','Quickee')->where('parent_id',0)->limit(1)->skip(7)->latest()->pluck('id');
            //dd($cate);die;

            $cateisProA=DB::table('categories')->where('select_kinds','Quickee')->where('parent_id',0)->latest()->limit(1)->first();
            $cateisProB=DB::table('categories')->where('select_kinds','Quickee')->where('parent_id',0)->latest()->limit(1)->skip(1)->first();
            $cateisProC=DB::table('categories')->where('select_kinds','Quickee')->where('parent_id',0)->latest()->limit(1)->skip(2)->first();
            $cateisProD=DB::table('categories')->where('select_kinds','Quickee')->where('parent_id',0)->latest()->limit(1)->skip(3)->first();
            $cateisProE=DB::table('categories')->where('select_kinds','Quickee')->where('parent_id',0)->latest()->limit(1)->skip(4)->first();
            $cateisProF=DB::table('categories')->where('select_kinds','Quickee')->where('parent_id',0)->latest()->limit(1)->skip(5)->first();
            $cateisProG=DB::table('categories')->where('select_kinds','Quickee')->where('parent_id',0)->latest()->limit(1)->skip(6)->first();
            $cateisProH=DB::table('categories')->where('select_kinds','Quickee')->where('parent_id',0)->latest()->limit(1)->skip(7)->first();
            //dd($cateisProE);die;

            $productCateA=App\Product::select('id','product_name','selling_price','image_one','category_id','discount_price')->whereIn('category_id',$cateA)->where('status',1)->where('select_type','Quickee')->get()->toArray();

             $productCateB=App\Product::select('id','product_name','selling_price','image_one','discount_price')->whereIn('category_id',$cateB)->where('status',1)->where('select_type','Quickee')->get()->toArray();
             $productCateC=App\Product::select('id','product_name','selling_price','image_one','discount_price')->whereIn('category_id',$cateC)->where('status',1)->where('select_type','Quickee')->get()->toArray();
             $productCateD=App\Product::select('id','product_name','selling_price','image_one','discount_price')->whereIn('category_id',$cateD)->where('status',1)->where('select_type','Quickee')->get()->toArray();
             $productCateE=App\Product::select('id','product_name','selling_price','image_one','discount_price')->whereIn('category_id',$cateE)->where('status',1)->where('select_type','Quickee')->get()->toArray();
             $productCateF=App\Product::select('id','product_name','selling_price','image_one','discount_price')->whereIn('category_id',$cateF)->where('status',1)->where('select_type','Quickee')->get()->toArray();
             $productCateG=App\Product::select('id','product_name','selling_price','image_one','discount_price')->whereIn('category_id',$cateG)->where('status',1)->where('select_type','Quickee')->get()->toArray();
             $productCateH=App\Product::select('id','product_name','selling_price','image_one','discount_price')->whereIn('category_id',$cateH)->where('status',1)->where('select_type','Quickee')->get()->toArray();
            //dd($productCateD);die;
           ?>

            <div class="pcb-inner-content">
                <div class="pcb-content">
                   <div class="content-label">Products Item</div>
                      <form action="{{ url('user/happy-member-client-form') }}" method="post">
                        @csrf
                        @if($cateisProA->id)
                        <div class="c-item blank">
                            <div class="details">
                                <div class="component-name">
                                     <select class="form-control getPrice" name="product_one">
                                        <option selected>{{ $cateisProA->category_name??"No Category"}}</option>
                                        @foreach($productCateA as $row)
                                        <?php
                                            $discounted_price=App\Product::getProductdiscount($row['id']);
                                        ?>
                                         <option value="{{$row['product_name']}} (@if($discounted_price>0){{'TK.'.$discounted_price}}@else {{'TK.'.$row['selling_price']}}@endif)">{{$row['product_name']}} (@if($discounted_price>0){{'TK.'.$discounted_price}}@else {{'TK.'.$row['selling_price']}}@endif)</option>
                                        @endforeach
                                    </select>
                                  </div>
                                 <div class="product-name"></div>
                            </div>
                            <div class="item-price"></div>
                            <div class="actions">
                                <input class="form-control" type="number" name="quantity_one"  placeholder="Quantity">
                            </div>
                        </div>
                        @endif
                        @if(isset($cateisProB->id))
                         <div class="c-item blank">
                            <div class="details">
                                <div class="component-name">
                                     <select class="form-control getPrice" name="product_two" id="getPrice">
                                        <option selected>{{ $cateisProB->category_name??"No Category"}}</option>
                                        @foreach($productCateB as $row)
                                       <?php
                                            $discounted_price=App\Product::getProductdiscount($row['id']);
                                        ?>
                                        <option value="{{$row['product_name']}} (@if($discounted_price>0){{'TK.'.$discounted_price}}@else {{'TK.'.$row['selling_price']}}@endif)">{{$row['product_name']}} (@if($discounted_price>0){{'TK.'.$discounted_price}}@else {{'TK.'.$row['selling_price']}}@endif)</option>
                                        @endforeach
                                    </select>
                                  </div>
                                <div class="product-name getPriceProduct"><label for=""> <span class=""></span></label></div>
                            </div>
                            <div class="item-price"></div>
                            <div class="actions">
                                 <input class="form-control" type="number" name="quantity_two"  placeholder="Quantity">
                            </div>
                        </div>
                        @endif
                        @if($cateisProC->id)
                          <div class="c-item blank">
                            <div class="details">
                                <div class="component-name">
                                     <select class="form-control getPrice" name="product_three" id="getPrice">
                                        <option selected>{{$cateisProC->category_name??"No Category"}}</option>
                                        @foreach($productCateC as $row)
                                        <?php
                                            $discounted_price=App\Product::getProductdiscount($row['id']);
                                        ?>
                                         <option value="{{$row['product_name']}} (@if($discounted_price>0){{'TK.'.$discounted_price}}@else {{'TK.'.$row['selling_price']}}@endif)">{{$row['product_name']}} (@if($discounted_price>0){{'TK.'.$discounted_price}}@else {{'TK.'.$row['selling_price']}}@endif)</option>
                                        @endforeach
                                    </select>
                                  </div>
                                <div class="product-name getPriceProduct"><label for=""> <span class=""></span></label></div>
                            </div>
                            <div class="item-price"></div>
                            <div class="actions">
                                <input class="form-control" type="number" name="quantity_three"  placeholder="Quantity">
                            </div>
                        </div>
                        @endif

                        @if(isset($cateisProD->id))
                         <div class="c-item blank">
                            <div class="details">
                                <div class="component-name">
                                     <select class="form-control getPrice" name="product_four" id="getPrice">
                                        <option selected>{{$cateisProD->category_name??"No Category "}}</option>
                                        @foreach($productCateD as $row)
                                       <?php
                                            $discounted_price=App\Product::getProductdiscount($row['id']);
                                        ?>
                                         <option value="{{$row['product_name']}} (@if($discounted_price>0){{'TK.'.$discounted_price}}@else {{'TK.'.$row['selling_price']}}@endif)">{{$row['product_name']}} (@if($discounted_price>0){{'TK.'.$discounted_price}}@else {{'TK.'.$row['selling_price']}}@endif)</option>
                                        @endforeach
                                    </select>
                                  </div>
                                <div class="product-name getPriceProduct"><label for=""> <span class=""></span></label></div>
                            </div>
                            <div class="item-price"></div>
                            <div class="actions">
                                <input class="form-control" type="number" name="quantity_four" placeholder="Quantity">
                            </div>
                        </div>
                        @endif

                        @if(isset($cateisProE->id))
                        <div class="c-item blank">
                            <div class="details">
                                <div class="component-name">
                                     <select class="form-control getPrice" name="product_five" id="getPrice">
                                        <option selected>{{$cateisProE->category_name??"No Category"}}</option>
                                        @foreach($productCateE as $row)
                                       <?php
                                            $discounted_price=App\Product::getProductdiscount($row['id']);
                                        ?>
                                         <option value="{{$row['product_name']}} (@if($discounted_price>0){{'TK.'.$discounted_price}}@else {{'TK.'.$row['selling_price']}}@endif)">{{$row['product_name']}} (@if($discounted_price>0){{'TK.'.$discounted_price}}@else {{'TK.'.$row['selling_price']}}@endif)</option>
                                        @endforeach
                                    </select>
                                  </div>
                                <div class="product-name getPriceProduct"><label for=""> <span class=""></span></label></div>
                            </div>
                            <div class="item-price"></div>
                            <div class="actions">
                                <input class="form-control" type="number" name="quantity_five" placeholder="Quantity">
                            </div>
                        </div>
                        @endif
                        @if(isset($cateisProF->id))
                         <div class="c-item blank">
                            <div class="details">
                                <div class="component-name">
                                     <select class="form-control getPrice" name="product_six" id="getPrice">
                                        <option selected>{{$cateisProF->category_name??"No category"}}</option>
                                        @foreach($productCateF as $row)
                                         <?php
                                            $discounted_price=App\Product::getProductdiscount($row['id']);
                                        ?>
                                        <option value="{{$row['product_name']}} (@if($discounted_price>0){{'TK.'.$discounted_price}}@else {{'TK.'.$row['selling_price']}}@endif)">{{$row['product_name']}} (@if($discounted_price>0){{'TK.'.$discounted_price}}@else {{'TK.'.$row['selling_price']}}@endif)</option>
                                        @endforeach
                                    </select>
                                  </div>
                                <div class="product-name getPriceProduct"><label for=""> <span class=""></span></label></div>
                            </div>
                            <div class="item-price"></div>
                            <div class="actions">
                                <input class="form-control" type="number" name="quantity_six" placeholder="Quantity">
                            </div>
                        </div>
                        @endif

                        @if(isset($cateisProG->id))
                         <div class="c-item blank">
                            <div class="details">
                                <div class="component-name">
                                     <select class="form-control getPrice" name="product_seven" id="getPrice">
                                        <option selected>{{$cateisProG->category_name??"no category"}}</option>
                                        @foreach($productCateG as $row)
                                         <?php
                                            $discounted_price=App\Product::getProductdiscount($row['id']);
                                        ?>
                                        <option value="{{$row['product_name']}} (@if($discounted_price>0){{'TK.'.$discounted_price}}@else {{'TK.'.$row['selling_price']}}@endif)">{{$row['product_name']}} (@if($discounted_price>0){{'TK.'.$discounted_price}}@else {{'TK.'.$row['selling_price']}}@endif)</option>
                                        @endforeach
                                    </select>
                                  </div>
                                <div class="product-name getPriceProduct"><label for=""> <span class=""></span></label></div>
                            </div>
                            <div class="item-price"></div>
                            <div class="actions">
                                <input class="form-control" type="number" name="quantity_seven" placeholder="Quantity">
                            </div>
                        </div>
                        @endif
                        @if(isset($cateisProH->id))
                         <div class="c-item blank">
                            <div class="details">
                                <div class="component-name">
                                     <select class="form-control getPrice" name="product_eight" id="getPrice">
                                        <option selected>{{$cateisProH->category_name??"No Category"}}</option>
                                        @foreach($productCateH as $row)
                                         <?php
                                            $discounted_price=App\Product::getProductdiscount($row['id']);
                                        ?>
                                        <option value="{{$row['product_name']}} (@if($discounted_price>0){{'TK.'.$discounted_price}}@else {{'TK.'.$row['selling_price']}}@endif)">{{$row['product_name']}} (@if($discounted_price>0){{'TK.'.$discounted_price}}@else {{'TK.'.$row['selling_price']}}@endif)</option>
                                        @endforeach
                                    </select>
                                  </div>
                                <div class="product-name getPriceProduct"><label for=""> <span class=""></span></label></div>
                            </div>
                            <div class="item-price"></div>
                            <div class="actions">
                                <input class="form-control" type="number" name="quantity_eight" placeholder="Quantity">
                            </div>
                        </div>
                        @endif

                        <button class="bt-link bt-blue bt-radius bt-loadmore bt-style24" type="submit">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</section>
	<!-- End Content -->
@endsection









