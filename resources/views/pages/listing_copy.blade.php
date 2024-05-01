 @extends('layouts.app')
 @section('content')
 <style>
    .radio_form .radio_info {
        border: 2px solid #0da487;
        padding: 10px;
    }
    
    .radio_form label{
        color: #0023ff;
        margin-bottom: 20px;
        font-size: 20px;
    }
</style>
 <link href="{{asset('public/frontend/assets/css/single.css')}}" rel="stylesheet" type="text/css" />
 <link href="{{asset('public/frontend/assets/css/kits-new-store.css')}}" rel="stylesheet" type="text/css" />
    <section class="inner-section single-banner" style="background: url({{asset('public/media/category/banner/'.$categoryDetails['cateDetails']['image'])}}) no-repeat center;">
        <div class="container">
            <h2><?php echo $categoryDetails['breadcumbs'];?></h2>
        </div>
    </section>
     <main style="margin-top:20px">
        <!--========== Content area ===========-->
        <div class="content_area">
            <div class="container">
                <div class="content_inner">
                    <!-- sidebar area -->
                 
                     @include('pages.sidebar_listing')
                    <!-- All products Area  -->
                    <div class="product_area">
                        <div class="porduct_wrapper">
                            <!-- Grid view system -->
                            <div class="grid_view_wrapper text-end">
                                <button class="d-md-none cbtn" id="showcategroybtn">
                                    Show Category 
                                    <i class="fal fa-angle-right"></i>
                                </button>
                                <ul>
                                    <li>
                                        <form name="sortProducts" id="sortProducts">
                                        <div class="filters-toolbar__item radio_form">
                                            <input type="hidden" name="url" value="{{$url}}" id="url">
                                            <label for="SortBy" class="hidden">Sort</label>
                                            <select name="sort" id="sort" class="filters-toolbar__input filters-toolbar__input--sort radio_info">
                                                <option value="title-ascending" selected="selected">Sort</option>
                                                <option value="product_latest" @if(isset($_GET['sort']) && $_GET['sort']=="product_latest") selected="" @endif>Latest Product</option>
                                                <option value="Product_name_a_z" @if(isset($_GET['sort']) && $_GET['sort']=="Product_name_a_z") selected="" @endif>Product_name_A_Z</option>
                                                <option value="Product_name_z_a"  @if(isset($_GET['sort']) && $_GET['sort']=="Product_name_z_a") selected="" @endif>Product_name_Z_A</option>
                                                <option value="prices_lowest"  @if(isset($_GET['sort']) && $_GET['sort']=="prices_lowest") selected="" @endif>Lowest Price first</option>
                                                <option value="price_highest"  @if(isset($_GET['sort']) && $_GET['sort']=="price_highest") selected="" @endif>Highest Price</option>
                                            </select>
                                            <input class="collection-header__default-sort" type="hidden" value="manual">
                                        </div>
                                    </form>
                                    </li>
                                </ul>
                            </div>

                            <div class="row product_inner filter_products">
                                @include('pages.ajax_produc_listing')
                            </div>

                            <!-- pagination -->
                            <div class="pagination">
                                <ul>
                                    @if(isset($_GET['sort']) && !empty($_GET['sort']))
                                    {{ $categoryPro->appends(['sort' => $_GET['sort']])->links()}}
                                    @else
                                    {{$categoryPro->links()}}
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @endsection
