<?php
    use App\ProductFilter;
    $productFilters=ProductFilter::productFilters();
?>
<script>
     $(document).ready(function() {
        $("#sort").on('change', function() {
            var sort = $(this).val();
            var brand_id = get_filter('brand_id');
            var size = get_filter('size');
            var category_id = get_filter('category_id');
            var price = get_filter('price');
            var family_color = get_filter('family_color');
            var url = $("#url").val();
            @foreach($productFilters as $filters)
            var {{$filters['filter_column']}} = get_filter('{{$filters['filter_column']}}');
            @endforeach
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: "get",
                data: {  
                    @foreach($productFilters as $filters)
                    {{$filters['filter_column']}}:{{$filters['filter_column']}},
                    @endforeach
                    family_color:family_color, brand_id: brand_id,  category_id:category_id,sort: sort, url: url,size: size,price: price },
                success: function(data) {
                    $('.filter_products').html(data);
                    $(".product-load-more .item").css("display", "block");
                }

            });
        });
    });
    
    // =====Filter by size====//
     $(document).ready(function() {
        $(".size").on('change', function() {
            var sort = $("#sort option:selected").val();
            var size = get_filter('size');
            var brand_id = get_filter('brand_id');
            var price = get_filter('price');
            var category_id = get_filter('category_id');
            var family_color = get_filter('family_color');
            var url = $("#url").val();
            @foreach($productFilters as $filters)
            var {{$filters['filter_column']}} = get_filter('{{$filters['filter_column']}}');
            @endforeach
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: "get",
                data: {  
                    @foreach($productFilters as $filters)
                    {{$filters['filter_column']}}:{{$filters['filter_column']}},
                    @endforeach
                    family_color:family_color, brand_id: brand_id,category_id:category_id,sort: sort, url: url,size: size,price: price},
                success: function(data) {
                    $('.filter_products').html(data);
                    $(".product-load-more .item").css("display", "block");
                }

            });
        });
    }); 
    
    // =====Filter by size====//
     $(document).ready(function() {
        $(".brand_id").on('change', function() {
            var sort = $("#sort option:selected").val();
            var size = get_filter('size');
            var brand_id = get_filter('brand_id');
            var price = get_filter('price');
            var category_id = get_filter('category_id');
            var family_color = get_filter('family_color');
            var url = $("#url").val();
            @foreach($productFilters as $filters)
            var {{$filters['filter_column']}} = get_filter('{{$filters['filter_column']}}');
            @endforeach
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: "get",
                data: {  
                    @foreach($productFilters as $filters)
                    {{$filters['filter_column']}}:{{$filters['filter_column']}},
                    @endforeach
                    family_color:family_color, brand_id: brand_id,category_id:category_id,sort: sort, url: url,size: size,price: price},
                success: function(data) {
                    $('.filter_products').html(data);
                    $(".product-load-more .item").css("display", "block");
                }

            });
        });
    });
    
    // =====Filter by Color family====//
     $(document).ready(function() {
        $(".family_color").on('change', function() {
            var sort = $("#sort option:selected").val();
            var brand_id = get_filter('brand_id');
            var size = get_filter('size');
            var price = get_filter('price');
            var category_id = get_filter('category_id');
            var family_color = get_filter('family_color');
            var url = $("#url").val();
            @foreach($productFilters as $filters)
            var {{$filters['filter_column']}} = get_filter('{{$filters['filter_column']}}');
            @endforeach
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: "get",
                data: {  
                    @foreach($productFilters as $filters)
                    {{$filters['filter_column']}}:{{$filters['filter_column']}},
                    @endforeach
                    family_color:family_color, brand_id: brand_id,category_id:category_id,sort: sort, url: url,size: size,price: price},
                success: function(data) {
                    $('.filter_products').html(data);
                    $(".product-load-more .item").css("display", "block");
                }

            });
        });
    }); 
    
    // =====Filter by Price ====//
     $(document).ready(function() {
        $(".price").on('change', function() {
            var sort = $("#sort option:selected").val();
            var brand_id = get_filter('brand_id');
            var size = get_filter('size');
            var price = get_filter('price');
            var category_id = get_filter('category_id');
            var family_color = get_filter('family_color');
            var url = $("#url").val();
            @foreach($productFilters as $filters)
            var {{$filters['filter_column']}} = get_filter('{{$filters['filter_column']}}');
            @endforeach
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: "get",
                data: {  
                    @foreach($productFilters as $filters)
                    {{$filters['filter_column']}}:{{$filters['filter_column']}},
                    @endforeach
                    family_color:family_color, brand_id: brand_id,category_id:category_id,sort: sort, url: url,size: size,price: price},
                success: function(data) {
                    $('.filter_products').html(data);
                    $(".product-load-more .item").css("display", "block");
                }

            });
        });
    });
      
      // ====Dynamic filter=====      
    @foreach($productFilters as $filter)    
        $(document).ready(function() {
            $(".{{$filter['filter_column']}}").on('click', function() {
                var brand_id = get_filter('brand_id');
                var category_id = get_filter('category_id');
                var size = get_filter('size');
                var family_color = get_filter('family_color');
                var sort = $("#sort option:selected").val();
                var price = get_filter('price');
                var url = $("#url").val();
                @foreach($productFilters as $filters)
                var {{$filters['filter_column']}} = get_filter('{{$filters['filter_column']}}');
                @endforeach
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    method: "get",
                    data:{
                        @foreach($productFilters as $filters)
                        {{$filters['filter_column']}}:{{$filters['filter_column']}},
                        @endforeach
                        family_color:family_color,brand_id:brand_id,category_id:category_id,sort:sort,url: url,size: size,price: price
                        },
                    success: function(data) {
                        $('.filter_products').html(data);
                        $(".product-load-more .item").css("display", "block");
                    }
                });
            });
        });
    @endforeach
</script>