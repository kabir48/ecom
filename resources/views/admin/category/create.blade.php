    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                        <div class="canvas_header">
                            <h2>{{$title}}</h2>
                            <a href="{{url('admin/category-lists')}}" class="btn btn-default btn-primary">Back
                            </a>
                        </div>  

                        <!-- orders -->
                        <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                            <form method="post" @if(empty($categorydata['id'])) action="{{ url('admin/add-edit-category')}}" @else action="{{ url('admin/add-edit-category/'.$categorydata['id'])}}"@endif enctype="multipart/form-data" id="categoryForm">
                                @csrf     
                                <div class="row">
                                   <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label" style="margin: 10px 0;"> Section: <span class="tx-danger">*</span></label>
                                        <select class="form-control" name="section_id" id="section_id">
                                        <option value="">select section</option>
                                      	@foreach($getSection as $rows)
                                      	<option value="{{$rows->id}}" @if(!empty($categorydata['section_id']) && $categorydata['section_id']==$rows['id']) selected @endif>{{$rows['name']}}</option>
                                      	@endforeach
                                      </select>
                                     </div>
                                    </div>
                                    
                                    <div class="col-lg-6" id="appendCategoryLevel">
                                          @include('admin.category.append_category_level')
                                    </div>
                                      
                                   <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 4px 0;" class="form-control-label">Category Name<span class="tx-danger">*</span></label>
                                          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Category" name="category_name" @if(!empty($categorydata['category_name'])) value="{{$categorydata['category_name']}}" @else value="{{old('category_name')}}" @endif>
                                           
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 4px 0;" class="form-control-label">Category Name (Bangla)<span class="tx-danger">*</span></label>
                                          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="type Bangla Key word" name="bangla_name" @if(!empty($categorydata['bangla_name'])) value="{{$categorydata['bangla_name']}}" @else value="{{old('bangla_name')}}" @endif>
                                           
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 4px 0;" class="form-control-label">Category Discount<span class="tx-danger">*</span></label>
                                          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="category discount" name="category_discount" @if(!empty($categorydata['category_discount'])) value="{{$categorydata['category_discount']}}" @else value="{{old('category_discount')}}" @endif>
                                           
                                        </div>
                                    </div> 
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 4px 0;" class="form-control-label">Meta Keyword (SEO)<span class="tx-danger">*</span></label>
                                          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="meta Keyword" name="meta_keyword" @if(!empty($categorydata['meta_keyword'])) value="{{$categorydata['meta_keyword']}}" @else value="{{old('meta_keyword')}}" @endif>
                                           
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                         <div class="form-group">
                                         <label style="margin: 4px 0;">Category Image (565,565)<span class="tx-danger">*</span></label>
                                           <input type="file" id="image" class="form-control" name="image" onchange="readURL(this);"  accept="image">
                                        </div>
                                         @if(!@empty($categorydata['image']))
                                         <label for="brandImage" class="imageEditPreviewLavel">
                                           <img src="{{asset('public/media/category/large/'.$categorydata['image'])}}" id="one" class="imageEditPreview">
                                          </label>
                                          @endif
                                    </div>
                                    
                                     <div class="col-lg-6">
                                         <div class="form-group">
                                         <label style="margin: 4px 0;">Category Slider (860,230)<span class="tx-danger">*</span></label>
                                           <input type="file" id="font" class="form-control" name="font" onchange="readURL1(this);"  accept="image">
                                        </div>
                                         @if(!@empty($categorydata['font']))
                                         <label for="brandImage" class="imageEditPreviewLavel">
                                           <img src="{{asset('public/media/category/slide/'.$categorydata['font'])}}" id="two" class="imageEditPreview">
                                          </label>
                                          @endif
                                    </div>
                                </div> 
                                                
                                <div class="row">
                                        <div class="col-sm-12">
                                            <div style="margin: 24px 0;">
                                                <button type="submit" class="btn btn-primary w-md"> 
                                               @if(empty($categorydata->id)) Submit @else Update @endif
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
            
                 <script  type="text/javascript">
        $(function(){
            'use strict';
    
           $('#section_id').change(function(){
               var section_id =$(this).val();
               $.ajax({
                    type:'post',
                    url: '{{url("admin/status-section-level")}}',
                    data:{section_id:section_id},
                    success:function(resp){
                        $("#appendCategoryLevel").html(resp);
    
                    },error:function(resp){
                        alert("Error");
                    }
                });
              });
            });
    </script>
     
    <script type="text/javascript">
    	function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#one')
                      .attr('src', e.target.result)
                      .width(80)
                      .height(80);
              };
              reader.readAsDataURL(input.files[0]);
          }
       }
    </script>
    
    <script type="text/javascript">
    	function readURL1(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#two')
                      .attr('src', e.target.result)
                      .width(80)
                      .height(80);
              };
              reader.readAsDataURL(input.files[0]);
          }
       }
    </script> 
    
    @endsection