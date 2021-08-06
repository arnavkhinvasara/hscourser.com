<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<title>HS Courser | Privacy Policy</title>
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
			<a href="/terms"><li><div>Terms of Service</div></li></a>
			<a href="/"><li><div>Back To Home</div></li></a>
		</ul>
	</header>
	<main>
		<div class="page_title">
			<span>HS Courser Privacy Policy</span>
		</div>
		<br><br>
		<div class="container">
			<div class="wrapper">
				<div class="section_title">The Information We Collect</div>
				<p class="about_p">We collect your full name, email address, and high school schedule. We do not collect your usage and connections data.</p>
				<div class="section_title">Using Information</div>
				<p class="about_p">We collect this information to store it. We only share your schedule with others, upon your permission. We use your email address for verification purposes.</p>
				<div class="section_title">Deleting Information</div>
				<p class="about_p">We store your data until it is no longer necessary to provide our services.</p>
				<div class="section_title">Responding to Legal Requests</div>
				<p class="about_p">We share your information to regulators and law enforcement in good faith. We believe that it is important to cooperate to address illegal/harmful activity, to prevent injury or death, and to protect ourselves.</p>
				<div class="section_title">Policy Amendment Notifications</div>
				<p class="about_p">We will make sure you are notified with the changes and given the opportunity to stop using our products.</p>
			</div>
		</div>
	</main>
	<footer>
		<?php require 'footer.php';?>
	</footer>
</body>
</html>