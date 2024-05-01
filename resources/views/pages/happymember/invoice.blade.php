<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    #invoice{
    padding: 30px;
}

.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 200px !important;
    padding: 15px;
    width:500px;
    margin: auto
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #3989c6
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #3989c6
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #3989c6
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #3989c6;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}






@media print {
    .invoice {
        font-size: 11px!important;
        overflow: hidden!important
    }

    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }

    .invoice>div:last-child {
        page-break-before: always
    }
}
</style>
<!--Author      : @arboshiki-->
<div id="invoice">

    <div class="toolbar hidden-print">
        <div class="text-right">
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
        </div>
        <hr>
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 200px">
            <?php
            $site=DB::table('sitesettings')->select('logo')->where('status',1)->first();
            //dd($site);die;
            ?>
            <header>
                <div class="row">
                    <div class="col">
                        <a target="_blank" href="{{ url('/') }}">
                            <img src="{{ url('public/media/logo/'.$site->logo)}}" data-holder-rendered="true"/>
                            </a>
                    </div>

                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light" style="text-transform: uppercase;font-weight:800">List To:</div>
                        <h2 class="to">{{Auth::user()->name}}</h2>
                        <div class="address">{{Auth::user()->address}}</div>
                        <div class="phone">{{Auth::user()->phone}}</div>
                        <div class="email"><a href="telto:{{Auth::user()->email}}">{{Auth::user()->email}}</</a></div>
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th class="text-left">Product Id</th>
                            <th class="text-left">Product Name</th>
                            <th class="text-left">Quantity</th>
                            <th class="text-left">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($happies as $row)
                        <tr>
                            @if(!empty($row['quantity_one']))
                            <td class="total">{{'#'.$row['id']}}</td>

                            <td class="total">{{$row['product_one']}}</td>
                            <td class="total">{{$row['quantity_one']}}</td>
                          <td class="total">{{Carbon\Carbon::parse($row['created_at'])->diffForHumans()}}</td>
                            @endif
                        </tr>
                        <tr>
                            @if(!empty($row['quantity_two']))
                            <td class="total">{{'#'.$row['id']}}</td>
                            <td class="total">{{$row['product_two']}}</td>
                            <td class="total">{{$row['quantity_two']}}</td>
                             <td class="total">{{Carbon\Carbon::parse($row['created_at'])->diffForHumans()}}</td>
                            @endif
                        </tr>
                        <tr>
                            @if(!empty($row['quantity_three']))
                            <td class="total">{{'#'.$row['id']}}</td>
                            <td class="total">{{$row['product_three']}}</td>
                            <td class="total">{{$row['quantity_three']}}</td>
                             <td class="total">{{Carbon\Carbon::parse($row['created_at'])->diffForHumans()}}</td>
                            @endif
                        </tr>
                        <tr>
                            @if(!empty($row['quantity_four']))
                            <td class="total">{{'#'.$row['id']}}</td>
                            <td class="total">{{$row['product_four']}}</td>
                            <td class="total">{{$row['quantity_four']}}</td>
                             <td class="total">{{Carbon\Carbon::parse($row['created_at'])->diffForHumans()}}</td>
                            @endif
                        </tr>
                        <tr>
                            @if(!empty($row['quantity_five']))
                            <td class="total">{{'#'.$row['id']}}</td>
                            <td class="total">{{$row['product_five']}}</td>
                            <td class="total">{{$row['quantity_five']}}</td>
                             <td class="total">{{Carbon\Carbon::parse($row['created_at'])->diffForHumans()}}</td>
                            @endif
                        </tr>
                        <tr>
                            @if(!empty($row['quantity_six']))
                            <td class="total">{{'#'.$row['id']}}</td>
                            <td class="total">{{$row['product_six']}}</td>
                            <td class="total">{{$row['quantity_six']}}</td>
                            <td class="total">{{$row['quantity_six']}}</td>
                             <td class="total">{{Carbon\Carbon::parse($row['created_at'])->diffForHumans()}}</td>
                            @endif
                        </tr>
                        <tr>
                              @if(!empty($row['quantity_seven']))
                            <td class="total">{{'#'.$row['id']}}</td>
                            <td class="total">{{$row['product_seven']}}</td>
                            <td class="total">{{$row['quantity_seven']}}</td>
                             <td class="total">{{Carbon\Carbon::parse($row['created_at'])->diffForHumans()}}</td>
                            @endif
                        </tr>
                        <tr>
                             @if(!empty($row['quantity_eight']))
                             <td class="total">{{'#'.$row['id']}}</td>
                             <td class="total">{{$row['product_eight']}}</td>
                             <td class="total">{{$row['quantity_eight']}}</td>
                             <td class="total">{{Carbon\Carbon::parse($row['created_at'])->diffForHumans()}}</td>
                             @endif
                        </tr>
                         @endforeach
                    </tbody>
                </table>

            </main>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>
<script>
     $('#printInvoice').click(function(){
            Popup($('.invoice')[0].outerHTML);
            function Popup(data)
            {
                window.print();
                return true;
            }
        });
</script>
