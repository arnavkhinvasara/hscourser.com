<?php 
session_start();
if(!isset($_SESSION["session_email"])){
	header("Location: /login");
}
$sess_email = $_SESSION["session_email"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	require_once("connection.php");
	$sql = "DELETE FROM usersched WHERE Email='$sess_email'";
	$query = mysqli_query($conn, $sql);
	if($query){
		header("Location: /schedule");
	}
	else{
		echo "Error: ".$sql;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<title>HS Courser | Delete Schedule</title>
	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
			list-style: none;
			text-decoration: none;
		}
		.container{
			width: 100%;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		span{
			background-color: cornflowerblue;
			border-radius: 7%;
			padding: 10px;
			font-size: 50px;
			font-family: arial;
		}
		input{
			position: relative;
			margin-left: 20px;
			bottom: 10px;
		}
		a{
			margin-right: 20px;
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
		a div{
			color: white;
			font-family: 'Montserrat', sans-serif;
			letter-spacing: 0.5px;
			background-color: black;
			padding: 7px;
			border-radius: 7%;
		}
		a div:hover{
			background-color: white;
			border: 3px solid black;
			color: black;
		}
	</style>
</head>
<body>
	<br><br><br><br><br><br><br>
	<div class="container"><span>Note: This is if you want to have no schedule for yourself or for others to see. If you do and you just want to update your schedule, you can do so directly on the previous page (the Schedule Page).</span></div>
	<br><br><br><br><br><br><br><br>
	<div class="container">
		<a href="/schedule"><div>Back/Schedule Page</div></a>
		<form action="/deleteschedule" method="post">
			<input type="submit" id="button" name="submit" value="Confirm Delete">
		</form>
	</div>
</body>
</html>