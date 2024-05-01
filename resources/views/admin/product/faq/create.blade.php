    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody ProductFaQCreatePage">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                        <div class="canvas_header">
                            <h2>{{$title}}</h2>
                            <a href="{{url('admin/product-lists')}}" class="btn btn-default btn-primary">Back</a>
                        </div>  

                        <!-- orders -->
                        <div  class="pb_25">
                             <form method="post" action="{{url('admin/faq-product-create-store/'.$product->id)}}">
                                @csrf     
                                <div class="row">   
                                    <div class="col-lg-12 col-md-12 col-sm-6">
                                        <table class="table table-bordered">
                                            <thead class="table-success">
                                              <tr>
                                                <th scope="col">Question</th>
                                                <th scope="col" class="text-end">Answer</th>
                                                <th scope="col" class="NoPrint p-0"><button type="button" style="padding:5px 13px" class="btn btn-sm btn-success" onclick="faqAdd()">+</button></th>
                                              </tr>
                                            </thead>
                                            <tbody id="TFaqBody">
                                              <tr id="TFaqRow" class="d-none">
                                                <td><input type="text" class="form-control text-end" name="question[]" placeholder="product question"></td>
                                                <td><textarea style="height:65px !important" class="form-control form_control" name="answer[]"  placeholder="answer"></textarea></td>
                                                <td class="NoPrint pl-3 p-0"><button type="button" style="padding:5px 13px" class="btn btn-sm btn-danger" onclick="faqDel(this)">X</button></td>
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
                          @if(count($product['faqs'])>0)
                         <form method="post" action="{{url('admin/faq-product-create-update')}}">
                             @csrf
                         <table class="table table-bordered">
                            <thead class="table-success">
                              <tr>
                                <th scope="col">Question</th>
                                <th scope="col" class="text-end">Answer</th>
                                <th scope="col" class="NoPrint">
                                    Manage
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                             @foreach($product['faqs'] as $row)
                             <input type="hidden" name="faqId[]" value="{{$row['id']}}">
                              <tr>
                                <td><input type="text" class="form-control" name="question[]" value="{{$row['question']}}"></td>
                                <td>
                                    <textarea style="height:65px !important" class="form-control" name="answer[]"  placeholder="answer">{{$row['answer']}}</textarea>
                                </td>
                                <td  class="NoPrint pl-3 p-0">
                                    @if($row['status'] == 1)
                                  	 <a class="updateFaqStatus btn btn-success" style='padding:5px 10px' href="javascript:void(0)" id="faq-{{$row['id']}}" faq_id="{{$row['id']}}">Active</a>
                                  	@else
                                  	 <a class="updateFaqStatus btn btn-warning" style='padding:5px 10px' href="javascript:void(0)" id="faq-{{$row['id']}}" faq_id="{{$row['id']}}">Inactive</a>
                                  	@endif 
                                  	<a href="javascript:void(0)" class="confirmDelete btn btn-danger mr-4" style='padding:5px 10px' record="product-faq" recordid="{{$row['id']}}"><i class="fa fa-trash"></i></a>
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

    <script type="text/javascript">
         $(function(){
                'use strict';
        $(".updateFaqStatus").click(function(e){
          var status = $(this).text();
          var faq_id = $(this).attr("faq_id");
          $.ajax({
            type:'post',
            url: '{{url("admin/status-faq-product")}}',
            data:{status:status,faq_id:faq_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#faq-"+faq_id).html("<a class='updateFaqStatus btn btn-warning' style='padding:5px 10px' href='javascript:(0)'>Inactive</a>");
                }else if(resp['status']==1){
                    $("#faq-"+faq_id).html("<a class='updateFaqStatus btn btn-success' style='padding:5px 10px' href='javascript:(0)'>Active</a>");
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
     
           
    
    
   

