<?php 
session_start();
if(!isset($_SESSION["session_email"])){
	header("Location: /login");
}
$sess_email = $_SESSION["session_email"];
require_once("connection.php");
$s_statement = "SELECT * FROM friends WHERE Email='$sess_email'";
$s_query = mysqli_query($conn, $s_statement);
$have_friends = False;
$friend_usernames = array();
if(mysqli_num_rows($s_query)>0){
	$have_friends = True;
	while ($row = mysqli_fetch_assoc($s_query)){
		array_push($friend_usernames, $row["FriendUsername"]);
	}
}
$friends_array = array();
if($have_friends==True){
	foreach ($friend_usernames as $value) {
		$c_statement = "SELECT * FROM userdata WHERE Username='$value'";
		$c_query = mysqli_query($conn, $c_statement);
		if(mysqli_num_rows($c_query)>0){
			while ($row = mysqli_fetch_assoc($c_query)){
				$friends_array[$value] = $row["Fullname"];
			}
		}
	}
}
function new_friend($x, $y){
	$conn = mysqli_connect("localhost", "phpmyadmin", "waterfall4me", "database", "3306");
	$ch_statement = "SELECT * FROM newfriends WHERE Email='$x' AND FriendUsername='$y'";
	$ch_query = mysqli_query($conn, $ch_statement);
	$new_friend = False;
	if(mysqli_num_rows($ch_query)>0){
		$new_friend = True;
	}
	return $new_friend;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$d_statement = "DELETE FROM newfriends WHERE Email='$sess_email'";
	$d_query = mysqli_query($conn, $d_statement);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<title>HS Courser | View Friends</title>
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
		.other_ppl{
			list-style: initial;
		}
		.other_ppl span a{
			color: cornflowerblue;
		}
		.other_ppl li{
			margin: 12px;
		}
		.other_ppl li a{
			color: cornflowerblue;
			border-bottom: 2px solid black;
		}
		.adding{
			font-size: 18px;
			margin-bottom: 20px;
		}
		.adding a{
			color: cornflowerblue;
		}
		.nfb{
			font-size: 20px;
			color: cornflowerblue;
			margin-bottom: 20px;
		}
		.label{
			margin-top: 20px;
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
			<a href="/addfriends"><li><div>Add Friends</div></li></a>
			<a href="/dashboard"><li><div>Back To Dashboard</div></li></a>
		</ul>
	</header>
	<main>
		<div class="page_title">
			<span>View Your Friends</span>
		</div>
		<br><br>
		<div class="container">
			<div class="wrapper">
				<div class="container">
					<ol class="other_ppl">
						<?php if ($have_friends==False){echo "<span>You do not have friends. Add friends <a href='/addfriends'>here</a></span>";} else{ echo "<div class='container'><span class='adding'>Add friends <a href='/addfriends'>here</a></span></div><div class='container'><span class='nfb'>New friends at bottom</span></div>"; foreach ($friends_array as $key => $value){ if(new_friend($sess_email, $key)){echo "<div class='container'><li>(<a href='/compare/$key'>Compare Schedules</a>) <b>NEW: </b>$value (<a href='/remove/$key'>Unfriend</a>)</li></div>";} else{echo "<div class='container'><li>(<a href='/compare/$key'>Compare Schedules</a>) $value (<a href='/remove/$key'>Unfriend</a>)</li></div>";}} echo "<div class='container'><span class='label'>Press if you've seen new friends</span></div><div class='container'><div id='submit1'><form method='post' action='/viewfriends'><input type='submit' id='button' name='submit' value='Seen'/></form></div></div>";}?>
					</ol>
				</div>
			</div>
		</div>
	</main>
	<?php if($have_friends==False){echo "<br><br><br><br><br><br><br><br>";} else{echo "<br><br><br><br><br><br><br>";}?>
	<footer>
		<?php require 'footer.php';?>
	</footer>
</body>
</html>
