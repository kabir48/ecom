    <form method="post" action="{{url('/customer-order-return-product/'.$orderDetail->id)}}" id="profileForm" enctype="multipart/form-data">
        <div class="row g-4">
                @csrf
                <input type="hidden" name="product_code" value="{{$orderDetail->product_code}}">
                <input type="hidden" name="product_size" value="{{$orderDetail->product_size}}">
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <div class="col-xxl-6">
                    <div class="form-floating theme-form-floating" >
                        <select class="form-control" name="return_reason" id="reasonStatus">
                            <option>Select Resons</option>
                            <option value="Performance Or Low Quality">Low Quality</option>
                            <option value="Not Stitched">Not Stitched</option>
                            <option value="Wrong Item Was Sent">Wrong Item Was Sent</option>
                            <option value="Buttons Prolem">Buttons Problem</option>
                        </select>
                        <label for="finame">Return Product Reason</label>
                    </div>
                </div>
                <div class="col-xxl-6">
                    <div class="form-floating theme-form-floating">
                        <textarea rows="5" cols="40" class="form-control" id="review" name="note"></textarea>
                        <label for="finame">Note (only 200 words)</label>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn theme-bg-color btn-md fw-bold text-light btnReturnOrder">Submit</button>
                </div>
        </div>
    </form>
    
    <script>
        $(document).on('click','.btnReturnOrder',function(){
            var reasonStatus=$("#reasonStatus").val();
            if(reasonStatus==""){
                alert('Please Select Reason');
                return false;
            }
            
            var result =confirm("Want to Cancel This Order?");
            if(!result){
                return false;
            }
        })
    </script>