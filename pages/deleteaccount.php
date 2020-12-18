<?php
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
				$sql = "DELETE FROM userdata WHERE Email='$email'";
				$query = mysqli_query($conn, $sql);
				$sql_2 = "DELETE FROM usersched WHERE Email='$email'";
				$query_2 = mysqli_query($conn, $sql_2);
				$sql_3 = "DELETE FROM friends WHERE Email='$email'";
				$query_3 = mysqli_query($conn, $sql_3);
				$sql_4 = "DELETE FROM friends WHERE FriendEmail='$email'";
				$query_4 = mysqli_query($conn, $sql_4);
				$sql_5 = "DELETE FROM newfriends WHERE Email='$email'";
				$query_5 = mysqli_query($conn, $sql_5);
				$sql_6 = "DELETE FROM newfriends WHERE FriendEmail='$email'";
				$query_6 = mysqli_query($conn, $sql_6);
				$sql_7 = "DELETE FROM goals WHERE Email='$email'";
				$query_7 = mysqli_query($conn, $sql_7);
				$sql_8 = "DELETE FROM goals WHERE FriendEmail='$email'";
				$query_8 = mysqli_query($conn, $sql_8);
				header("Location: /login");
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
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<title>HS Courser | Delete Account</title>
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
		.err{
			margin-top: 15px;
			color: cornflowerblue;
		}
		.checklist_textbox{
			margin: 10px;
		}
		#for_email{
			margin-top: 15px;
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
			<a href="/login"><li><div>Login</div></li></a>
			<a href="/"><li><div>Home</div></li></a>
		</ul>
	</header>
	<main>
		<div class="page_title">
			<span>Delete Account</span>
		</div>
		<br><br>
		<div class="container">
			<div class="wrapper">
				<div class="container">
					<span class="err"><?php echo $err_mess; ?></span>
				</div>
				<form class="check_form" action="/deleteaccount" method="post">
					<div class="container">
						<div class="checklist_textbox" id="for_email">
							<div class="container">
								<input type="text" name="email" value="<?php if(isset($email)) {echo $email;} ?>" placeholder="Enter Email" class="beg_text">
							</div>
						</div>
					</div>
					<div class="container">
						<div class="checklist_textbox">
							<div class="container">
								<input type="password" name="password" value="<?php if(isset($password)) {echo $password;} ?>" placeholder="Enter Password" class="beg_text">
							</div>
						</div>
					</div>
					<div class="container">
						<div id="submit1">
							<input type="submit" id="button" name="submit" value="Submit">
						</div>
					</div>
				</form>
			</div>
		</div>
	</main>
	<footer>
		<?php require "footer.php"; ?>
	</footer>
</body>
</html>