<?php 
session_start();
if(!isset($_SESSION["session_email"])){
	header("Location: /login");
}
$sess_email = $_SESSION["session_email"];
$sess_username = $_SESSION["session_username"];
$request = substr($_SERVER['REQUEST_URI'], 1);
$username_exploded = explode("/", $request);
$checked = False;
$friend_username = $username_exploded[1];
require_once("connection.php");
$c_statement = "SELECT * FROM friends WHERE FriendUsername='$friend_username'";
$c_query = mysqli_query($conn, $c_statement);
$friend = False;
if (mysqli_num_rows($c_query)>0) {
	while($row = mysqli_fetch_assoc($c_query)){
		$email = $row["Email"];
		if($email==$sess_email){
			$friend = True;
			break;
		}
	}
}
if($friend==False){
	header("Location: javascript:history.go(-1)");
}
else{
	$statement = "SELECT * FROM userdata WHERE Username='$friend_username'";
	$q_statement = mysqli_query($conn, $statement);
	while ($row = mysqli_fetch_assoc($q_statement)){
		$friend_email = $row["Email"];
		$friend_name = $row["Fullname"];
	}
	$f_statement = "SELECT * FROM newfriends WHERE Email='$friend_email' AND FriendUsername='$sess_username'";
	$f_query = mysqli_query($conn, $f_statement);
	if(mysqli_num_rows($f_query)>0){
		header("Location: /explanation");
	}
	else{
		function obtainer($x, $y){
			$r_statement = "SELECT * FROM usersched WHERE Email='$x'";
			$r_query = mysqli_query($y, $r_statement);
			if(mysqli_num_rows($r_query)>0){
				while ($row = mysqli_fetch_assoc($r_query)){
					return array($row["P0"], $row["T0"], $row["P1"], $row["T1"], $row["P2"], $row["T2"], $row["P3"], $row["T3"], $row["P4"], $row["T4"], $row["P5"], $row["T5"], $row["P6"], $row["T6"], $row["P7"], $row["T7"], $row["P8"], $row["T8"], $row["P9"], $row["T9"], $row["P10"], $row["T10"]);
				}
			}
			else{
				return array();
			}
		}
		$uarr = obtainer($sess_email, $conn);
		$farr = obtainer($friend_email, $conn);
		if(count($uarr)<=0 or count($farr)<=0){
			header("Location: javascript:history.go(-1)");
		}
		function checker($a, $b, $c, $d){
			if($a=="None"){
				return "";
			}
			if(strtolower($a)==strtolower($c) and strtolower($b)==strtolower($d)){
				return "(MATCH)";
			}
			return "";
		}
		function identifier($x){
			if($x==""){
				return "None";
			}
		}
		function displayer($x_o, $y_o, $z){
			$title = explode(" ", $z)[0]."'s Schedule";
			$x = array();
			foreach ($x_o as $value) {
				if($value==""){
					array_push($x, "None");
					continue;
				}
				array_push($x, $value);
			}
			$y = array();
			foreach ($y_o as $value_2) {
				if($value_2==""){
					array_push($y, "None");
					continue;
				}
				array_push($y, $value_2);
			}
			$p0 = $x[0];
			$t0 = $x[1];
			$p1 = $x[2];
			$t1 = $x[3];
			$p2 = $x[4];
			$t2 = $x[5];
			$p3 = $x[6];
			$t3 = $x[7];
			$p4 = $x[8];
			$t4 = $x[9];
			$p5 = $x[10];
			$t5 = $x[11];
			$p6 = $x[12];
			$t6 = $x[13];
			$p7 = $x[14];
			$t7 = $x[15];
			$p8 = $x[16];
			$t8 = $x[17];
			$p9 = $x[18];
			$t9 = $x[19];
			$p10 = $x[20];
			$t10 = $x[21];
			$pp0 = $y[0];
			$tt0 = $y[1];
			$pp1 = $y[2];
			$tt1 = $y[3];
			$pp2 = $y[4];
			$tt2 = $y[5];
			$pp3 = $y[6];
			$tt3 = $y[7];
			$pp4 = $y[8];
			$tt4 = $y[9];
			$pp5 = $y[10];
			$tt5 = $y[11];
			$pp6 = $y[12];
			$tt6 = $y[13];
			$pp7 = $y[14];
			$tt7 = $y[15];
			$pp8 = $y[16];
			$tt8 = $y[17];
			$pp9 = $y[18];
			$tt9 = $y[19];
			$pp10 = $y[20];
			$tt10 = $y[21];
			$c_one = checker($p0, $t0, $pp0, $tt0);
			$c_two = checker($p1, $t1, $pp1, $tt1);
			$c_three = checker($p2, $t2, $pp2, $tt2);
			$c_four = checker($p3, $t3, $pp3, $tt3);
			$c_five = checker($p4, $t4, $pp4, $tt4);
			$c_six = checker($p5, $t5, $pp5, $tt5);
			$c_seven = checker($p6, $t6, $pp6, $tt6);
			$c_eight = checker($p7, $t7, $pp7, $tt7);
			$c_nine = checker($p8, $t8, $pp8, $tt8);
			$c_ten = checker($p9, $t9, $pp9, $tt9);
			$c_eleven = checker($p10, $t10, $pp10, $tt10);
			$u_dis = "
				<h2>Your Schedule</h2>
				<ul class='sched_ul'>
					<li><b>Period 0: </b>$p0 — $t0 <b class='match'>$c_one</b></li>
					<li><b>Period 1: </b>$p1 — $t1 <b class='match'>$c_two</b></li>
					<li><b>Period 2: </b>$p2 — $t2 <b class='match'>$c_three</b></li>
					<li><b>Period 3: </b>$p3 — $t3 <b class='match'>$c_four</b></li>
					<li><b>Period 4: </b>$p4 — $t4 <b class='match'>$c_five</b></li>
					<li><b>Period 5: </b>$p5 — $t5 <b class='match'>$c_six</b></li>
					<li><b>Period 6: </b>$p6 — $t6 <b class='match'>$c_seven</b></li>
					<li><b>Period 7: </b>$p7 — $t7 <b class='match'>$c_eight</b></li>
					<li><b>Period 8: </b>$p8 — $t8 <b class='match'>$c_nine</b></li>
					<li><b>Period 9: </b>$p9 — $t9 <b class='match'>$c_ten</b></li>
					<li><b>Period 10: </b>$p10 — $t10 <b class='match'>$c_eleven</b></li>
				</ul>
			";
			$f_dis = "
				<h2>$title</h2>
				<ul class='sched_ul'>
					<li><b>Period 0: </b>$pp0 — $tt0 <b class='match'>$c_one</b></li>
					<li><b>Period 1: </b>$pp1 — $tt1 <b class='match'>$c_two</b></li>
					<li><b>Period 2: </b>$pp2 — $tt2 <b class='match'>$c_three</b></li>
					<li><b>Period 3: </b>$pp3 — $tt3 <b class='match'>$c_four</b></li>
					<li><b>Period 4: </b>$pp4 — $tt4 <b class='match'>$c_five</b></li>
					<li><b>Period 5: </b>$pp5 — $tt5 <b class='match'>$c_six</b></li>
					<li><b>Period 6: </b>$pp6 — $tt6 <b class='match'>$c_seven</b></li>
					<li><b>Period 7: </b>$pp7 — $tt7 <b class='match'>$c_eight</b></li>
					<li><b>Period 8: </b>$pp8 — $tt8 <b class='match'>$c_nine</b></li>
					<li><b>Period 9: </b>$pp9 — $tt9 <b class='match'>$c_ten</b></li>
					<li><b>Period 10: </b>$pp10 — $tt10 <b class='match'>$c_eleven</b></li>
				</ul>
			";
			return array($u_dis, $f_dis);
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<title>HS Courser | Compare Schedules</title>
	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
			list-style: none;
			text-decoration: none;
		}
		.page_title{
			margin: 40px;
			text-align: center;
		}
		.page_title span{
			border-bottom: 3px solid cornflowerblue;
			font-size: 50px;
			padding: 10px;
			font-family: 'Montserrat', sans-serif;
		}
		.container{
			width: 100%;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.note{
			margin-top: 20px;
			font-family: arial;
			font-size: 30px;
		}
		.cols{
			margin-top: 40px;
			margin-bottom: 30px;
			display: table;
			width: 100%;
		}
		.cols span{
			display: table-cell;
		}
		.your_sched, .their_sched{
			width: 49%;
			vertical-align: middle;
			text-align: center;
			font-size: 50px;
		}
		.their_sched, .your_sched{
			border: 3px solid black;
			background-color: cornflowerblue;
		}
		h2{
			font-family: arial;
			margin-top: 10px;
			font-size: 40px;
		}
		.sched_ul{
			font-family: 'Indie Flower', cursive;
			font-size: 30px;
			background-color: cornflowerblue;
			padding: 10px;
		}
		.sched_ul li{
			margin: 20px;
			border: 2px solid black;
			border-radius: 5%;
		}
		.sched_ul li a{
			color: white;
		}
		.match{
			color: white;
		}
		.backer_link{
			margin-bottom: 50px;
			color: cornflowerblue;
			border: 2px solid black;
			font-family: arial;
			font-size: 20px;
			padding: 10px;
		}
		.backer_link:hover{
			background-color: cornflowerblue;
			color: black;
		}
	</style>
</head>
<body>
	<header>
		<?php require "header.php"; ?>
		<ul class="navigation">
			<a href="javascript:history.go(-1)" onMouuseOver="self.status.referrer;return true"><li><div>Back To Previous Page</div></li></a>
		</ul>
	</header>
	<main>
		<div class="page_title">
			<span>Comparing Schedules With <?php echo $friend_name; ?></span>
		</div>
		<div class="container">
			<span class="note">You should see the word "MATCH" in white if you have matching classes.</span>
		</div>
		<div class="cols">
			<span class="left"></span>
			<span class="your_sched"><?php echo displayer($uarr, $farr, "blahblah")[0]; ?></span>
			<span class="mid"></span>
			<span class="their_sched"><?php echo displayer($uarr, $farr, $friend_name)[1]; ?></span>
			<span class="right"></span>
		</div>
		<div class="container">
			<a href="javascript:history.go(-1)" onMouuseOver="self.status.referrer;return true" class="backer_link">Back To Previous Page</a>
		</div>
	</main>
	<footer>
		<?php require "footer.php"; ?>
	</footer>
</body>
</html>
