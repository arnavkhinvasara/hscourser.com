<?php 
session_start();
if(!isset($_SESSION["session_email"])){
	header("Location: /login");
}
$sess_email = $_SESSION["session_email"];
$err_mess = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$newschool = $_POST["newschool"];
	//validation
	if (!$newschool){
		$err_mess = "School field is required.";
	}
	elseif (strpos($newschool, "HS+")==False) {
		$err_mess = "Please make sure to include your school's abbreviation and the city it is in.";
	}
	else{
		//query to update name for user
		require_once("connection.php");
		$newschool = strtolower($newschool);
		$u_statement = "UPDATE userdata SET School='$newschool' WHERE Email='$sess_email'";
		$qu_statement = mysqli_query($conn, $u_statement);
		header("Location: /dashboard");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<title>HS Courser | Change School</title>
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
			margin-bottom: 15px;
			color: cornflowerblue;
		}
		.beg_text{
			border: 2px solid black;
			background-color: cornflowerblue;
			height: 25px;
			width: 340px;
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
			padding: 5px;
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
			<a href="/dashboard"><li><div>Dashboard</div></li></a>
			<a href="/addfriends"><li><div>Add Friends</div></li></a>
			<a href="/changename"><li><div>Change Your Name</div></li></a>
		</ul>
	</header>
	<main>
		<div class="page_title">
			<span>Change Your School</span>
		</div>
		<br><br>
		<div class="container">
			<div class="wrapper">
				<div class="container">
					<span class="err"><?php echo $err_mess; ?></span>
				</div>
				<form method="post" action="/changeschool">
					<div class="container">
						<input type="text" name="newschool" class="beg_text" placeholder="High School Abbreviation+City (Ex: NCPHS+Chicago)" value="<?php if(isset($newschool)) {echo $newschool;} ?>">
					</div>
					<div class="container">
						<input type="submit" name="submit" id="button" value="Change">
					</div>
				</form>
			</div>
		</div>
	</main>
	<br><br><br><br><br><br><br>
	<footer>
		<?php require 'footer.php'; ?>
	</footer>
</body>
</html>