    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                        <div class="canvas_header">
                            <h2>{{$title}}</h2>
                        </div>  

                        <!-- orders -->
                        <div  class="pb_25">
                             <form method="post" action="{{url('admin/zipcode-create-store/')}}" enctype="multipart/form-data">
                                @csrf     
                                <div class="row">   
                                    <div class="col-lg-12 col-md-12 col-sm-6">
                                        <table class="table table-bordered">
                                            <thead class="table-success">
                                              <tr>
                                                <th scope="col">Zip code</th>
                                                <th scope="col" class="text-end">Place</th>
                                                <th scope="col" class="NoPrint m-0"><button style="padding:5px 10px" type="button" class="btn btn-sm btn-success" onclick="zipAdd()">+</button></th>
                                              </tr>
                                            </thead>
                                            <tbody id="TzipBody">
                                              <tr id="TzipRow" class="d-none">
                                                <td><input type="text" class="form-control text-end" name="zip_code[]" placeholder="zip code "></td>
                                                <td><input type="text" class="form-control text-end" name="place[]"  placeholder="location"></td>
                                                <td class="NoPrint m-0"><button type="button" style="padding:5px 10px" class="btn btn-sm btn-danger" onclick="zipDel(this)">X</button></td>
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
                          @if(count($zips)>0)
                         <form method="post" action="{{url('admin/zipcode-create-update')}}" enctype="multipart/form-data">
                             @csrf
                         <table class="table table-bordered">
                            <thead class="table-success">
                              <tr>
                                <th scope="col">Zip Code</th>
                                <th scope="col" class="text-end">Place</th>
                                <th scope="col" class="NoPrint">
                                    Manage
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                             @foreach($zips as $row)
                             <input type="hidden" id="product_image" name="zipid[]"  value="{{$row['id']}}">
                              <tr>
                                <td><input type="text" class="form-control" name="zip_code[]" value="{{$row['zip_code']}}"></td>
                                <td><input type="text" class="form-control" name="place[]" value="{{$row['place']}}"></td>
                              
                                <td class="NoPrint m-0">
                                    @if($row['status'] == 1)
                                  	 <a class="updatezipStatus btn btn-success" href="javascript:void(0)" id="zip-{{$row['id']}}" zip_id="{{$row['id']}}">Active</a>
                                  	@else
                                  	 <a class="updatezipStatus btn btn-warning" href="javascript:void(0)" id="zip-{{$row['id']}}" zip_id="{{$row['id']}}">Inactive</a>
                                  	@endif 
                                  	<a href="javascript:void(0)" style="padding:5px 10px" class="confirmDelete ml-2 btn btn-sm btn-danger" record="zip-code" recordid="{{$row['id']}}"><i class="fa fa-trash"></i></a>
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

function zipAdd()
{
        /*Add Button*/
            var v = $("#TzipRow").clone().appendTo("#TzipBody") ;
            $(v).find("input").val('');
            $(v).removeClass("d-none");
            $(v).find("th").first().html($('#TzipBody tr').length - 1);
        }
        
        function zipDel(v)
        {
            /*Delete Button*/
               $(v).parent().parent().remove();
                $("#TzipBody").find("tr").each(
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
        $(".updatezipStatus").click(function(e){
          var status = $(this).text();
          var zip_id = $(this).attr("zip_id");
          $.ajax({
            type:'post',
            url: '{{url("admin/status-zip-code")}}',
            data:{status:status,zip_id:zip_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#zip-"+zip_id).html("<a class='updatezipStatus btn btn-warning' style='padding:5px 10px' href='javascript:(0)'>Inactive</a>");
                }else if(resp['status']==1){
                    $("#zip-"+zip_id).html("<a class='updatezipStatus btn btn-success' style='padding:5px 10px' href='javascript:(0)'>Active</a>");
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
     
           
    
    
   

