
@php
 use Carbon\Carbon;
  $current_order_income_week=DB::table('orders')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->where('created_at', Carbon::now()->weekOfYear)->where('status',3)->sum('total');
  $current_order_income=DB::table('orders')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->where('status',3)->where('return_order','!=',2)->sum('total');
  $current_last_order_income=DB::table('orders')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(1))->where('status',3)->where('return_order','!=',2)->sum('total');
  $current_last_to_order_income=DB::table('orders')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(2))->where('status',3)->where('return_order','!=',2)->sum('total');
@endphp


    <?php
    $current_week=Carbon::setWeekStartsAt(Carbon::SUNDAY);
    $current_month=date('M');
    $last_month=date('M',strtotime("-1 month"));
    $last_to_month=date('M',strtotime("-2 month"));

$dataPoints = array(
	array("label"=> $current_week, "y"=>$current_order_income_week),
	array("label"=> $current_month, "y"=>$current_order_income),
	array("label"=> $last_month, "y"=>$current_last_order_income),
	array("label"=>$last_to_month, "y"=>$current_last_to_order_income),

)

?>




<?php
    $current_month=date('M');
    $last_month=date('M',strtotime("-1 month"));
    $last_to_month=date('M',strtotime("-2 month"));

$dataPoints = array(
	array("y" => $current_order, "label" => $current_month),
	array("y" => $current_last_order, "label" =>  $last_month),
	array("y" => $current_last_to_order, "label" =>$last_to_month),
);

?>

<script>
window.onload = function() {


var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light2",
	animationEnabled: true,
	title: {
		text: "Product Sales Per Month"
	},
	data: [{
		type: "pie",
		indexLabel: "{y}",
		yValueFormatString: "#TK,##0\"\"",
		indexLabelPlacement: "inside",
		indexLabelFontColor: "#36454F",
		indexLabelFontSize: 18,
		indexLabelFontWeight: "bolder",
		showInLegend: true,
		legendText: "{label}",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

}
</script>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
