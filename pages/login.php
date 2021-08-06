<?php
session_start();
$err_mess = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = $_POST["email"];
	$password = $_POST["password"];
	//validation
	if (!$email || !$password){
		$err_mess = "All fields are required.";
	}
	else{
		require_once("connection.php");
		$statement = "SELECT * FROM userdata WHERE Email='$email'";
		$q_statement = mysqli_query($conn, $statement);
		if (mysqli_num_rows($q_statement)<=0){
			$err_mess = "The email you have entered does not match an account.";
		}
		else{
			$password_2 = md5($password);
			$p_statement = "SELECT * FROM userdata WHERE Email='$email' AND Password='$password_2'";
			$qp_statement = mysqli_query($conn, $p_statement);
			if (mysqli_num_rows($qp_statement)<=0){
				$err_mess = "Your password does not match.";
			}
			else{
				$_SESSION["session_email"] = $email;
				header("Location: /");
			}
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>HS Courser | Login</title>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
			list-style: none;
			text-decoration: none;
		}
		.page_title{
			margin-top: 30px;
			margin-bottom: 10px;
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
			width: 25%;
			justify-content: center;
			font-family: 'Montserrat', sans-serif;
			border: 3px solid cornflowerblue;
			padding: 30px;
			margin-top: 20px;
			margin-bottom: 105px;
		}
		.wrapper div{
			text-align: center;
		}
		.for_login_link{
			color: cornflowerblue;
			border-bottom: 2px solid black;
		}
		.for_login_link:hover{
			color: black;
			border-bottom: 3px solid cornflowerblue;
		}
		.err{
			margin-top: 15px;
			color: red;
		}
		.checklist_textbox{
			margin: 10px;
		}
		#for_email{
			margin-top: 30px;
		}
		.beg_text{
			border: 2px solid black;
			background-color: cornflowerblue;
			height: 25px;
			width: 225px;
			border-radius: 5%;
			padding-left: 10px;
		}
		.beg_text::placeholder{
			color: white;
			opacity: 1;
		}
		.beg_text:hover{
			border: 3px solid cornflowerblue;
			background-color: black;
			color: white;
		}
		.beg_text:focus{
			background-color: black;
			border: 4px solid cornflowerblue;
			color: white;
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
			<a href="/register"><li><div>Register</div></li></a>
			<a href="/"><li><div>Back To Home</div></li></a>
		</ul>
	</header>
	<main>
		<div class="page_title">
			<span>Login</span>
		</div>
		<br><br>
		<div class="container">
			<div class="wrapper">
				<div>Do not have an account? <a class="for_login_link" href="/register">Create Account!</a></div>
				<div class="container">
					<span class="err"><?php echo $err_mess; ?></span>
				</div>
				<form class="check_form" action="/login" method="post">
					<div class="container">
						<div class="checklist_textbox" id="for_email">
							<div class="container">
								<input type="text" name="email" value="<?php if(isset($email)) {echo $email;} ?>" placeholder="Email" class="beg_text">
							</div>
						</div>
					</div>
					<div class="container">
						<div class="checklist_textbox">
							<div class="container">
								<input type="password" name="password" value="<?php if(isset($password)) {echo $password;} ?>" placeholder="Password" class="beg_text">
							</div>
						</div>
					</div>
					<div class="container">
						<div id="submit1">
							<input type="submit" id="button" name="submit" value="Login">
						</div>
					</div>
					<br>
					<div><a href="/forgotpassword" class="for_login_link">Forgot Password</a></div>
				</form>
			</div>
		</div>
	</main>
	<footer>
		<?php require "footer.php"; ?>
	</footer>
</body>
</html>
