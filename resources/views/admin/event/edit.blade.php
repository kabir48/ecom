    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                        <div class="canvas_header">
                            <h2>{{$title}}</h2>
                            <a href="{{url('admin/occassion-event-lists')}}" class="btn btn-default btn-primary">Back
                            </a>
                        </div>  

                        <!-- orders -->
                        <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                             <form method="post" action="{{url('admin/occassion-event-edit-update/'.$event->id)}}">
                                @csrf     
                                <div class="row add_item">
                                   <div class="col-lg-6">
                                        <div class="form-group">
                                          <label  style="margin: 10px 0;">Event Name: <span class="tx-danger">*</span></label>
                                          <input class="form-control" type="text" name="name" placeholder="write color name with samll letters" value="{{$event->name}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label  style="margin: 10px 0;">Sort Order: <span class="tx-danger">*</span></label>
                                          <input class="form-control" type="text" name="sort_id" placeholder="place the order" value="{{$event->sort_id}}">
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
  
    @endsection
    







     
           
    
    
   

