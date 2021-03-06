<?php
$err_mess = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$full_name = trim($_POST["full_name"]);
	$school = trim($_POST["school"]);
	$email = trim($_POST["email"]);
	$username = trim(stripslashes($_POST["username"]));
	$password = trim($_POST["password"]);
	$confpw = trim($_POST["confpw"]);
	$pos_pages = array("about", "contact", "privacy", "terms", "register", "login", "dashboard", "forgotpassword", "logout", "schedule", "deleteschedule", "addfriends", "changename", "viewfriends", "deleteaccount","period0", "period1", "period2", "period3", "period4", "period5", "period6", "period7", "period8", "period9", "period10", "remove", "goals", "compare", "resolve", "changeschool", "favicon.ico");
	//validation
	if (!$full_name || !$school || !$email || !$username || !$password || !$confpw){
		$err_mess = "All fields are required.";
	}
	elseif (count(explode(" ", $full_name))<2){
		$err_mess = "Please include your full name (first and last).";
	}
	elseif (strpos($school, "HS+")==False) {
		$err_mess = "Please make sure to include your school's abbreviation and the city it is in.";
	}
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$err_mess = "Please make sure your email address is valid.";
	}
	elseif (explode("@", $email)[1]=="student.musd.org"){
		$err_mess = "Please make sure you are not using your MUSD Email.";
	}
	elseif(preg_match('/\s/',$username) or strpos($username, "/")!=False){
		$err_mess = "Please make sure your username is correctly formatted (no spaces).";
	}
	elseif (in_array($username, $pos_pages)) {
		$err_mess = "This username is already taken.";
	}
	elseif (strlen($password)<8 || count(explode(" ", $password))>1){
		$err_mess = "Please make sure your password is formatted correctly.";
	}
	elseif (strcmp($password, $confpw)!==0){
		$err_mess = "Please make sure your confirmed password is the same as your initial password.";
	}
	else{
		$err_mess = "";
	}
	if ($err_mess==""){
		require_once("connection.php");
		$statement = "SELECT * FROM userdata WHERE Email='$email'";
		$q_statement = mysqli_query($conn, $statement);
		if (mysqli_num_rows($q_statement)>0){
			$err_mess = "This email is already taken.";
		}
		else{
			$statement_u = "SELECT * FROM userdata WHERE Username='$username'";
			$q_statement_u = mysqli_query($conn, $statement_u);
			if (mysqli_num_rows($q_statement_u)>0){
				$err_mess = "This display username is already taken.";
			}
			else{
				$password = md5($password);
				$school = strtolower($school);
				$sql = "INSERT INTO userdata (Fullname, School, Email, Username, Password) VALUES ('$full_name', '$school', '$email', '$username', '$password')";
				$result = mysqli_query($conn, $sql);
				if($result){
					header("Location: /login");
				}
				else{
					echo "Error: ".$sql;
				}
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
	<title>HS Courser | Register</title>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
			list-style: none;
			text-decoration: none;
		}
		.page_title{
			margin: 20px;
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
			width: 30%;
			justify-content: center;
			font-family: 'Montserrat', sans-serif;
			border: 3px solid cornflowerblue;
			padding: 30px;
			margin-bottom: 60px;
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
			color: cornflowerblue;
		}
		.checklist_textbox{
			margin: 10px;
		}
		#for_full_name{
			margin-top: 30px;
		}
		.beg_text{
			border: 2px solid black;
			background-color: cornflowerblue;
			height: 25px;
			width: 350px;
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
			<a href="/"><li><div>Back To Home</div></li></a>
		</ul>
	</header>
	<main>
		<div class="page_title">
			<span>Register</span>
		</div>
		<br><br>
		<div class="container">
			<div class="wrapper">
				<div>Already have an account? <a class="for_login_link" href="/login">Log In!</a></div>
				<div class="container">
					<span class="err"><?php echo $err_mess; ?></span>
				</div>
				<form class="check_form" action="/register" method="post">
					<div class="container">
						<div class="checklist_textbox" id="for_full_name">
							<div class="container">
								<input type="text" name="full_name" value="<?php if(isset($full_name)) {echo $full_name;} ?>" placeholder="Display Name/Full Real Name" class="beg_text">
							</div>
						</div>
					</div>
					<div class="container">
						<div class="checklist_textbox">
							<div class="container">
								<input type="text" name="school" value="<?php if(isset($school)) {echo $school;} ?>" placeholder="High School Abbreviation+City (Ex: NCPHS+Chicago)" class="beg_text">
							</div>
						</div>
					</div>
					<div class="container">
						<div class="checklist_textbox">
							<div class="container">
								<input type="text" name="email" value="<?php if(isset($email)) {echo $email;} ?>" placeholder="Non-MUSD Email" class="beg_text">
							</div>
						</div>
					</div>
					<div class="container">
						<div class="checklist_textbox">
							<div class="container">
								<input type="text" name="username" value="<?php if(isset($username)) {echo $username;} ?>" placeholder="Display Username" class="beg_text">
							</div>
						</div>
					</div>
					<div class="container">
						<div class="checklist_textbox">
							<div class="container">
								<input type="password" name="password" value="<?php if(isset($password)) {echo $password;} ?>" placeholder="HS Courser Password (>8)" class="beg_text">
							</div>
						</div>
					</div>
					<div class="container">
						<div class="checklist_textbox">
							<div class="container">
								<input type="password" name="confpw" value="<?php if(isset($confpw)) {echo $confpw;} ?>" placeholder="Confirm Password" class="beg_text">
							</div>
						</div>
					</div>
					<div class="container">
						<div id="submit1">
							<input type="submit" id="button" name="submit" value="Register">
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