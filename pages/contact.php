<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<title>HS Courser | Contact</title>
	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
			list-style: none;
			text-decoration: none;
		}
		.page_title{
			margin: 50px;
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
			margin-bottom: 110px;
		}
		.section_title{
			text-align: center;
			margin-bottom: 30px;
			font-size: 40px;
		}
		.about_ul, .about_p{
			margin-bottom: 40px;
			font-size: 20px;
		}
		p{
			font-size: 20px;
		}
	</style>
</head>
<body>
	<header>
		<?php require "header.php"; ?>
		<ul class="navigation">
			<a href="/about"><li><div>About HS Courser</div></li></a>
			<a href="/"><li><div>Back To Home</div></li></a>
		</ul>
	</header>
	<main>
		<div class="page_title">
			<span>Contact HS Courser</span>
		</div>
		<br><br>
		<div class="container">
			<div class="wrapper">
				<div class="section_title">Email</div>
				<ul class="about_ul">
					<li>hscourser@gmail.com</li>
				</ul>
			</div>
		</div>
	</main>
	<footer>
		<?php require 'footer.php';?>
	</footer>
</body>
</html>
