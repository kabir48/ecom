 @extends('layouts.app')
    @section('content')
    <style>
        input[type=radio] {
            width: auto;
            height: auto;
        }
        .product-form__item{
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    <div id="page-content">        
        <!--Body Container-->
        <!--Breadcrumbs-->
        <div class="breadcrumbs-wrapper">
        	<div class="container">
            	<div class="breadcrumbs"><a href="{{url('/')}}" title="Back to the home page">Home</a> <span aria-hidden="true">|</span> <span> <?php echo $sectionDetails['breadcumbs'];?></span></div>
            </div>
        </div>
        <!--End Breadcrumbs-->
        <div class="container">
            <div class="row">
				<!--Sidebar-->
            	@include('pages.section_sidebar')
				<!--End Sidebar-->
				<!--Main Content-->
				<div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col">
                    <div class="page-title"><h1> {{$sectionDetails['sectionDetails']['name']}}</h1></div>
                    <div class="category-banner">
						<img src="" data-src="" alt="{{$sectionDetails['sectionDetails']['name']}}">
					</div>
				
					
                    <!--Toolbar-->
                    <button type="button" class="btn btn-filter d-block d-md-none d-lg-none"> Product Filters</button>
                    <div class="toolbar">
                        <div class="filters-toolbar-wrapper">
                            <div class="row">
                                <div class="col-4 col-md-4 col-lg-4 filters-toolbar__item collection-view-as d-flex justify-content-start align-items-center">
                                    <a href="shop-left-sidebar.html" title="Grid View" class="change-view change-view--active">
                                        <i class="anm anm-th" aria-hidden="true"></i>
                                    </a>
                                    <a href="shop-list-view.html" title="List View" class="change-view">
                                        <i class="anm anm-th-list" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="col-4 col-md-4 col-lg-4 text-center filters-toolbar__item filters-toolbar__item--count d-flex justify-content-center align-items-center">
                                    <span class="filters-toolbar__product-count">Showing: ({{count($sectionProducts)}}) Results</span>
                                </div>
                                <div class="col-4 col-md-4 col-lg-4 text-right">
                                    <div class="filters-toolbar__item">
                                        <label for="SortBy" class="hidden">Sort</label>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Toolbar-->
                    <!--Product Grid-->
                    <div class="product-load-more">
                        <div class="grid-products grid--view-items ">
                            <div class="row filter_products">
                                @include('pages.ajax_section_listing')
                            </div>
                        </div>
                        <!--End Product Grid-->
                        <!--Load More Button-->
                        <div class="infinitpaginOuter">
                            <div class="infinitpagin">	
                                @if(isset($_GET['sort']) && !empty($_GET['sort']))
                                {{ $sectionProducts->appends(['sort' => $_GET['sort']])->links()}}
                                @else
                                {{$sectionProducts->links()}}
                                @endif
                            </div>
                        </div>
                        <!--End Load More Button-->
                    </div>
				</div>
				<!--End Main Content-->
			</div>
        </div><!--End Body Container-->
    </div><!--End Page Wrapper-->
    
   @endsection
    