<?php
    $setting=DB::table('sitesettings')->where('status',1)->first();
    $settingCount=DB::table('sitesettings')->where('status',1)->count();
    $product_comments=DB::table('product_comments')->where('user_id','!=',Auth::guard('admin')->user()->id)->latest()->take('6')->get();
    //dd($product_comments);
?>
    <header class="d-flex sticky-top">
        <div class="header_left logo spaceOfSidebar">
            <!--logo start-->
            <a href="{{url('/admin/dashbord-home-page')}}">
                <img @if($settingCount>0) src="{{asset('public/media/logo/'.$setting->logo)}}" @else src="{{asset('public/backend/asset/img/logo.png')}}" @endif class="img-fluid adminLogo" alt="Logo">
                <span class="d-lg-inline-block d-none">
                    <span class="text-black">@if($settingCount>0) {{$setting->company_name}} @endif</span> 
                </span>
            </a>
            <!--logo end-->
        </div>
        <div class="header_right">
            <!-- Wellcome Text -->
            <div class="welcome_con_wrap">
                <h4>Welcome</h4>
                <p class="access_meta">{{date('d F Y')}} | {{date("h:i a")}} GMT</p>
            </div>

            <!-- Notification Area -->
            <div class="notification_area">
                <button class="notification_btn" id="OpenNotificationBox">
                    <img src="{{asset('public/backend/asset/img/bell.png')}}" style="max-width: 100%;">
                    <span></span>
                </button>
                <div class="hamburger-menu" id="collapseSidebarMenu">
                    <span class="line-top"></span>
                    <span class="line-center"></span>
                    <span class="line-bottom"></span>
                </div>
                <!-- <div class="overlay_bg"></div> -->
                <section class="notification_box">
                    <!-- Notification card  -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <button id="closeNotificationBox">
                                <img src="{{asset('public/backend/asset/img/right-angle.png')}}" title="Close"  data-toggle="tooltip" data-placement="right" class="rotate180" alt="">
                            </button>
                            <h3>Notifications</h3>
                        </div>
                        <!-- card body -->
                        <div data-simplebar data-simplebar-auto-hide="false" class="card-body">
                            <table>
                                <tbody>
                                    @foreach($product_comments as $comment)
                                        <?php
                                          $productReplay=App\ProductReplay::with('admins')->where('comment_id',$comment->id)->first();
                                          $productReplayCount=App\ProductReplay::with('admins')->where('comment_id',$comment->id)->count();
                                        ?>
                                        <tr class="unread">
                                            <td width=""><span></span></td>
                                            <td>
                                                <h4>{{Str::limit($comment->comment)}}</h4>
                                                <h5>-{{Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</h5>
                                            </td>
                                            <td>
                                                <button id="removeNotification">
                                                    <img src="{{asset('public/frontend/asset/img/times.png')}}" alt="">
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a href="{{url('admin/admin/comment-lists')}}">
                                 Show All Notifications
                                <img src="{{asset('public/backend/asset/img/right-angle.png')}}" alt="w_20">
                            </a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
     </div>
    </header>
           