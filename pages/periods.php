<?php 
session_start();
if(!isset($_SESSION["session_email"])){
	header("Location: /login");
}
$sess_email = $_SESSION["session_email"];
$sess_school = $_SESSION["session_school"];
$request = $_SERVER['REQUEST_URI'];
$P = "P".$request[7];
$T = "T".$request[7];
if(strlen($request)==9){
	$P = "P".$request[7].$request[8];
	$T = "T".$request[7].$request[8];
}
require_once("connection.php");
$r_statement = "SELECT * FROM usersched WHERE Email='$sess_email'";
$r_query = mysqli_query($conn, $r_statement);
$anyone = True;
if(mysqli_num_rows($r_query)>0){
	while ($row = mysqli_fetch_assoc($r_query)){
		$class = strtolower($row[$P]);
		$teacher = strtolower($row[$T]);
	}
}
else{
	$anyone = False;
}
if ($class=="") {
	$anyone = False;
}
require_once("sameschool.php");
$g_statement = "SELECT * FROM usersched WHERE Email!='$sess_email'";
$g_query = mysqli_query($conn, $g_statement);
$classmates_array = array();
if(mysqli_num_rows($g_query)>0){
	while ($row = mysqli_fetch_assoc($g_query)){
		if(strtolower($row[$P])==$class and strtolower($row[$T])==$teacher and checker($conn, $row["Email"], $sess_school)==True){
			array_push($classmates_array, $row["Email"]);
		}
	}
}
else{
	$anyone = False;
}
if(count($classmates_array)<=0){
	$anyone = False;
}
$poss_periods_array = array("/period0", "/period1", "/period2", "/period3", "/period4", "/period5", "/period6", "/period7", "/period8", "/period9", "/period10");
$cleaned_periods = array();
foreach ($poss_periods_array as $value) {
	if($value==$request){
		continue;
	}
	if(strlen($value)==8){
		$cleaned_periods[$value] = $value[7];
	}
	else{
		$cleaned_periods[$value] = $value[7].$value[8];
	}
}
function check_if_friend($x, $y){
	$conn = mysqli_connect("localhost", "phpmyadmin", "waterfall4me", "database", "3306");
	$friends_array = array();
	$not_friends_array = array();
	foreach ($x as $value) {
		$c_statement = "SELECT * FROM friends WHERE FriendEmail='$value'";
		$c_query = mysqli_query($conn, $c_statement);
		$friend = False;
		if (mysqli_num_rows($c_query)>0) {
			while($row = mysqli_fetch_assoc($c_query)){
				$email = $row["Email"];
				if($email==$y){
					$friend = True;
					break;
				}
			}
		}
		if($friend==True){
			array_push($friends_array, $value);
			continue;
		}
		array_push($not_friends_array, $value);
	}
	return array($friends_array, $not_friends_array);
}
$friends_split = check_if_friend($classmates_array, $sess_email);
$friend_classmates = $friends_split[0];
$notfriend_classmates = $friends_split[1];
function updating_notfriend_classmates($x){
	if (count($x)<=5) {
		return $x;
	}
	$hold_5 = array();
	for($i=0; $i < 5; $i++){
		$r_index = rand(0, count($x)-1);
		if(in_array($r_index, $hold_5)){
			while ("hii"=="hii"){
				$r_index = rand(0, count($x)-1);
				if(!in_array($r_index, $hold_5)){
					break;
				}
			}
		}
		array_push($hold_5, $r_index);
	}
	$y = array();
	foreach ($hold_5 as $num) {
		array_push($y, $x[$num]);
	}
	return $y;
}
$notfriend_classmates_2 = updating_notfriend_classmates($notfriend_classmates);
function email_to_name($x){
	$conn = mysqli_connect("localhost", "phpmyadmin", "waterfall4me", "database", "3306");
	$f_statement = "SELECT * FROM userdata WHERE Email='$x'";
	$f_query = mysqli_query($conn, $f_statement);
	while ($row = mysqli_fetch_assoc($f_query)){
		return array($row["Fullname"], $row["Username"]);
	}
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	foreach ($notfriend_classmates_2 as $friend_email) {
		$friend_name = email_to_name($friend_email)[0];
		$friend_username = email_to_name($friend_email)[1];
		///check if friend already in goals
		$s_statement = "SELECT * FROM goals WHERE Email='$sess_email' AND FriendEmail='$friend_email'";
		$s_query = mysqli_query($conn, $s_statement);
		if (mysqli_num_rows($s_query)>0){
			continue;
		}
		$i_statement = "INSERT INTO goals (Email, FriendEmail, FriendUsername, FriendName) VALUES ('$sess_email', '$friend_email', '$friend_username', '$friend_name')";
		$i_query = mysqli_query($conn, $i_statement);
	}
	header("Location: $request/goals");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<title>HS Courser | Classmates</title>
	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
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
		.other_periods a{
			color: cornflowerblue;
		}
		.other_periods {
			margin-bottom: 20px;
		}
		.sub_title{
			font-weight: bold;
			font-size: 50px;
			color: cornflowerblue;
			margin: 20px;
		}
		.other_ppl div li{
			margin: 8px;
		}
		.other_ppl div li a{
			color: cornflowerblue;
			border-bottom: 2px solid black;
		}
		.indicator{
			font-size: 30px;
			margin-bottom: 30px;
		}
		.holder{
			width: 70%;
			margin-bottom: 30px;
		}
		.indicator_2{
			font-size: 20px;
		}
		.indicator_2 b{
			color: cornflowerblue;
		}
		.label{
			margin-top: 20px;
		}
		.for_goals{
			color: cornflowerblue;
			border-bottom: 2px solid black;
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
			<a href="/dashboard"><li><div>Dashboard</div></li></a>
			<a href="/addfriends"><li><div>Add Friends</div></li></a>
			<a href="/viewfriends"><li><div>View Friends</div></li></a>
		</ul>
	</header>
	<main>
		<div class="page_title">
			<span>Period <?php if(strlen($request)==9){echo $request[7].$request[8];} else{echo $request[7];}?> Classmates</span>
		</div>
		<br><br>
		<div class="container">
			<div class="wrapper">
				<div class="container"><span class="other_periods">Periods: <?php foreach ($cleaned_periods as $key=>$value) {echo "(<a href='$key'>$value</a>) ";}?></span></div>
				<div class="container">
					<ul class="other_ppl">
						<?php if($anyone==False){echo "<span class='no_mates'>You do not have any classmates (using HS Courser). If this may be an error in typing out your schedule, you can check your schedule for accuracy and read the instructions.</span>";} else{echo "<div class='container'><span class='sub_title'>Friend Classmates</span></div>"; if(count($friend_classmates)==0){ echo "<div class='container'><span>You have no classmates that are 'Friends' using HS Courser</span></div>";} else{foreach ($friend_classmates as $value) {$value_2 = email_to_name($value)[0]; $href = email_to_name($value)[1]; echo "<div class='container'><li>$value_2 (<a href='/compare/$href'>Compare Schedules</a>)</li></div>";}} echo "<div class='container'><span class='sub_title'>Non-Friend Classmates</span></div>"; if(count($notfriend_classmates)==0){ echo "<div class='container'><span>You have no classmates that are not your 'Friends' using HS Courser</span></div>";} else{echo "<div class='container'><span class='indicator'>Make New Friends!!</span></div>"; if(count($notfriend_classmates)>5){echo "<div class='container'><div class='holder'><span class='indicator_2'>Here are five random classmates (not all are included and the list changes every time you open this page).</span></div></div>";} echo "<div class='container'><div class='holder'><span class='indicator_2'>Your <b>GOAL</b>: Add and introduce yourself (using Gmail, Instagram, etc.) to these classmates.</span></div></div>"; foreach ($notfriend_classmates_2 as $value) {$value_2 = email_to_name($value)[0]; $href = email_to_name($value)[1]; echo "<div class='container'><li>$value_2 (<a href='$request/$href'>Add</a>)</li></div>";} echo "<div class='container'><span class='label'>Add these classmates to your <a href='$request/goals' class='for_goals'>goals</a></span></div><div class='container'><div id='submit1'><form method='post' action='$request'><input type='submit' id='button' name='submit' value='Add'/></form></div></div>"; }}?>
					</ul>
				</div>
			</div>
		</div>
	</main>
	<?php if($anyone==False){echo "<br><br><br><br><br><br><br><br>";} else{echo "<br><br><br><br><br><br><br>";}?>
	<footer>
		<?php require "footer.php"; ?>
	</footer>
</body>
</html>
