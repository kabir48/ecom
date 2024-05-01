    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                        <div class="canvas_header">
                            <h2>{{$title}}</h2>
                            <a href="{{url('admin/occassion-even-lists')}}" class="btn btn-default btn-primary">Back
                            </a>
                        </div>  

                        <!-- orders -->
                        <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                             <form method="post" action="{{url('admin/occassion-event-create-store')}}">
                                @csrf     
                                <div class="row add_item">
                                    <div class="col-lg-3 text-lg-right">
                                          <label style="margin: 10px 0;">Event Name: <span class="tx-danger">*</span></label>
                                    </div>
                                   <div class="col-lg-6">
                                        <div class="form-group">
                                          <input class="form-control" type="text" name="name[]" placeholder="write color name with samll letters">
                                        </div>
                                    </div>
                                    <div>
                                         <span class="btn btn-success addeventmore" style="margin-left:20px"><i class="fa fa-plus-circle"></i></span>
                                    </div>
                                </div> 
                                                
                                <div class="row">
                                    <div class="col-sm-12 col-lg-6 offset-lg-3">
                                        <div style="margin: 24px 0;">
                                            <button type="submit" class="btn btn-primary w-md"> 
                                               Submit 
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
             
        <div style="visibility: hidden;" >
            <div class="whole_extra_item_add" id="whole_extra_item_add">
                <div id="delete_whole_extra_item_add" class="delete_whole_extra_item_add">
                    <div class="form-row row">
                        <div class="col-lg-3 text-lg-right">
                              <label class="form-control-label" style="margin: 10px 0;">Event Name: <span class="tx-danger">*</span></label>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                              <input class="form-control" type="text" name="name[]" placeholder="write color name with samll letters">
                            </div>
                        </div>
                        
                       
                    
                        <div class="form-group col-lg-3">
                            <div class="form-row d-flex gap-2" style="margin:0px 16px">
                                <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                                <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

 

      <script type="text/javascript">
        $(document).ready(function(){
            var counter=0;
            $(document).on("click",".addeventmore",function(){
            var whole_extra_item_add = $("#whole_extra_item_add").html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
            });
            $(document).on("click",".removeeventmore",function(event){
            $(this).closest(".delete_whole_extra_item_add").remove();
            counter -=1
            });
        });
    </script>

  
    @endsection
    







     
           
    
    
   

