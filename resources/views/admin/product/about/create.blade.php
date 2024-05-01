    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                        <div class="canvas_header">
                            <h2>{{$title}}</h2>
                            <a href="{{url('admin/product-lists')}}" class="btn btn-default btn-primary">Back</a>
                        </div>  

                        <!-- orders -->
                        <div  class="pb_25">
                             <form method="post" action="{{url('admin/about-product-create-store/')}}" enctype="multipart/form-data">
                                @csrf     
                                <div class="row">   
                                    <div class="col-lg-12 col-md-12 col-sm-6">
                                        <table class="table table-bordered">
                                            <thead class="table-success">
                                              <tr>
                                                <th scope="col">Question</th>
                                                <th scope="col" class="text-end">Answer</th>
                                                <th scope="col" class="NoPrint m-0"><button type="button" style="padding:5px 10px" class="btn btn-sm btn-success" onclick="aboutAdd()">+</button></th>
                                              </tr>
                                            </thead>
                                            <tbody id="TaboutBody">
                                              <tr id="TaboutRow" class="d-none">
                                                <td><input type="text" class="form-control text-end" name="title[]" placeholder="product title(Wrinkle Resistant,Color & Fit Retention etc)"></td>
                                                <td><input type="file" class="form-control text-end" name="image[]"></td>
                                                <td class="NoPrint m-0"><button type="button" class="btn btn-sm btn-danger" style="padding:5px 10px" onclick="aboutDel(this)">X</button></td>
                                              </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>       
                                <div class="row justify-content-end">
                                    <div class="col-sm-12">
                                        <div style="margin: 24px 0;">
                                            <button type="submit" class="btn btn-primary w-md"> 
                                              Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                          @if(count($abouts)>0)
                         <form method="post" action="{{url('admin/about-product-create-update')}}" enctype="multipart/form-data">
                             @csrf
                         <table class="table table-bordered">
                            <thead class="table-success">
                              <tr>
                                <th scope="col">Title</th>
                                <th scope="col" class="text-end">Answer</th>
                                <th scope="col" class="NoPrint">
                                    Manage
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                             @foreach($abouts as $row)
                             <input type="hidden" id="product_image" name="aboutid[]"  value="{{$row['id']}}">
                              <tr>
                                <td><input type="text" class="form-control" name="title[]" value="{{$row['title']}}"></td>
                                <td>
                                    <input type="hidden" id="product_image" name="image[]"  value="{{$row['image']}}">
                                    <img src="{{asset($row['image'])}}" style="margin-top:3px;width:44px;height:44px;object-fit:fill;">
                                </td>
                                <td class="NoPrint m-0">
                                    @if($row['status'] == 1)
                                  	 <a class="updateaboutStatus btn btn-success" style="padding:5px 10px;" href="javascript:void(0)" id="about-{{$row['id']}}" about_id="{{$row['id']}}">Active</a>
                                  	@else
                                  	 <a class="updateaboutStatus btn btn-warning" style="padding:5px 10px;" href="javascript:void(0)" id="about-{{$row['id']}}" about_id="{{$row['id']}}">Inactive</a>
                                  	@endif 
                                  	<a href="javascript:void(0)" style="padding:5px 10px;" class="confirmDelete btn ml-2 btn-sm btn-danger" record="product-about" recordid="{{$row['id']}}"><i class="fa fa-trash"></i></a>
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                        </table>
                        <div class="row justify-content-end">
                            <div class="col-sm-12">
                                <div style="margin: 24px 0;">
                                    <button type="submit" class="btn btn-primary w-md"> 
                                      Update
                                    </button>
                                </div>
                            </div>
                        </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>  
         <main>
             

<script>

function aboutAdd()
{
        /*Add Button*/
            var v = $("#TaboutRow").clone().appendTo("#TaboutBody") ;
            $(v).find("input").val('');
            $(v).removeClass("d-none");
            $(v).find("th").first().html($('#TaboutBody tr').length - 1);
        }
        
        function aboutDel(v)
        {
            /*Delete Button*/
               $(v).parent().parent().remove();
                $("#TaboutBody").find("tr").each(
                function(index)
                {
                   $(this).find("th").first().html(index);
                }
        
               );
        }


</script>

    <script type="text/javascript">
         $(function(){
                'use strict';
        $(".updateaboutStatus").click(function(e){
          var status = $(this).text();
          var about_id = $(this).attr("about_id");
          $.ajax({
            type:'post',
            url: '{{url("admin/status-about-product")}}',
            data:{status:status,about_id:about_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#about-"+about_id).html("<a class='updateaboutStatus btn btn-warning' style='padding:5px 10px' href='javascript:(0)'>Inactive</a>");
                }else if(resp['status']==1){
                    $("#about-"+about_id).html("<a class='updateaboutStatus btn btn-success' style='padding:5px 10px' href='javascript:(0)'>Active</a>");
                }
        
              },error:function(){
                  alert('Error')
              }
           });
        $(this).css("padding", "0");
          });
          });

   </script>
    @endsection
     
           
    
    
   

