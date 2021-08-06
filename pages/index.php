<?php 
session_start();
if(isset($_SESSION["session_email"])){
	header("Location: /dashboard");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>HS Courser | Home</title>
	<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
			text-decoration: none;
			list-style: none;
			-moz-user-select: none;
			-webkit-user-select: none;
		}
		html,body{
			height: 100%;
			background-size: cover;
		}
		.cols{
			margin-top: 70px;
			margin-bottom: 70px;
			display: table;
			height: 400px;
			width: 100%;
		}
		.cols span{
			display: table-cell;
		}
		.register, .login{
			width: 40%;
			vertical-align: middle;
			text-align: center;
			border-radius: 7%;
			font-size: 75px;
		}
		.register{
			border: 3px solid cornflowerblue;
			background-color: black;
		}
		.login{
			border: 3px solid black;
			background-color: cornflowerblue;
		}
		.reg_link div{
			display: inline-block;
			border-radius: 7%;
			padding: 20px;
			border: 3px solid white;
			font-family: 'Dancing Script', cursive;
			background-color: cornflowerblue;
			color: black;
		}
		.reg_link div:hover{
			background-color: black;
			color: cornflowerblue;
		}
		.log_link div{
			display: inline-block;
			border-radius: 7%;
			padding: 25px;
			border: 3px solid white;
			font-family: 'Dancing Script', cursive;
			background-color: black;
			color: cornflowerblue;
		}
		.log_link div:hover{
			background-color: cornflowerblue;
			color: black;
		}
	</style>
</head>
<body>
	<header>
		<?php require "header.php"; ?>
		<ul class="navigation">
			<a href="/about"><li><div>What is HS Courser?</div></li></a>
			<a href="/login"><li><div>Login</div></li></a>
		</ul>
	</header>
	<main>
		<div class="cols">
			<span class="left"></span>
			<span class="register"><a class="reg_link" href="/register"><div>Register</div></a></span>
			<span class="mid"></span>
			<span class="login"><a class="log_link" href="/login"><div>Login</div></a></span>
			<span class="right"></span>
		</div>
	</main>
	<footer>
		<?php require "footer.php"; ?>
	</footer>
</body>
</html>
