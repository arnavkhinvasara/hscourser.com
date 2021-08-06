<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<title>HS Courser | Terms of Service</title>
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
			<a href="/privacy"><li><div>Privacy Policy</div></li></a>
			<a href="/"><li><div>Back To Home</div></li></a>
		</ul>
	</header>
	<main>
		<div class="page_title">
			<span>HS Courser Terms of Service</span>
		</div>
		<br><br>
		<div class="container">
			<div class="wrapper">
				<div class="section_title">Our Services</div>
				<p class="about_p">We provide a personalized experience for you so that you can fulfill your own wishes, not wishes of a general population. Furthermore, we provide functional services for everyone. Finally, we figure out how to make our services better.</p>
				<div class="section_title">Your Commitments</div>
				<p>To begin with, only high school students may use HS Courser. However, you should provide factual information to us and not create multiple accounts. Sharing passwords is also an invasion of privacy and therefore not allowed.</p>
				<br>
				<p>Furthermore, uploading viruses and harmful code is prohibited. Accessing restricted data is not allowed either.</p>
				<br>
				<p class="about_p">Lastly, there are a couple permissions we need from you for us to continue providing our services. We need permisson to use your data to provide you with new information. We also need permission to update software you use.</p>
				<div class="section_title">Updates</div>
				<p class="about_p">If our terms need to be updated, we will notify you before we do so, unless otherwise required by the law. Once our updated terms are in effect, you are again bound to them.</p>
			</div>
		</div>
	</main>
	<footer>
		<?php require 'footer.php';?>
	</footer>
</body>
</html>