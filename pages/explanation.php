<?php 
session_start();
if(!isset($_SESSION["session_email"])){
	header("Location: /login");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<title>HS Courser | Still New Friend</title>
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
		.wrapper{
			width: 60%;
			justify-content: center;
			font-family: 'Montserrat', sans-serif;
			border: 3px solid cornflowerblue;
			padding: 30px;
			margin-bottom: 60px;
		}
		.section_title{
			text-align: center;
			margin-bottom: 30px;
			font-size: 40px;
		}
	</style>
</head>
<body>
	<header>
		<?php require "header.php"; ?>
		<ul class="navigation">
			<a href="javascript:history.go(-1)" onMouuseOver="self.status.referrer;return true"><li><div>Previous Page</div></li></a>
			<a href="/dashboard"><li><div>Dashboard</div></li></a>
		</ul>
	</header>
	<main>
		<br><br><br><br><br>
		<div class="container">
			<div class="wrapper">
				<div class="section_title">You are a new friend of this person. You as a new friend need to be recognized before you can view this person's schedule. Only friends who are not new friends of a person can view that person's schedule.</div>
			</div>
		</div>
	</main>
	<footer>
		<?php require 'footer.php';?>
	</footer>
</body>
</html>
