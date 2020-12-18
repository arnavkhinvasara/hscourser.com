<?php
require_once("connection.php");
$made_sched = False;
$s_statement = "SELECT * FROM usersched WHERE Email='$sess_email'";
$qs_statement = mysqli_query($conn, $s_statement);
if (mysqli_num_rows($qs_statement)>0){
	$made_sched = True;
	while ($row = mysqli_fetch_assoc($qs_statement)){
		$d_0 = $row["P0"];
		$dt_0 = $row["T0"];
		$d_1 = $row["P1"];
		$dt_1 = $row["T1"];
		$d_2 = $row["P2"];
		$dt_2 = $row["T2"];
		$d_3 = $row["P3"];
		$dt_3 = $row["T3"];
		$d_4 = $row["P4"];
		$dt_4 = $row["T4"];
		$d_5 = $row["P5"];
		$dt_5 = $row["T5"];
		$d_6 = $row["P6"];
		$dt_6 = $row["T6"];
		$d_7 = $row["P7"];
		$dt_7 = $row["T7"];
		$d_8 = $row["P8"];
		$dt_8 = $row["T8"];
		$d_9 = $row["P9"];
		$dt_9 = $row["T9"];
		$d_10 = $row["P10"];
		$dt_10 = $row["T10"];
	}
}
?>