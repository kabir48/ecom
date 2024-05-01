    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                        <div class="canvas_header">
                            <h2>{{$title}}</h2>
                            <a href="{{url('admin/filter-lists')}}" class="btn btn-default btn-primary">Back
                            </a>
                        </div>  

                        <!-- orders -->
                        <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                             <form method="post" @if(empty($filter->id)) action="{{url('admin/filter-create-store')}}" @else action="{{url('admin/filter-create-store/'.$filter->id)}}" @endif>
                                @csrf     
                                <div class="row">
                                    <div class="col-lg-4">
                                    <div class="form-group">
                                      <label class="form-control-label" style="margin: 10px 0;">Filter Name: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" name="filter_name" value="{{$filter->filter_name}}" placeholder="Type filter name">
                                       @if ($errors->has('filter_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('filter_name') }}</strong>
                                        </span>
                                       @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;" class="form-control-label">Filter Column: <span class="tx-danger">*</span></label>
                                          <input class="form-control" type="text" name="filter_column" value="{{$filter->filter_column}}" placeholder="Type filter Column use small letters">
                                           @if ($errors->has('filter_column'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('filter_column') }}</strong>
                                            </span>
                                           @endif
                                        </div>
                                      </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mg-b-10-force">
                                          <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                                          <select class="form-control select2" name="category_id[]" id="category_id" multiple>
                                            <option></option>
                                            @foreach($sections as $filter)
                                            <optgroup label="{{$filter['name']}}"></optgroup>
                                            @foreach ($filter['categories'] as $category)
                                                <option style="color:rgb(233, 120, 15)" value="{{$category['id']}}" @if(in_array($filter->category_id,$catArr)) == $category['id']) selected @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;---{{$category['category_name']}}</option>
                                                @foreach ($category['subcategories'] as $subcategory)
                                                     <option style="color:brown" value="{{$subcategory['id']}}" @if(in_array($filter->category_id,$catArr)) == $subcategory['id']) selected @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-----{{$subcategory['category_name']}}</option>
                                                @endforeach
                                            @endforeach
                                            @endforeach
                                          </select>
                                        </div>
                                        @if ($errors->has('category_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('category_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> 
                                                
                                <div class="row justify-content-end">
                                    <div class="col-sm-12">
                                        <div style="margin: 24px 0;">
                                            <button type="submit" class="btn btn-primary w-md"> 
                                             @if(empty($filter->id)) Submit @else Update @endif
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>  
         <main>
            <!-- Modal for Eligible-->
    @endsection
     
           
    
    
   
