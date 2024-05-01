        <form method="post" action="{{url('/user-billing-address-update/'.$shippings->id)}}" id="profileForm" enctype="multipart/form-data">
            @csrf
            <div class="form-floating mb-4 theme-form-floating">
                <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="name" value="{{$shippings->name}}" name="name">
                <label for="fname">Name</label>
            </div>
            
            <div class="form-floating mb-4 theme-form-floating">
                <input type="text" class="form-control" id="email" name="phone" placeholder="Enter Email Address" value="{{$shippings->phone}}">
                <label for="email">Phone</label>
            </div>
            
            <div class="form-floating mb-4 theme-form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" name="address"
                    style="height: 100px">{{$shippings->address}}</textarea>
                <label for="address">Address</label>
            </div>
            
            <div class="form-floating mb-4 theme-form-floating">
                <input type="text" class="form-control" name="area" id="pin" placeholder="Enter Pin Code" value="{{$shippings->area}}">
                <label for="pin">Area</label>
            </div>
            
            <div class="form-floating mb-4 theme-form-floating">
                <input type="text" class="form-control" name="zip_code" id="pin" placeholder="Enter zip Code" value="{{$shippings->zip_code}}">
                <label for="pin">Zip Code</label>
            </div>
            
            <div class="form-floating mb-4 theme-form-floating">
                <select name="country" class="form-control">
                    <option>select</option>
                    @foreach($countries as $data)
                    <option value="{{$data->name}}" <?php if($data->name == $shippings->country) echo "selected"; ?>>{{$data->name}}</option>
                    @endforeach
                </select>
                <label for="pin">Country</label>
            </div>
            
            <div class="modal-footer">
               <div class="modal-footer">
                    <button type="submit" class="btn theme-bg-color btn-md fw-bold text-light">Update</button>
                </div>
            </div>
        </form>