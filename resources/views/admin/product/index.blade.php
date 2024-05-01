    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    <style>
    .flex_display{
          display:flex;
    }
        .form-control{
            width: 160px !important;
        }
    </style>
        <main class="ContentBody">
            <div class="orderListArea mb-4">
                <form action="{{url('admin/product-lists/')}}" method="get">
                    <div class="row">
                        <div class="form-group col-md-6" id="OrderCategorySelect">
                            <label class="form-control-label d-block" style="margin: 10px 0;">Category: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" style="width: 100% !important;" name="category_id" id="category_id">
                                <option></option>
                                @foreach($categories as $section)
                                <optgroup label="{{$section['name']}}"></optgroup>
                                @foreach ($section['categories'] as $category)
                                    <option style="color:rgb(233, 120, 15)" value="{{$category['id']}}" @if(!empty(@old('category_id')) && $category['id']== @old('category_id')) selected="" @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;---{{$category['category_name']}}</option>
                                    @foreach ($category['subcategories'] as $subcategory)
                                         <option style="color:brown" value="{{$subcategory['id']}}"  @if(!empty(@old('category_id')) && $subcategory['id']== @old('category_id')) selected="" @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-----{{$subcategory['category_name']}}</option>
                                    @endforeach
                                @endforeach
                                @endforeach
                          </select>
                        </div>
                    </div>
                    
                    <div class="input-group-append d-flex justify-content-center mb-3">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
            <div class="row">
                    <div class="col-md-12">
                        <div class="orderListArea">
                            <div class="canvas_header">
                                <h2>{{$title}}</h2>
                                <a href="{{url('admin/product-create-store')}}" class="btn btn-default btn-primary">Create Product
                                </a>
                            </div> 
                            <!-- orders -->
                            <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                                <table class="dashboard_Order_status" id="datatable" style="min-width:120rem">
                                    <thead>
                                        <tr>
                                          <th class="wd-15p">ID</th>
                                          <th class="wd-15p">Section </th>
                                          <th class="wd-15p">Category Name</th>
                                          <th class="wd-15p">Product Name</th>
                                          <th class="wd-15p">Product Code</th>
                                          <th class="wd-15p">Group Code</th>
                                          <th class="wd-15p">Product Price</th>
                                          <th class="wd-15p">Product Stock</th>
                                          <th class="wd-15p">Image</th>
                                          <th class="wd-15p">Status</th>
                                          <th class="wd-20p">Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($product as $key=>$row)
                                        <tr>
                                          <td>{{ $key+1 }}</td>
                                          <td>{{ $row->section->name??"no section" }}</td>
                                          <td>{{ $row->category->category_name ??""}}</td>
                                          <td>{{ $row->product_name }}</td>
                                          <td>{{ $row->product_code }}</td>
                                          <td>{{ $row->group_code }}</td>
                                          <td>{{ $row->selling_price }}</td>
                                          <td>{{ $row->product_quantity }}</td>
                                          <td class="pt-2 pb-2">
                                              <img src="{{asset($row->image_one) }}" style="width:44px;height:44px;object-fit:fill;">
                                          </td>
                                           <td class="p-0">
                                          	@if($row->status == 1)
                                          	 <a class="updateSectionStatus btn btn-success" style='padding:5px 10px' href="javascript:void(0)" id="section-{{$row->id}}" section_id="{{$row->id}}">Active</a>
                                          	@else
                                          	 <a class="updateSectionStatus btn btn-warning" style='padding:5px 10px' href="javascript:void(0)" id="section-{{$row->id}}" section_id="{{$row->id}}">Inactive</a>
                                          	@endif
                                          </td>
                                          <td class="actionTableData mt-2 mb-0">
                                          	<a target="_blank" href="{{ url('admin/product-create-store/'.$row->id) }}" class="btn btn-sm btn-primary" title="edit"><i class="fa fa-edit"></i></a>
                                          	<a target="_blank" href="{{ url('admin/faq-product-create-store/'.$row->id) }}" class="btn btn-sm btn-success" id="delete"><i class="fa fa-scroll"></i></a>
                                          </td>
                                        </tr>
                                        @endforeach
                                      </tbody>
                                </table>
                            </div>
                        </div>
                    </div>  
                </div>  
            </div>  
        <main>
            
         
        
        <script type="text/javascript">
             $(function(){
                    'use strict';
            $(".updateSectionStatus").click(function(e){
              var status = $(this).text();
              var section_id = $(this).attr("section_id");
              $.ajax({
                type:'post',
                url: '{{url("admin/status-product-update")}}',
                data:{status:status,section_id:section_id},
                success:function(resp){
                    if(resp['status']==0){
                        $("#section-"+section_id).html("<a class='updateSectionStatus btn btn-warning' style='padding:5px 10px href='javascript:(0)'>Inactive</a>");
                    }else if(resp['status']==1){
                        $("#section-"+section_id).html("<a class='updateSectionStatus btn btn-success' style='padding:5px 10px href='javascript:(0)'>Active</a>");
                    }
            
                  },error:function(){
                      alert('Error')
                  }
               });
               $(this).css('padding','0');
            
              });
              });
            
        </script>
      
    @endsection
     

    
    
    
   





