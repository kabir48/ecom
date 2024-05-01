    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                        <div class="canvas_header">
                            <h2>{{$title}}</h2>
                            <a href="{{url('admin/color-lists')}}" class="btn btn-default btn-primary">Back
                            </a>
                        </div>  

                        <!-- orders -->
                        <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                             <form method="post" action="{{url('admin/color-edit-update/'.$color->id)}}">
                                @csrf     
                                <div class="row add_item">
                                   <div class="col-lg-6">
                                        <div class="form-group">
                                          <label class="form-control-label" style="margin: 10px 0;">Color Name: <span class="tx-danger">*</span></label>
                                          <input class="form-control" type="text" name="name" placeholder="write color name with samll letters" value="{{$color->name}}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label class="form-control-label" style="margin: 10px 0;">Select Color: <span class="tx-danger">*</span></label>
                                          <input class="form-control " id="color" type="color"  name="code" placeholder="write color code from google" value="{{$color->code}}">
                                          <!--<input type="color" id="hex">-->
                                        </div>
                                    </div>
                                  
                                </div> 
                                                
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
                        </div>
                    </div>
                </div>
            </div>  
         <main>
    <script>
        let colorInput=document.querySelector("#color");
        let hexInput=document.querySelector("#hex");
        hexInput.addEventListener('input',()=>{
            let color=hexInput.value;
            colorInput.value=color;
        })
    </script>
    
  
  
    @endsection
    







     
           
    
    
   

