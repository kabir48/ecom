@extends('admin.admin_layouts')

@section('admin_content')



    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="#">Starlight</a>
        <span class="breadcrumb-item active">Authority Registration</span>
      </nav>
      <div class="sl-pagebody">
      	   <div class="card pd-20 pd-sm-40">
                 <h6 class="card-body-title">Back Page <a href="{{url('for-ladystore-quickee-create-role')}}" class="btn btn-info btn-sm pull-right">Move Back</a></h6>
          <h6 class="card-body-title">Edit Admin Panel </h6>
          <p class="mg-b-20 mg-sm-b-30"> Admin Edit form</p>
          <form action="{{ url('for-ladystore-quickee-create-role-edit-update')}}" method="post">
          @csrf
          <input type="hidden" name="id" value="{{ $user->id }}">
          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label"> Name: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="name"  required="" value="{{ $user->name }}">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Phone: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="phone"  required="" value="{{ $user->phone }}">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Email <span class="tx-danger">*</span></label>
                  <input class="form-control" type="email" name="email"  required="" value="{{ $user->email }}">
                </div>
              </div><!-- col-4 -->

            </div><!-- row -->
            <br><hr>
            <div class="row">
            	<div class="col-lg-4">
            		<label class="ckbox">
					  <input type="checkbox" name="category" value="1"   <?php  if ($user->category == 1) {
					        	echo "checked";
					  }  ?>  >
					  <span>Category</span>
					</label>
            	</div>
            	<div class="col-lg-4">
            		<label class="ckbox">
					  <input type="checkbox" name="coupon" value="1"  <?php  if ($user->coupon == 1) {
					        	echo "checked";
					  }  ?>>
					  <span>Coupon</span>
					</label>
            	</div>
            	<div class="col-lg-4">
            		<label class="ckbox">
					  <input type="checkbox" name="product" value="1"  <?php  if ($user->product == 1) {
					        	echo "checked";
					  }  ?>>
					  <span>Product</span>
					</label>
            	</div>
            	<div class="col-lg-4">
            		<label class="ckbox">
					  <input type="checkbox" name="blog" value="1"  <?php  if ($user->blog == 1) {
					        	echo "checked";
					  }  ?>>
					  <span>Blog</span>
					</label>
            	</div>
            	<div class="col-lg-4">
            		<label class="ckbox">
					  <input type="checkbox" name="order" value="1"  <?php  if ($user->order == 1) {
					        	echo "checked";
					  }  ?>>
					  <span>Order</span>
					</label>
            	</div>
            	<div class="col-lg-4">
            		<label class="ckbox">
      					  <input type="checkbox" name="other" value="1"  <?php  if ($user->other == 1) {
					        	echo "checked";
					  }  ?>>
      					  <span>Other</span>
      					</label>
            	</div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="report" value="1"  <?php  if ($user->report == 1) {
					        	echo "checked";
					  }  ?>>
                  <span>Report</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="role" value="1"  <?php  if ($user->role == 1) {
					        	echo "checked";
					  }  ?>>
                  <span>Role</span>
                </label>
              </div>
              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="return" value="1"  <?php  if ($user->return == 1) {
					        	echo "checked";
					  }  ?>>
                  <span>Return</span>
                </label>
              </div>
              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="contact" value="1" <?php  if ($user->contact == 1) {
					        	echo "checked";
					  }  ?>>
                  <span>Contact</span>
                </label>
              </div>
              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="comment" value="1" <?php  if ($user->comment == 1) {
					        	echo "checked";
					  }  ?>>
                  <span>Comment</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="setting" value="1" <?php  if ($user->setting == 1) {
					        	echo "checked";
					  }  ?>>
                  <span>Setting</span>
                </label>
              </div>

               <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="stock" value="1" <?php  if ($user->stock == 1) {
                    echo "checked";
            }  ?>>
                  <span>Stock</span>
                </label>
              </div>

                  <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="tream" value="1" <?php  if ($user->tream == 1) {
                    echo "checked";
            }  ?>>
                  <span>Tream</span>
                </label>
              </div>
                  <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="Service" value="1" <?php  if ($user->Service == 1) {
                    echo "checked";
            }  ?>>
                  <span>Service</span>
                </label>
              </div>
                  <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="About" value="1" <?php  if ($user->About == 1) {
                    echo "checked";
            }  ?>>
                  <span>About</span>
                </label>
              </div>
                  <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="shipping" value="1" <?php  if ($user->shipping == 1) {
                    echo "checked";
            }  ?>>
                  <span>Shipping</span>
                </label>
              </div>
                  <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="Security" value="1" <?php  if ($user->Security == 1) {
                    echo "checked";
            }  ?>>
                  <span>Security</span>
                </label>
              </div>
                  <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="Help" value="1" <?php  if ($user->Help == 1) {
                    echo "checked";
            }  ?>>
                  <span>Help</span>
                </label>
              </div>
                  <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="Ladystore" value="1" <?php  if ($user->Ladystore == 1) {
                    echo "checked";
            }  ?>>
                  <span>Ladystore</span>
                </label>
              </div>
                  <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="flygharholiday" value="1" <?php  if ($user->flygharholiday == 1) {
                    echo "checked";
            }  ?>>
                  <span>flygharholiday</span>
                </label>
              </div>
                  <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="BPTI" value="1" <?php  if ($user->BPTI == 1) {
                    echo "checked";
            }  ?>>
                  <span>BPTI</span>
                </label>
              </div>
                  <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="Refund" value="1" <?php  if ($user->Refund == 1) {
                    echo "checked";
            }  ?>>
                  <span>Refund</span>
                </label>
              </div>
                  <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="Policy" value="1" <?php  if ($user->Policy == 1) {
                    echo "checked";
            }  ?>>
                  <span>Policy</span>
                </label>
              </div>

                   <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="Delivery_stuff" value="1" <?php  if ($user->Delivery_stuff == 1) {
                    echo "checked";
            }  ?>>
                  <span>Delivery_stuff</span>
                </label>
              </div>

            </div>

            <br><br><hr>
            <div class="form-layout-footer">
              <button class="btn btn-info mg-r-5" type="submit">Update </button>
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
          </form>
        </div><!-- card -->

      </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->




@endsection
