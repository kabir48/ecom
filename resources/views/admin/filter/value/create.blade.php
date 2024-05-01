    @extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                        <div class="canvas_header">
                            <h2>{{$title}}</h2>
                            <a href="{{url('admin/filter-value-lists')}}" class="btn btn-default btn-primary">Back
                            </a>
                        </div>  

                        <!-- orders -->
                        <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                             <form method="post" @if(empty($value->id)) action="{{url('admin/filter-value-create-store')}}" @else action="{{url('admin/filter-value-create-store/'.$value->id)}}" @endif>
                                @csrf     
                                <div class="row">
                                    <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label">Filter value Name: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" name="filter_value" value="{{$value->filter_value}}" placeholder="Type Filter value name">
                                       @if ($errors->has('filter_value'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('filter_value') }}</strong>
                                        </span>
                                       @endif
                                    </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group mg-b-10-force">
                                          <label class="form-control-label">Filter Name: <span class="tx-danger">*</span></label>
                                          <select class="form-control select2" name="filter_id" id="filter_id">
                                            <option>Filter Name</option>
                                                @foreach ($filters as $filter)
                                                     <option style="color:brown" value="{{$filter['id']}}"  @if( $value['filter_id'] == $filter['id']) selected="" @endif>{{$filter['filter_name']}}</option>
                                                @endforeach
                                          </select>
                                        </div>
                                        @if ($errors->has('filter_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('filter_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> 
                                                
                                <div class="row justify-content-end">
                                    <div class="col-sm-12">
                                        <div style="margin: 24px 0;">
                                            <button type="submit" class="btn btn-primary w-md"> 
                                             @if(empty($value->id)) Submit @else Update @endif
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
    @endsection
     
           
    
    
   
