<?php 
session_start();
if(!isset($_SESSION["session_email"])){
	header("Location: /login");
}
$sess_email = $_SESSION["session_email"];
//query to see if user has already made schedule
require_once("schedchecker.php");
$err_mess = "";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$p0 = $_POST["p0"];
	$p1 = $_POST["p1"];
	$p2 = $_POST["p2"];
	$p3 = $_POST["p3"];
	$p4 = $_POST["p4"];
	$p5 = $_POST["p5"];
	$p6 = $_POST["p6"];
	$p7 = $_POST["p7"];
	$p8 = $_POST["p8"];
	$p9 = $_POST["p9"];
	$p10 = $_POST["p10"];
	$t0 = str_replace("'", "", $_POST["t0"]);
	$t1 = str_replace("'", "", $_POST["t1"]);
	$t2 = str_replace("'", "", $_POST["t2"]);
	$t3 = str_replace("'", "", $_POST["t3"]);
	$t4 = str_replace("'", "", $_POST["t4"]);
	$t5 = str_replace("'", "", $_POST["t5"]);
	$t6 = str_replace("'", "", $_POST["t6"]);
	$t7 = str_replace("'", "", $_POST["t7"]);
	$t8 = str_replace("'", "", $_POST["t8"]);
	$t9 = str_replace("'", "", $_POST["t9"]);
	$t10 = str_replace("'", "", $_POST["t10"]);
	if ($made_sched==FALSE){
		$sql = "INSERT INTO usersched (Email, P0, T0, P1, T1, P2, T2, P3, T3, P4, T4, P5, T5, P6, T6, P7, T7, P8, T8, P9, T9, P10, T10) VALUES ('$sess_email','$p0','$t0','$p1', '$t1','$p2', '$t2', '$p3', '$t3', '$p4', '$t4','$p5', '$t5','$p6', '$t6', '$p7', '$t7', '$p8', '$t8', '$p9', '$t9', '$p10', '$t10')";
		$result = mysqli_query($conn, $sql);
		if($result){
			header("Location: /dashboard");
		}
		else{
			echo "Error: ".$sql;
		}
	}
	else{
		$u_statement = "UPDATE usersched SET P0='$p0',P1='$p1',P2='$p2',P3='$p3',P4='$p4',P5='$p5',P6='$p6',P7='$p7',P8='$p8',P9='$p9',P10='$p10',T0='$t0',T1='$t1',T2='$t2',T3='$t3',T4='$t4',T5='$t5',T6='$t6',T7='$t7',T8='$t8',T9='$t9',T10='$t10'  WHERE Email='$sess_email'";
		$qu_statement = mysqli_query($conn, $u_statement);
		header("Location: /dashboard");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<title>HS Courser | Schedule</title>
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
		.wrapper{
			width: 60%;
			justify-content: center;
			font-family: 'Montserrat', sans-serif;
			border: 3px solid cornflowerblue;
			padding: 30px;
			margin-bottom: 60px;
		}
		.desc a{
			color: cornflowerblue;
		}
		.err{
			margin-top: 15px;
			color: cornflowerblue;
		}
		form{
			margin-top: 30px;
		}
		.beg_text{
			border: 2px solid black;
			background-color: cornflowerblue;
			height: 25px;
			width: 300px;
			border-radius: 5%;
			padding-left: 10px;
			margin-left: 5px;
			margin-bottom: 15px;
		}
		label{
			margin-bottom: 15px;
		}
		.beg_text::placeholder{
			color: white;
			opacity: 1;
		}
		.beg_text:hover{
			border: 3px solid cornflowerblue;
			background-color: black;
			color: white;
		}
		.beg_text:focus{
			background-color: black;
			border: 4px solid cornflowerblue;
			color: white;
		}
		#button{
			background-color: black;
			padding: 10px;
			color: white;
			border-radius: 10%;
			margin-top: 20px;
		}
		#button:hover{
			border: 2px solid black;
			background-color: white;
			color: black;
		}
	</style>
</head>
<body>
	<header>
		<?php require "header.php"; ?>
		<ul class="navigation">
			<a href="/deleteschedule"><li><div>Delete Schedule</div></li></a>
			<a href="/dashboard"><li><div>Back To Dashboard</div></li></a>
		</ul>
	</header>
	<main>
		<div class="page_title">
			<span><?php if($made_sched){echo "Updating";} else{echo "Creating";} ?> Class Schedule</span>
		</div>
		<br><br>
		<div class="container">
			<div class="wrapper">
				<span class="desc">Please fill out your schedule correctly/accurately (as it appears in your "grades" platform). If you don't have a class during a certain period, don't fill in that period's class and teacher last name. Please capitalize appropriately, as everything is a proper noun. Precision matters to receive the best results. Your course names need to be entered fully/appropriately, as they appear in your "grades" platform (if you have "AP" instead of "Advanced Placement," you write "AP"). Exclude Mr./Ms./Mrs. from you teachers' last names.</span>
				<div class="container">
					<span class="err"><?php echo $err_mess; ?></span>
				</div>
				<form action="/schedule" method="post">
					<div class="container">
						<label><b>Period 0</b></label>
					</div>
					<div class="container">
						<input type="text" name="p0" class="beg_text" placeholder="Full Course Name" value="<?php if(isset($p0)){echo $p0;} elseif($made_sched){echo $d_0;}?>">
						<input type="text" name="t0" class="beg_text" placeholder="Teacher Last Name" value="<?php if(isset($t0)){echo $t0;} elseif($made_sched){echo $dt_0;}?>">
					</div>
					<br>
					<div class="container">
						<label><b>Period 1</b></label>
					</div>
					<div class="container">
						<input type="text" name="p1" class="beg_text" placeholder="Full Course Name" value="<?php if(isset($p1)){echo $p1;} elseif($made_sched){echo $d_1;}?>">
						<input type="text" name="t1" class="beg_text" placeholder="Teacher Last Name" value="<?php if(isset($t1)){echo $t1;} elseif($made_sched){echo $dt_1;}?>">
					</div>
					<br>
					<div class="container">
						<label><b>Period 2</b></label>
					</div>
					<div class="container">
						<input type="text" name="p2" class="beg_text" placeholder="Full Course Name" value="<?php if(isset($p2)){echo $p2;} elseif($made_sched){echo $d_2;}?>">
						<input type="text" name="t2" class="beg_text" placeholder="Teacher Last Name" value="<?php if(isset($t2)){echo $t2;} elseif($made_sched){echo $dt_2;}?>">
					</div>
					<br>
					<div class="container">
						<label><b>Period 3</b></label>
					</div>
					<div class="container">
						<input type="text" name="p3" class="beg_text" placeholder="Full Course Name" value="<?php if(isset($p3)){echo $p3;} elseif($made_sched){echo $d_3;}?>">
						<input type="text" name="t3" class="beg_text" placeholder="Teacher Last Name" value="<?php if(isset($t3)){echo $t3;} elseif($made_sched){echo $dt_3;}?>">
					</div>
					<br>
					<div class="container">
						<label><b>Period 4</b></label>
					</div>
					<div class="container">
						<input type="text" name="p4" class="beg_text" placeholder="Full Course Name" value="<?php if(isset($p4)){echo $p4;} elseif($made_sched){echo $d_4;}?>">
						<input type="text" name="t4" class="beg_text" placeholder="Teacher Last Name" value="<?php if(isset($t4)){echo $t4;} elseif($made_sched){echo $dt_4;}?>">
					</div>
					<br>
					<div class="container">
						<label><b>Period 5</b></label>
					</div>
					<div class="container">
						<input type="text" name="p5" class="beg_text" placeholder="Full Course Name" value="<?php if(isset($p5)){echo $p5;} elseif($made_sched){echo $d_5;}?>">
						<input type="text" name="t5" class="beg_text" placeholder="Teacher Last Name" value="<?php if(isset($t5)){echo $t5;} elseif($made_sched){echo $dt_5;}?>">
					</div>
					<br>
					<div class="container">
						<label><b>Period 6</b></label>
					</div>
					<div class="container">
						<input type="text" name="p6" class="beg_text" placeholder="Full Course Name" value="<?php if(isset($p6)){echo $p6;} elseif($made_sched){echo $d_6;}?>">
						<input type="text" name="t6" class="beg_text" placeholder="Teacher Last Name" value="<?php if(isset($t6)){echo $t6;} elseif($made_sched){echo $dt_6;}?>">
					</div>
					<div class="container">
						<label><b>Period 7</b></label>
					</div>
					<div class="container">
						<input type="text" name="p7" class="beg_text" placeholder="Full Course Name" value="<?php if(isset($p7)){echo $p7;} elseif($made_sched){echo $d_7;}?>">
						<input type="text" name="t7" class="beg_text" placeholder="Teacher Last Name" value="<?php if(isset($t7)){echo $t7;} elseif($made_sched){echo $dt_7;}?>">
					</div>
					<div class="container">
						<label><b>Period 8</b></label>
					</div>
					<div class="container">
						<input type="text" name="p8" class="beg_text" placeholder="Full Course Name" value="<?php if(isset($p8)){echo $p8;} elseif($made_sched){echo $d_8;}?>">
						<input type="text" name="t8" class="beg_text" placeholder="Teacher Last Name" value="<?php if(isset($t8)){echo $t8;} elseif($made_sched){echo $dt_8;}?>">
					</div>
					<div class="container">
						<label><b>Period 9</b></label>
					</div>
					<div class="container">
						<input type="text" name="p9" class="beg_text" placeholder="Full Course Name" value="<?php if(isset($p9)){echo $p9;} elseif($made_sched){echo $d_9;}?>">
						<input type="text" name="t9" class="beg_text" placeholder="Teacher Last Name" value="<?php if(isset($t9)){echo $t9;} elseif($made_sched){echo $dt_9;}?>">
					</div>
					<div class="container">
						<label><b>Period 10</b></label>
					</div>
					<div class="container">
						<input type="text" name="p10" class="beg_text" placeholder="Full Course Name" value="<?php if(isset($p10)){echo $p10;} elseif($made_sched){echo $d_10;}?>">
						<input type="text" name="t10" class="beg_text" placeholder="Teacher Last Name" value="<?php if(isset($t10)){echo $t10;} elseif($made_sched){echo $dt_10;}?>">
					</div>
					<div class="container">
						<input type="submit" name="submit" id="button" value="Finish">
					</div>
				</form>
			</div>
		</div>
	</main>
	<footer>
		<?php require 'footer.php';?>
	</footer>
</body>
</html>
