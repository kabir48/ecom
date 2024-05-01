@extends('emails.layout')

@section('content')
<!--{{ __lang('new-topics-mail',['count'=>count($topics)]) }}<br/>-->
<table style="width:100%" class="table-layout">
    <thead>
        <tr>
            <th style="text-align: left;">{{__('Topic')}}</th>
            <th style="text-align: left;">{{__('Created By')}}</th>
        </tr>
    </thead>
    <tbody>
   
        <tr>
            <td><a style="text-decoration: underline" href="">{</a></td>
            <td></td>
        </tr>
   
    </tbody>
</table>
@endsection