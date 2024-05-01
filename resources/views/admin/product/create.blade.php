    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    <style>
        .invalid-feedback{
            display:block !important;
        }
        .loadFilters .col-lg-4{
            width: 100%;
            padding: 0;
            max-width: 100% !important;
        }
        #mceu_131{
            border-width: 1px 1px 0 0 !important;
        }
       
    </style>
    
        <main class="ContentBody">
            <div class="orderListArea">
                <div class="canvas_header">
                    <h2>{{$title}}</h2>
                    <a href="{{url('admin/product-lists')}}" class="btn btn-default btn-primary">Back
                    </a>
                </div>
                
                <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                    <form method="post" @if(empty($product['id'])) action="{{ url('admin/product-create-store/') }}"  @else action="{{ url('admin/product-create-store/'.$product['id']) }}" @endif  enctype="multipart/form-data">
                        @csrf
                        <!-- orders -->
                        <div class="row">
                            <div class="col-lg-8 order-lg-0  order-1">
                              <div class="row">
                                {{-- product name --}}
                                <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" name="product_name" @if($product['product_name']) value="{{$product['product_name']}}" @else  value="{{old('product_name')}}" @endif placeholder="product name">
                                    </div>
                                     @if ($errors->has('product_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('product_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                
                                  <!-- col-6 -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label">Product Name Bangla: </label>
                                      <input class="form-control" type="text" name="product_name_bangla" @if($product['product_name_bangla']) value="{{$product['product_name_bangla']}}" @else  value="{{old('product_name_bangla')}}" @endif placeholder="product name bangla">
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" name="product_code"  placeholder="product code" @if($product['product_code']) value="{{$product['product_code']}}" @else  value="{{old('product_code')}}" @endif>
                                    </div>
                                    @if ($errors->has('product_code'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('product_code') }}</strong>
                                        </span>
                                    @endif
                                </div><!-- col-4 -->
                              
                                <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label">Product Group Code:</label>
                                      <input class="form-control" type="text" name="group_code"  @if($product['group_code']) value="{{$product['group_code']}}" @else  value="{{old('group_code')}}" @endif placeholder="try to maintain same category product as same group code">
                                    </div>
                                </div><!-- col-4 -->


                                <div class="col-lg-6">
                                    <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">Family Color</label>
                                      <select class="form-control select2" name="family_color" >
                                        <option value=""> Choose Family Color</option>
                                        @foreach($colors as $color)
                                        <option value="{{ $color['id'] }}" @if(!empty(@old('family_color') && $color['id'] == @old('family_color'))) @elseif($product['family_color']== $color['id']) selected="" @endif >{{ $color['name'] }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                    @if ($errors->has('family_color'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('family_color') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label">Selling Price<span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" name="selling_price"  placeholder="Selling Price" @if($product['selling_price']) value="{{$product['selling_price']}}" @else  value="{{old('selling_price')}}" @endif>
                                    </div>
                                    @if ($errors->has('selling_price'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('selling_price') }}</strong>
                                        </span>
                                    @endif
                                </div><!-- col-4 -->
                                
                                <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label">Discount Price </label>
                                      <input class="form-control" type="text" name="discount_price" id="inputText" placeholder="discount price" @if($product['discount_price']) value="{{$product['discount_price']}}" @else  value="{{old('discount_price')}}" @endif >
                                    </div>
                                </div><!-- col-4 -->
                                @if(!empty($product['discount_price']))
                                <div class="col-lg-6" id="additionalInputContainer">
                                    <div class="form-group">
                                      <label class="form-control-label">Discount Date </label>
                                      <input class="form-control" type="date" name="discount_date" id="inputText" placeholder="discount price">
                                      @if($product['discount_date']) {{$product['discount_date']}} @endif
                                    </div>
                                </div><!-- col-4 -->
                                @else
                                <div class="col-lg-6" id="additionalInputContainer" style="display:none">
                                    <div class="form-group">
                                      <label class="form-control-label">Discount Date </label>
                                      <input class="form-control" type="date" name="discount_date" id="inputText" placeholder="discount price">
                                    </div>
                                </div><!-- col-4 -->
                                @endif

                                <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label">Product Weight (shipping charges)</label>
                                      <input class="form-control" type="text" name="product_weight"  placeholder="product weight" @if($product['product_weight']) value="{{$product['product_weight']}}" @else  value="{{old('product_weight')}}" @endif>
                                    </div>
                                    @if ($errors->has('product_weight'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('product_weight') }}</strong>
                                        </span>
                                    @endif
                                </div><!-- col-4 -->


                              </div>
                            </div>
                            <div class="col-lg-4 order-lg-1  order-0">
                                {{-- Category --}}
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" name="category_id" id="category_id" onchange="handleInputChange()">
                                      <option></option>
                                      @foreach($categories as $section)
                                      <optgroup label="{{$section['name']}}"></optgroup>
                                      @foreach ($section['categories'] as $category)
                                          <option style="color:rgb(233, 120, 15)" value="{{$category['id']}}" @if(!empty(@old('category_id')) && $category['id']== @old('category_id')) @elseif(!empty($product['category_id']) && $product['category_id'] == $category['id']) selected="" @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;---{{$category['category_name']}}</option>
                                          @foreach ($category['subcategories'] as $subcategory)
                                               <option style="color:brown" value="{{$subcategory['id']}}"  @if(!empty(@old('category_id')) && $subcategory['id']== @old('category_id')) @elseif(!empty($product['category_id']) && $product['category_id'] == $subcategory['id']) selected="" @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-----{{$subcategory['category_name']}}</option>
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
                                  <div class="loadFilters">
                                    @include('admin.product.category_filter')  
                                  </div>
                                  
                            </div>
                                
                            <div class="col-lg-12 order-3">
                                <div class="row">
                                   <div class="col-lg-6">
                                  	      <lebel>Multiple Add Image For Detail Page Image (1100x1280)<span class="tx-danger">*</span></lebel>
                          				  <input type="file" id="product_image" class="form-control" name="product_images[]"  accept="image" multiple>
                          				  <span class="custom-file-control"></span>
                          				  <table cellpadding="1" cellspacing="1">
                          				      <tr>
                          				          @foreach($product['images'] as $image)
                          				          <td>
                          				              <a target="_blank" href="{{asset('public/media/product/multiple/large/'.$image['product_image'])}}"><img src="{{asset('public/media/product/multiple/large/'.$image['product_image'])}}" id="one" width="50"></a> &nbsp;
                          				              <input type="hidden" id="product_image" name="image[]"  value="{{$image['product_image']}}">
                          				              <input type="number" name="image_sort[]" value="{{$image['image_sort']}}"  style="width:40px">&nbsp;
                          				              <a href="javascript:void(0)" class="confirmDelete" record="product-image" recordid="{{$image['id']}}"><i class="fa fa-trash"></i></a>
                          				          </td>
                          				          @endforeach
                          				      </tr>
                          				  </table>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Product Video(Size :3MB)</label>
                                            <input type="file" class="form-control" placeholder="video link" name="video_link" @if($product['video_link']) value="{{$product['video_link']}}" @else  value="{{old('video_link')}}" @endif>
                                        </div>
                                        
                                        @if(!empty($product['video_link']))
                                        <a target="_blank"  href="{{asset('public/video/product/'.$product['video_link'])}}">View </a>&nbsp;&nbsp;|
                                        <a href="javascript:void(0)" class="confirmDelete" record="product-video" recordid="{{$product['id']}}">Delete</a>
                                        @endif
                                        
                                    </div>
                                    
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">You tube Link</label>
                                            <input type="text" class="form-control" placeholder="you tubevideo link" name="youtube_link" @if($product['youtube_link']) value="{{$product['youtube_link']}}" @else  value="{{old('youtube_link')}}" @endif>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="col-lg-4">
                                        <label>Image One (Main Image for Product <strong id="strong">(1100 X 1280)</strong><span class="tx-danger">*</span></label>
                                        <input type="file" id="file" class="form-control" name="image_one" onchange="readURL(this);"  accept="image">
                                        <span class="custom-file-control"></span>
                                        @if($product['image_one'])
                                        <img src="{{asset($product['image_one'])}}" id="one" width="50">
                                        @else
                                        <img src="#" id="one">
                                        @endif
                                        @if ($errors->has('image_one'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image_one') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                    
                                    <div class="col-lg-4">
                                        <label>Use Back Site Image Two <span id="span">(1100 X 1280 px)</span></label> 
                                        <input type="file" id="file" class="form-control" name="image_two" onchange="readURL1(this);"  accept="image">
                                        <span class="custom-file-control"></span>
                                        @if($product['image_two'])
                                        <img src="{{asset($product['image_two'])}}" id="two" width="50">
                                        @else
                                        <img src="#" id="two" >
                                        @endif
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <label>Image Three ((Long Image For Single product (1100 X 1280 px)</label> 
                                        <input type="file" id="file" class="form-control" name="image_three" onchange="readURL2(this);"  accept="image">
                                        <span class="custom-file-control"></span>
                                        
                                        @if($product['image_three'])
                                        <img src="{{asset($product['image_three'])}}" id="three" width="50">
                                        @else
                                        <img src="#" id="three">
                                        @endif
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Occasional Event</label>
                                            <select class="form-control select2" data-placeholder="occasional" name="occasional">
                                            <option></option>
                                            @foreach($events as $event)
                                            <option value="{{$event['id']}}" @if(!empty(@old('occasional')) && $event['id'] == @old('occasional')) @elseif($product['occasional'] == $event['id']) selected="" @endif>{{$event['name']}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Product Mode  <span class="tx-danger">*</span></label>
                                            <select class="form-control select2" name="product_mode">
                                            <option></option>
                                            @foreach($modes as $mode)
                                            <option value="{{$mode['category_name']}}" @if(!empty(@old('product_mode')) && $mode['category_name'] == @old('product_mode')) @elseif($product['product_mode'] == $mode['category_name']) selected="" @endif>{{$mode['category_name']}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ckbox">
                                                <input type="checkbox" name="is_feature" id="is_feature" value="Yes" <?php if($product['is_feature'] == 'Yes') echo "checked" ;?>>
                                                <span>Is_New Arrival</span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                       @if($product['arrival_date'])
                                        <div class="col-lg-6" id="arrival_date">
                                            <div class="form-group">
                                              <label class="form-control-label">New Product Date </label>
                                              <input class="form-control" type="date" name="arrival_date" id="inputText" placeholder="discount price" @if($product['arrival_date']) value="{{$product['arrival_date']}}" @else  value="{{old('arrival_date')}}" @endif >
                                            </div>
                                        </div><!-- col-4 -->
                                        @else
                                        <div class="col-lg-6" id="arrival_date" style="display:none">
                                            <div class="form-group">
                                              <label class="form-control-label">New Product Date</label>
                                              <input class="form-control" type="date" name="arrival_date" id="inputText" placeholder="discount price">
                                            </div>
                                        </div><!-- col-4 -->
                                        @endif
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ckbox">
                                                <input type="checkbox" name="is_publish" id="is_feature" value="Yes" <?php if($product['is_publish'] == 'Yes') echo "checked" ;?>>
                                                <span>Is Publish</span>
                                            </label>
                                        </div>
                                    </div>
                                        
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Meta Keyword</label>
                                            <input type="text" class="form-control" placeholder="write key word for seo" name="meta_keyword" @if($product['meta_keyword']) value="{{$product['meta_keyword']}}" @else value="{{old('meta_keyword')}}" @endif>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">About Product Quality  <span class="tx-danger">*</span></label>
                                            <select class="form-control select2" name="about_product_id[]" multiple>
                                            <option></option>
                                            @foreach($abouts as $about)
                                            
                                            <option value="{{$about['id']}}" @if(!empty(@old('about_product_id')) && $about['id'] == @old('about_product_id')) @elseif(in_array($about['id'],$aboutPart)) selected="" @endif>{{$about['title']}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Meta description</label>
                                            <input type="text" class="form-control" placeholder="write meta_decription for seo" name="meta_description" @if($product['meta_description']) value="{{$product['meta_description']}}" @else value="{{old('meta_description')}}" @endif>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Product Details <span class="tx-danger">*</span></label>
                                            <textarea class="form-control" id="summernote" name="product_details">
                                            @if($product['product_details']) {{$product['product_details']}} @else {{old('product_details')}} @endif
                                            </textarea>
                                        </div>
                                        
                                        @if ($errors->has('product_details'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('product_details') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Wash Care</label>
                                            <textarea class="form-control"  name="wash_care" id="wash_care">
                                                @if($product['product_details']) {{$product['wash_care']}} @else {{old('wash_care')}} @endif
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                    
                        @if($product['id'])
                        <div class="row mt-4">
                            <div class="col-lg-12 col-md-12 col-sm-6">
                                <table class="table table-bordered">
                                <thead class="table-success">
                                    <tr>
                                    <th scope="col">Product Size</th>
                                    <th scope="col" class="text-end">SKU</th>
                                    <th scope="col" class="text-end">Price</th>
                                    <th scope="col" class="text-end">Stock</th>
                                    <th scope="col" class="text-end">Waist</th>
                                    <th scope="col" class="text-end">Chest</th>
                                    <th scope="col" class="text-end">length</th>
                                    <th scope="col" class="NoPrint">Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($product['attributes'] as $data)
                                    <input type="hidden" name="attrId[]" value="{{$data['id']}}">
                                    <tr>
                                    <td>{{$data['weight_size']}}</td>
                                    <td>{{$data['sku']}}</td>
                                    <td><input type="text" class="form-control" name="price[]"  value="{{$data['price']}}" placeholder="price"></td>
                                    <td><input type="text" class="form-control" name="stocks[]"  value="{{$data['stock']}}" placeholder="stock"></td>
                                    <td><input type="text" class="form-control" name="waist[]"  value="{{$data['waist']}}" placeholder="waist size"></td>
                                    <td><input type="text" class="form-control" name="chest[]"  value="{{$data['chest']}}" placeholder="waist chest"></td>
                                    <td><input type="text" class="form-control" name="length[]" value="{{$data['length']}}" placeholder="waist length"></td>
                                    <td class="NoPrint">
                                        @if($data['status'] == 1)
                                        <a class="updateAttrStatus" href="javascript:void(0)" id="attribute_id-{{$data['id']}}" attribute_id="{{$data['id']}}">Active</a>
                                        @else
                                        <a class="updateAttrStatus" href="javascript:void(0)" id="attribute_id-{{$data['id']}}" attribute_id="{{$data['id']}}">Inactive</a>
                                        @endif 
                                    </tdtext
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                        @endif
                        <div class="row mt-4">
                            <!--<h4 style="margin-bottom:30px;color:#5b9be2;margin-left:20px">Product Size </h4>-->
                            <div class="col-lg-12 col-md-12 col-sm-6">
                             <table class="table table-bordered">
                                <thead class="table-success">
                                    <tr>
                                    <th scope="col">Product Size</th>
                                    <th scope="col" class="text-end">Stock</th>
                                    <th scope="col" class="text-end">SKU</th>
                                     <th scope="col" class="text-end"></th>
                                    <th scope="col" class="text-end">Price</th>
                                    <th scope="col" class="text-end">Waist</th>
                                    <th scope="col" class="text-end">Chest</th>
                                    <th scope="col" class="text-end">length</th>
                                    <th scope="col" class="NoPrint p-2"><button type="button" style="padding:5px 10px" class="btn btn-sm btn-success" onclick="BtnAdd()">+</button></th>
                                    </tr>
                                </thead>
                                <tbody id="TBody">
                                    <tr id="TRow" class="d-none">
                                    <td><input type="text" class="form-control text-end" name="weight_size[]" placeholder="product size"></td>
                                    <td><input type="text" class="form-control" name="stock[]"  onchange="Calc(this);"  placeholder="product stock"></td>
                                    <td><input type="text" class="form-control" name="sku[]"  placeholder="unique better to use product code and size mixed"></td>
                                    <td><input type="hidden" class="form-control" name="amount[]" readonly></td>
                                    <td><input type="text" class="form-control" name="price[]" placeholder="product price"></td>
                                    <td><input type="text" class="form-control" name="waist[]" placeholder="waist size"></td>
                                    <td><input type="text" class="form-control" name="chest[]" placeholder="waist chest"></td>
                                    <td><input type="text" class="form-control" name="length[]" placeholder="waist length"></td>
                                    <td class="NoPrint p-2"><button type="button" style="padding:5px 10px" class="btn btn-sm btn-danger" onclick="BtnDel(this)">X</button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="hidden" class="form-control text-end" id="productQuantity" name="product_quantity">
                            </div>
                        </div>   
                        <div class="row justify-content-end">
                            <div class="col-sm-12">
                                <div style="margin: 24px 0;">
                                    <button type="submit" class="btn btn-primary w-md"> 
                                        @if(empty($product['id']))  Submit @else Update @endif
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>  
        <main>
             
       
            <!-- Modal for Eligible-->
            


    <script src="{{asset('public/backend/asset/js/tinymce/tinymce.min.js')}}"></script>

   
   <script type="text/javascript">
         $(function(){
                'use strict';
        $(".updateAttrStatus").click(function(e){
          var status = $(this).text();
          var attribute_id = $(this).attr("attribute_id");
          $.ajax({
            type:'post',
            url: '{{url("admin/status-section-productattribute")}}',
            data:{status:status,attribute_id:attribute_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#attribute_id-"+attribute_id).html("<a class='updateAttrStatus' href='javascript:(0)'>Inactive</a>");
                }else if(resp['status']==1){
                    $("#attribute_id-"+attribute_id).html("<a class='updateAttrStatus' href='javascript:(0)'>Active</a>");
                }
        
            },error:function(){
                alert('Error')
              }
           });
        
          });
          });

   </script>
   
   
    <script>
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "#summernote",
                theme: "modern",
                height: 200,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('public/backend/asset/js/tinymce') }}';
        });
    </script>
    <script>
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "#wash_care",
                theme: "modern",
                height: 200,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('public/backend/asset/js/tinymce') }}';
        });
    </script>
    
     <script>
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "#product_guide",
                theme: "modern",
                height: 200,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('public/backend/asset/js/tinymce') }}';
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
<script type="text/javascript">
	function readURL2(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#three')
                  .attr('src', e.target.result)
                  .width(80)
                  .height(80);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script>
<script type="text/javascript">
	function readURL3(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#four')
                  .attr('src', e.target.result)
                  .width(80)
                  .height(80);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script>


<script>

    function GetPrint(){
    /*For Print*/
        window.print();
    }

    function BtnAdd(){
        /*Add Button*/
        var v = $("#TRow").clone().appendTo("#TBody") ;
        //$(v).find("input").val('');
        $(v).removeClass("d-none");
        $(v).find("th").first().html($('#TBody tr').length - 1);
    }

    function BtnDel(v)
    {
        /*Delete Button*/
           $(v).parent().parent().remove(); 
           GetTotal();
    
            $("#TBody").find("tr").each(
            function(index)
            {
               $(this).find("th").first().html(index);
            }
    
           );
    }

    function Calc(m)
    {
        /*Detail Calculation Each Row*/
        var index = $(m).parent().parent().index();
        
        var stock =document.getElementsByName("stock[]")[index].value;
    
        //var amt = yerd * rate;
        document.getElementsByName("amount[]")[index].value = stock;
    
        GetTotal();
    }

    function GetTotal()
    {
        var sum=0;
        var amts =  document.getElementsByName("amount[]");
    
        for (let index = 0; index < amts.length; index++)
        {
            var amt = amts[index].value;
            sum = +(sum) +  +(amt) ; 
        }
    
        document.getElementById("productQuantity").value = sum;
       
    }
 </script>






<script>

function faqAdd()
{
    /*Add Button*/
    var v = $("#TFaqRow").clone().appendTo("#TFaqBody") ;
    $(v).find("input").val('');
    $(v).removeClass("d-none");
    $(v).find("th").first().html($('#TFaqBody tr').length - 1);
}

function faqDel(v)
{
    /*Delete Button*/
       $(v).parent().parent().remove();
        $("#TFaqBody").find("tr").each(
        function(index)
        {
           $(this).find("th").first().html(index);
        }

       );
}


</script>


<script>


function aboutAdd()
{
    /*Add Button*/
    var v = $("#TAboutRow").clone().appendTo("#TAboutBody") ;
    $(v).find("input").val('');
    $(v).removeClass("d-none");
    $(v).find("th").first().html($('#TFaqBody tr').length - 1);
}

function aboutDel(v)
{
    /*Delete Button*/
       $(v).parent().parent().remove();
        $("#TAboutBody").find("tr").each(
        function(index)
        {
           $(this).find("th").first().html(index);
        }

       );
}


</script>
<script>
    $(document).ready(function(){
        $("#category_id").on("change",function(){
            var category_id=$(this).val();
            $.ajax({
                url:"{{url("admin/category-filters")}}",
                type:'post',
                data:{'category_id':category_id},
                success:function(resp){
                    $(".loadFilters").html(resp.view)
                }
            })
        })
    })
</script>
<script>
    let inputText=document.getElementById("inputText");
    var additionalInputContainer = document.getElementById("additionalInputContainer");

    inputText.addEventListener("keyup",function(){
       
       var inputValue = inputText.value;
       if(inputValue.trim() !==""){
           additionalInputContainer.style.display="block";
       }else{
           additionalInputContainer.style.display="none";
       }
       
    })
    inputText
</script>
<script>
    function handleInputChange(){
        let inputValue =  document.getElementById("category_id").value;
        //alert(inputValue)
        let strong=document.getElementById("strong");
        let span=document.getElementById("span");
        if(inputValue == 4){
            strong.innerText="(600 X 600 px) formal";
            span.innerText="(600 X 600 px) formal";
        }else{
            strong.innerText="(1100 X 1280 px)";
            span.innerText="(1100 X 1280 px)";
        }
    }
    
</script>


   <script>
    
    let is_feature =  document.getElementById("is_feature");
        is_feature.addEventListener('click',function(){
            let arrivalDateElement = document.getElementById("arrival_date");
            if (is_feature.checked) {
                arrivalDateElement.style.display = "block";
            } else {
                arrivalDateElement.style.display = "none";
            }
        });
  
        //alert(inputValue)
      
    
    
    </script>
    
@endsection




