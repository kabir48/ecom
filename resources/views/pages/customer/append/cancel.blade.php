    <form method="post" action="{{url('/customer-order-cancel/'.$order_detail->id)}}" id="profileForm" enctype="multipart/form-data">
        <div class="row g-4">
        @csrf
            <div class="col-xxl-6">
                <div class="form-floating theme-form-floating">
                    <select name="confirm" class="form-control">
                        <option value="#" >Select Confirmation</option>
                        <option value="yes" >Yes</option>
                    </select>
                    <label for="finame">review</label>
                </div>
            </div>
           <div class="modal-footer">
                <button type="submit" class="btn theme-bg-color btn-md fw-bold text-light">Submit</button>
            </div>
        </div>
    </form>