<!-- ========== Left Sidebar Start ========== -->
    <aside class="spaceOfSidebar card" id="sideBarArea">
        <div class="card-header spaceOfTopHeader">
            
        </div>

        <!-- Menu -->
        <ul class="card-body menu" data-simplebar data-simplebar-auto-hide="false">
            
            <!-- ============================================================
             *           if you need dropdown menu to add like this         *
            **   ============================================================
             *                      
             *  <li class="dropdownMenu">
             *      <a href="#" class="active dropdownLink">your content</a>
             *      <ul class="dropdown">
             *          <li><a href="#">your content</a></li>
             *      </ul>
             *  </li>
             *
             *  ============================================================
             =============================================================== -->
            
            <!--===============Dashboard==============-->
            <li>
                 @if(Session::get('page')=='dashboard')
                    <?php
                       $active_menu="active";
                    ?>
                @else
                    <?php
                       $active_menu="";
                    ?>
                @endif
                <a href="{{url('admin/dashbord-home-page')}}" class="{{$active_menu}}">
                    <img src="{{asset('public/backend/asset/img/dashboard.svg')}}" alt="Icon">
                    <span>Dashboard</span>
                </a>
            </li>
            
         
            <!--=============Product Parts============-->
            <li  class="dropdownMenu">
                
                @if(Session::get('page')=='section' || Session::get('page')=='brand' || Session::get('page')=='category' || 
                Session::get('page')=='coupon' || Session::get('page')=='product' || Session::get('page')=='color' || 
                Session::get('page')=='charge' || Session::get('page')=='event'||
                Session::get('page')=='productabout'||Session::get('page')=='zipcode'||Session::get('page')=='filter')
                    <?php
                       $active_menu="active";
                    ?>
                @else
                    <?php
                       $active_menu="";
                    ?>
                @endif
                <a href="#" class="{{$active_menu}} dropdownLink">
                    <img src="{{asset('public/backend/asset/img/shopping_cart.svg')}}" alt="Icon">
                    <span>All Products</span>
                </a>
                
                <ul class="dropdown">
                    <li>
                        <a href="{{url('admin/product-lists')}}">Product Lists
                         </a>
                    </li>
                    <li>
                        <a href="{{url('admin/section-lists')}}">Section Lists</a>
                    </li>
                    
                     <li>
                        <a href="{{url('admin/brand-lists')}}">Brand Lists</a>
                    </li>
                       
                    <li>
                        <a href="{{url('admin/category-lists')}}">Category Lists
                         </a>
                    </li>
                    
                    <li>
                        <a href="{{url('admin/coupon-lists')}}">Coupon Lists
                         </a>
                    </li>
                    
                    <li>
                        <a href="{{url('admin/color-lists')}}">Color Lists
                         </a>
                    </li>
                    
                     <li>
                        <a href="{{url('admin/shipping-charge-lists')}}">Shipping Charge Lists
                         </a>
                    </li>
                    
                    <li>
                        <a href="{{url('admin/occassion-event-lists')}}">Occasional Event Lists
                         </a>
                    </li> 
                    
                    <li>
                        <a href="{{url('admin/about-product-create-store')}}">About Product
                         </a>
                    </li>
                     <li>
                        <a href="{{url('admin/zipcode-create-store')}}">Zip Code Lists</a>
                    </li>
                    
                     <li>
                        <a href="{{url('admin/currency-create-store')}}">Currency Lists</a>
                    </li> 
                    
                    <li>
                        <a href="{{url('admin/filter-lists')}}">Filter Lists</a>
                    </li>
                    <li>
                        <a href="{{url('admin/filter-value-lists')}}">Filter Value Lists</a>
                    </li>
                    
                </ul>
            </li>
            
            

             <!--==============Order Part============-->
            <li  class="dropdownMenu">
                
                @if(Session::get('page')=='order' || Session::get('page')=='inventory' || Session::get('page')=='return' || Session::get('page')=='exchange'|| Session::get('page')=='pre_order')
                    <?php
                       $active_menu="active";
                    ?>
                @else
                    <?php
                       $active_menu="";
                    ?>
                @endif
                <a href="#" class="{{$active_menu}} dropdownLink">
                    <img src="{{asset('public/backend/asset/img/shop_two.svg')}}" alt="Icon">
                    <span>Order Managements</span>
                </a>
                
                <ul class="dropdown">
                    <li>
                        <a href="{{url('admin/order-lists')}}">Order Lists</a>
                    </li>
                    
                     <li>
                        <a href="{{url('admin/inventory-product-lists')}}">Inventory Product Lists</a>
                    </li>
                       
                    <li>
                        <a href="{{url('admin/return-lists')}}">Return List</a>
                    </li>
                    
                    <li>
                        <a href="{{url('admin/exchange-lists')}}">Exchange Product List</a>
                    </li>
                    
                    <li>
                        <a href="{{url('admin/preorder-lists')}}">Pre Order Lists</a>
                    </li>
                </ul>
            </li>
            
            
            <!--Payment Part-->
            <li  class="dropdownMenu">
                
                @if(Session::get('page')=='userlist' || Session::get('page')=='env' || Session::get('page')=='gateway')
                    <?php
                       $active_menu="active";
                    ?>
                @else
                    <?php
                       $active_menu="";
                    ?>
                @endif
                <a href="#" class="{{$active_menu}} dropdownLink">
                    <img src="{{asset('public/backend/asset/img/account_balance_wallet.svg')}}" alt="Icon">
                    <span>Payment System</span>
                </a>
                
                <ul class="dropdown">
                    <li>
                        <a href="{{url('admin/sms-lists')}}">SMS Lists</a>
                    </li>
                    
                     <li>
                        <a href="{{url('admin/payment-gateway-lists')}}">Payment Gateway Lists</a>
                    </li>
                       
                    <li>
                        <a href="{{url('admin/smtp-lists')}}">ENV File Changes</a>
                    </li>
                </ul>
            </li>
            
            
            <!--Customer Part-->
            <li  class="dropdownMenu">
                
                @if(Session::get('page')=='userlist' || Session::get('page')=='comment' || Session::get('page')=='rating')
                    <?php
                       $active_menu="active";
                    ?>
                @else
                    <?php
                       $active_menu="";
                    ?>
                @endif
                <a href="#" class="{{$active_menu}} dropdownLink">
                    <img src="{{asset('public/backend/asset/img/person_pin.svg')}}" alt="Icon">
                    <span>Customer Data</span>
                </a>
                
                <ul class="dropdown">
                    <li>
                        <a href="{{url('admin/user-lists')}}">User Lists</a>
                    </li>
                    
                     <li>
                        <a href="{{url('admin/comment-lists')}}">Product Comment Lists</a>
                    </li>
                       
                    <li>
                        <a href="{{url('admin/rating-lists')}}">Product Review Lists</a>
                    </li>
                 
                </ul>
            </li>
            
            
            <!--=============Website Parts=============-->
            
            <li  class="dropdownMenu">
                
                @if(Session::get('page')=='banner' || Session::get('page')=='about' || Session::get('page')=='policy' || Session::get('page')=='faq' || Session::get('page')=='return' || Session::get('page')=='setting')
                    <?php
                       $active_menu="active";
                    ?>
                @else
                    <?php
                       $active_menu="";
                    ?>
                @endif
                <a href="#" class="{{$active_menu}} dropdownLink">
                    <img src="{{asset('public/backend/asset/img/web.svg')}}" alt="Icon">
                    <span>Website Edit</span>
                </a>
                
                <ul class="dropdown">
                     <li>
                        <a href="{{url('admin/sitesetting-lists')}}">Site Setting Lists</a>
                    </li>
                       
                    <li>
                        <a href="{{url('admin/banner-lists')}}">Home Banner Lists</a>
                    </li>
                    
                    <li>
                        <a href="{{url('admin/index-addproduct')}}">Adds Lists</a>
                    </li>
          
                    <li>
                        <a href="{{url('admin/page-builder-lists')}}">Page Builder Lists</a>
                    </li> 
                    
                    <li>
                        <a href="{{url('admin/announcement-lists')}}">Announcement Lists</a>
                    </li> 
                </ul>
            </li>

           
            <!--===============Admin Parts==============-->
            
            <li class="dropdownMenu">
                @if(Session::get('page')=='users' || Session::get('page')=='role' || Session::get('page')=='setting')
                    <?php
                       $active_menu="active";
                    ?>
                @else
                    <?php
                       $active_menu="";
                    ?>
                @endif
               
                <a href="#" class="{{$active_menu}} dropdownLink">
                    <img src="{{asset('public/backend/asset/img/admin_panel_settings.svg')}}" alt="Icon">
                    <span>Admin Roles</span>
                </a>
                    <ul class="dropdown">
                       <li>
                           <a href="{{url('admin/user-list')}}">Admin Lists</a>
                       </li>
                       
                       <li>
                           <a href="{{url('admin/role-lists')}}">Role List</a>
                        </li>
                       
                    </ul>
            </li>
            
        </ul>

        <div class="logout_btn card-footer">
            <p class="comment_text d-lg-block d-none">Please click here to Log out</p>
            <a href="{{url('admin/logout-admin')}}" class="cbtn">
                <img src="{{asset('public/image/logout.png')}}" alt="Log Out Image">
                <span class="d-lg-block d-none ">Log out</span>
            </a>
        </div>
    </aside>
       
            
           