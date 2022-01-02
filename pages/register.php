<?php
$err_mess = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$full_name = trim($_POST["full_name"]);
	$email = trim($_POST["email"]);
	$username = str_replace(" ", "+", $full_name).strval(rand(0, 10000));
	$password = trim($_POST["password"]);
	$confpw = trim($_POST["confpw"]);
	$referred = trim($_POST["referred"]);
	$school = $_POST["select_school"];
	$pos_pages = array("explanation", "phpmyadmin", "about", "contact", "privacy", "terms", "register", "login", "dashboard", "forgotpassword", "logout", "schedule", "deleteschedule", "addfriends", "changename", "viewfriends", "deleteaccount","period0", "period1", "period2", "period3", "period4", "period5", "period6", "period7", "period8", "period9", "period10", "remove", "goals", "compare", "resolve", "changeschool", "favicon.ico");
	//validation
	if (!$full_name || !$email || !$username || !$password || !$confpw || !$referred || $school=="Select"){
		$err_mess = "All fields are required.";
	}
	elseif ($school=="email_request"){
		$err_mess = "<a href='https://mail.google.com/mail/u/0/#inbox?compose=new' target='_blank'>Send Request</a>. You can register once your school is added to the list.";
	}
	elseif (count(explode(" ", $full_name))<2){
		$err_mess = "Please include your full name (first and last).";
	}
	elseif (count(explode(" ", $referred))<2){
		$err_mess = "Please include the person's full name.";
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
				$sql = "INSERT INTO userdata (Fullname, School, Email, Username, Password, Referred) VALUES ('$full_name', '$school', '$email', '$username', '$password', '$referred')";
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
			color: red;
		}
		.checklist_textbox, .drop_down_menu{
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
								<input type="text" name="full_name" value="<?php if(isset($full_name)) {echo $full_name;} ?>" placeholder="Full Real Name" class="beg_text">
							</div>
						</div>
					</div>
					<div class="container">
						<div class="checklist_textbox">
							<div class="container">
								<input type="text" name="email" value="<?php if(isset($email)) {echo $email;} ?>" placeholder="Non-school Email" class="beg_text">
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
                                                <div class="checklist_textbox">
                                                        <div class="container">
                                                                <input type="text" placeholder="Who Told You About This Site (Full Name)" class="beg_text" name="referred" value="<?php if(isset($referred)) {echo $referred;} ?>" />
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="container">
                                                <div class="drop_down_menu">
                                                	Select School:
                                                	<select name="select_school">
                                                		<option value="Select">Select</option>
                                                		<option value="mhs+milpitas" <?php if(isset($school)){if($school=="mhs+milpitas"){echo "selected='selected'";}} ?>>MHS</option>
                                                		<option value="hhs+cupertino" <?php if(isset($school)){if($school=="hhs+cupertino"){echo "selected='selected'";}} ?>>Homestead</option>
                                                		<option value="sfhs+mountain_view" <?php if(isset($school)){if($school=="sfhs+mountain_view"){echo "selected='selected'";}} ?>>Saint Francis</option>
                                                		<option value="email_request" <?php if(isset($school)){if($school=="email_request"){echo "selected='selected'";}} ?>>Send School Request To hscourser@gmail.com</option>
                                                	</select>
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
