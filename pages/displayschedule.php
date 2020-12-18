<?php 
function dis_sched($array){
	$r_array = array();
	$display = "";
	$display .= "<h2>Schedule</h2>";
	$display .= "<ul class='sched_ul'>";
	$tracker = array();
	foreach ($array as $val) {
		$index = array_search($val, $array);
		array_push($tracker, $index);
		if(!in_array($index - 11, $tracker)){
			if($val!=""){
				$val_10 = $array[$index+11];
				$uri = "/period".$index;
				$display .= "<li><b>Period $index: </b>$val — $val_10 (View Classmates <a href='$uri'>here</a>)</li>";
			}
		}
	}
	$display .= "</ul>";
	echo $display;
}
?>