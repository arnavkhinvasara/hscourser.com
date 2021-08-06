<?php 
session_start();
if(!isset($_SESSION["session_email"])){
	header("Location: /login");
}
if(!isset($_SESSION["timestamp"])){
	$_SESSION["timestamp"] = time();
}
else{
	if((time() - $_SESSION["timestamp"]) > 172800){
		header("Location: /logout");
	}
}
$sess_email = $_SESSION["session_email"];
//make query to sql database for full name for corresponding email
$name = "";
$username = "";
require_once("connection.php");
$statement = "SELECT * FROM userdata WHERE Email='$sess_email'";
$q_statement = mysqli_query($conn, $statement);
if(mysqli_num_rows($q_statement)>0){
	while ($row = mysqli_fetch_assoc($q_statement)){
		$name = $row["Fullname"];
		$username = $row["Username"];
		$school = $row["School"];
	}
}
$_SESSION["session_username"] = $username;
$_SESSION["session_school"] = $school;
//query to see if user has already made schedule
require_once("schedchecker.php");
//displaying schedule if exists
require_once("displayschedule.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:ital,wght@1,300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<title>HS Courser | Dashboard</title>
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
		.changedata{
			color: cornflowerblue;
			font-family: 'Roboto', sans-serif;
			font-size: 20px;
			border: 2px solid black;
			padding: 7px;
		}
		.changedata a{
			color: black;
			border-bottom: 2px solid black;
		}
		.changedata a:hover{
			border-bottom: 4px solid cornflowerblue;
		}
		.scheduler{
			font-family: 'Open Sans Condensed', sans-serif;
			letter-spacing: 0.5px;
			font-weight: bold;
			font-size: 50px;
		}
		.scheduler a{
			color: cornflowerblue;
		}
		.for_sched{
			width: 70%;
			border: 2px solid cornflowerblue;
			text-align: center;
			padding: 30px;
			margin-top: 20px;
			margin-bottom: 40px;
			font-family: 'Open Sans Condensed', sans-serif;
			letter-spacing: 0.5px;
			font-weight: bold;
			font-size: 50px;
		}
		h2{
			font-family: arial;
			margin-bottom: 20px;
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
	</style>
</head>
<body>
	<header>
		<?php require "header.php"; ?>
		<ul class="navigation">
			<a href="/viewfriends"><li><div>View Friends</div></li></a>
			<a href="/addfriends"><li><div>Add Friends</div></li></a>
			<a href="/logout"><li><div>Logout</div></li></a>
		</ul>
	</header>
	<main>
		<div class="page_title">
			<br>
			<span>Hi <?php echo $name; ?> (<?php echo strtoupper(explode("+", $school)[0]); ?>)!</span>
		</div>
		<br><br>
		<div class="container">
			<span class="scheduler">
				<?php if($made_sched){echo "Update Schedule";} else{echo "Add Schedule";} ?> <a href="/schedule">Here</a>!
			</span>
		</div>
		<div class="container">
			<div class="for_sched">
				<?php if($made_sched==FALSE){echo "<b>No Schedule Created</b>";} else{dis_sched(array($d_0, $d_1, $d_2, $d_3, $d_4, $d_5, $d_6, $d_7, $d_8, $d_9, $d_10, $dt_0, $dt_1, $dt_2, $dt_3, $dt_4, $dt_5, $dt_6, $dt_7, $dt_8, $dt_9, $dt_10));}?>
			</div>
		</div>
		<div class="container">
			<span class="changedata">Change To Real Name? Click <a href="/changename">Here</a></span>
		</div>
		<br>
		<div class="container">
			<span class="changedata">Change To Real School? Click <a href="/changeschool">Here</a></span>
		</div>
		<br><br><br><br>
	</main>
	<footer>
		<?php require 'footer.php';?>
	</footer>
</body>
</html>