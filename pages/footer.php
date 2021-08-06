<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.footer{
			position: relative;
			width: 100%;
			height: 70px;
			background-color: black;
			padding-top: 20px;
			padding-bottom: 20px;
		}
		.footer_links{
			text-align: center;
		}
		.footer_links span a{
			color: cornflowerblue;
			border-bottom: 1px solid white;
		}
		.footer_links span a:hover{
			color: white;
			border-bottom: 1px solid cornflowerblue;
		}
		.footer_links span{
			margin: 10px;
		}
		.copyright{
			position: relative;
			-moz-user-select: none;
			-webkit-user-select: none;
			color: cornflowerblue;
			top: 50px;
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="footer">
		<div class="footer_links">
			<span><a href="/about">About</a></span>
			<span><a href="/contact">Contact Us</a></span>
			<span><a href="/privacy">Privacy</a></span>
			<span><a href="/terms">Terms</a></span>
			<?php if($_SERVER['REQUEST_URI']=="/login"){echo "<span><a href='/deleteaccount'>Delete Account</a></span>";} ?>
		</div>
		<div class="copyright">
			&copy; HS Courser, <?php echo date("Y");?>
		</div>
	</div>
</body>
</html>