
  <div class="form-group">
     <label style="margin: 10px 0;" class="form-control-label">Category Level<span class="tx-danger">*</span></label>
    <select class="form-control" name="parent_id" id="parent_id">
    <option value="0" @if(isset($categorydata['parent_id']) && $categorydata['parent_id']==0) selected="" @endif>Main Category</option>
    @if(!empty($getCategories))
    @foreach($getCategories as $categored)
        <option value="{{$categored['id']}}" @if(isset($categorydata['parent_id']) && $categorydata['parent_id']==$categored['id']) selected="" @endif>{{$categored['category_name']}}</option>
           @if(!empty($categored['subcategories']))
             @foreach($categored['subcategories'] as $subcategory)
             <option value="{{$subcategory['id']}}">&nbsp;&nbsp;&raquo;&raquo;&nbsp;{{$subcategory['category_name']}}</option>
            @endforeach
           @endif
    @endforeach
    @endif
    </select>
  </div>
