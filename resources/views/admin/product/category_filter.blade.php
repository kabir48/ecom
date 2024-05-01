<?php
    use App\ProductFilter;
    $productFilters=ProductFilter::productFilters();
    if(isset($product['category_id'])){
        $category_id=$product['category_id'];
    }
?>
    @foreach($productFilters as $filter)
    @if(isset($category_id))
    <?php
        $filterAvailable=ProductFilter::filterAvailable($filter['id'],$category_id);
    ?>
     @if($filterAvailable=='Yes')
     @if(count($filter['filter_values'])>0)
    <div class="col-lg-4">
        <div class="form-group mg-b-10-force">
          <label class="form-control-label">{{$filter['filter_name']}}</label>
          <select class="form-control" name="{{$filter['filter_column']}}" id="{{$filter['filter_column']}}">
            <option></option>
            @foreach($filter['filter_values'] as $key=>$value) 
            <option value="{{ $value['filter_value'] }}" @if(!empty($product[$filter['filter_column']]) && $value['filter_value'] == $product[$filter['filter_column']]) selected @endif>{{ ucwords($value['filter_value']) }}</option>
            @endforeach
          </select>
        </div>
    </div>
    @endif
    @endif
    @endif
    @endforeach