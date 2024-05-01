    <!--Promotion Bar-->
    @php
        $setting=DB::table('sitesettings')->first();
        $settingCount=DB::table('sitesettings')->count();
    @endphp
    <div class="notification-bar mobilehide">
        <a href="#" class="notification-bar__message"><b> @if(session()->get('lang') == 'bangla') {{$setting->company_name_bangla}} @elseif(session()->get('lang') == 'bangla'){{$setting->company_name}}@else {{$setting->company_name_bangla}} @endif</b> 
            @if(session()->get('lang') == 'bangla')
            {{__("heading.sologan_bn")}}
            @elseif (session()->get('lang') == 'english')
             {{__("heading.sologan_en")}}
            @else
            {{__("heading.sologan_bn")}}
            @endif
        !</a>
        <span class="close-announcement"><i class="fa-solid fa-hexagon-xmark"></i></span>
    </div>
    <!--End Promotion Bar-->

