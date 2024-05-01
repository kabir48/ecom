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
                             <form method="post" action="{{url('admin/currency-create-store/')}}" enctype="multipart/form-data">
                                @csrf     
                                <div class="row">   
                                    <div class="col-lg-12 col-md-12 col-sm-6">
                                        <table class="table table-bordered">
                                            <thead class="table-success">
                                              <tr>
                                                <th scope="col">Currency code</th>
                                                <th scope="col" class="text-end">Exchange_rate</th>
                                                <th scope="col" class="NoPrint m-0"><button style='padding:5px 10px' type="button" class="btn btn-sm btn-success" onclick="currencyAdd()">+</button></th>
                                              </tr>
                                            </thead>
                                            <tbody id="TcurrencyBody">
                                              <tr id="TcurrencyRow" class="d-none">
                                                <td><input type="text" class="form-control text-end" name="currency_code[]" placeholder="currency code "></td>
                                                <td><input type="text" class="form-control text-end" name="exchange_rate[]"  placeholder="location"></td>
                                                <td class="NoPrint m-0"><button style='padding:5px 10px' type="button" class="btn btn-sm btn-danger" onclick="currencyDel(this)">X</button></td>
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
                          @if(count($currencies)>0)
                         <form method="post" action="{{url('admin/currency-create-update')}}" enctype="multipart/form-data">
                             @csrf
                         <table class="table table-bordered">
                            <thead class="table-success">
                              <tr>
                                <th scope="col">Currency Code</th>
                                <th scope="col" class="text-end">Exchange Rate</th>
                                <th scope="col" class="NoPrint">
                                    Manage
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                             @foreach($currencies as $row)
                             <input type="hidden" id="product_image" name="currencyid[]"  value="{{$row['id']}}">
                              <tr>
                                <td><input type="text" class="form-control" name="currency_code[]" value="{{$row['currency_code']}}"></td>
                                <td><input type="text" class="form-control" name="exchange_rate[]" value="{{$row['exchange_rate']}}"></td>
                              
                                <td class="NoPrint">
                                    @if($row['status'] == 1)
                                  	 <a class="updatecurrencyStatus btn btn-success" style='padding:5px 10px' href="javascript:void(0)" id="currency-{{$row['id']}}" currency_id="{{$row['id']}}">Active</a>
                                  	@else
                                  	 <a class="updatecurrencyStatus btn btn-warning" style='padding:5px 10px' href="javascript:void(0)" id="currency-{{$row['id']}}" currency_id="{{$row['id']}}">Inactive</a>
                                  	@endif 
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

function currencyAdd()
{
        /*Add Button*/
            var v = $("#TcurrencyRow").clone().appendTo("#TcurrencyBody") ;
            $(v).find("input").val('');
            $(v).removeClass("d-none");
            $(v).find("th").first().html($('#TcurrencyBody tr').length - 1);
        }
        
        function currencyDel(v)
        {
            /*Delete Button*/
               $(v).parent().parent().remove();
                $("#TcurrencyBody").find("tr").each(
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
        $(".updatecurrencyStatus").click(function(e){
          var status = $(this).text();
          var currency_id = $(this).attr("currency_id");
          $.ajax({
            type:'post',
            url: '{{url("admin/status-currency-converter")}}',
            data:{status:status,currency_id:currency_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#currency-"+currency_id).html("<a class='updatecurrencyStatus btn btn-warning' style='padding:5px 10px' href='javascript:(0)'>Inactive</a>");
                }else if(resp['status']==1){
                    $("#currency-"+currency_id).html("<a class='updatecurrencyStatus btn btn-success' style='padding:5px 10px' href='javascript:(0)'>Active</a>");
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
     
           
    
    
   

