<style>
.search-ul{
    padding-top: 10px;
    padding-left: 15px
}
.design-li{
    list-style: none;
    margin: 15px 0;
}

.design-li:hover{
    background: #F3F3F3;
    cursor: pointer;
}
.design-li a:hover{
    color: #333;
}
</style>
<ul class="search-ul">
    @forelse ($products as $data)

    <a href="{{url('product/details/'.$data->id.'/'.$data->product_name)}}">
    <li class="design-li">
        <img src="{{ asset($data->image_one)}}" alt="" width="30">
        <strong style="padding-left: 15px">
            @if(session()->get('lang') == 'english'){{ $data->product_name }}
            @elseif(session()->get('lang') == 'bangla')
            {{ $data->product_name_bangla }}
            @else
            {{ $data->product_name }}
            @endif
        </strong>
    </li>
</a>
@empty
<h4 style="padding-left: 15px">No products Available</h4>
@endforelse
</ul>
