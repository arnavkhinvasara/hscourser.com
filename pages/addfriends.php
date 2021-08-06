<?php 
session_start();
if(!isset($_SESSION["session_email"])){
	header("Location: /login");
}
$sess_username = $_SESSION["session_username"];
require_once("connection.php");
$s_statement = "SELECT * FROM userdata WHERE Username='$sess_username'";
$s_query = mysqli_query($conn, $s_statement);
while ($row = mysqli_fetch_assoc($s_query)){
	$user_school = $row["School"];
}

$info_array = array();
$text = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$text = $_POST["addfriends"];
	//query to obtain list of names that have text var in them
	$statement = "SELECT * FROM userdata WHERE Username!='$sess_username' AND School='$user_school' AND Fullname LIKE '%".$text."%'";
	$q_statement = mysqli_query($conn, $statement);
	if(mysqli_num_rows($q_statement)>0){
		while ($row = mysqli_fetch_assoc($q_statement)){
			$info_array[$row["Username"]] = $row["Fullname"];
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
	<title>HS Courser | Add Friends</title>
	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
			text-decoration: none;
		}
		.page_title{
			margin: 60px;
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
			margin-bottom: 80px;
		}
		.beg_text{
			border: 2px solid black;
			background-color: cornflowerblue;
			height: 25px;
			width: 290px;
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
		}
		#button:hover{
			border: 2px solid black;
			background-color: white;
			color: black;
		}
		.other_ppl span a{
			color: cornflowerblue;
		}
		.other_ppl{
			list-style: initial;
			margin-top: 20px;
		}
		.other_ppl li{
			margin: 12px;
		}
		.other_ppl li a{
			color: cornflowerblue;
			border-bottom: 2px solid black;
		}
	</style>
</head>
<body>
	<header>
		<?php require "header.php"; ?>
		<ul class="navigation">
			<a href="/dashboard"><li><div>Back To Dashboard</div></li></a>
			<a href="/viewfriends"><li><div>View Friends</div></li></a>
		</ul>
	</header>
	<main>
		<div class="page_title">
			<span>Add Friends</span>
		</div>
		<br><br>
		<div class="container">
			<div class="wrapper">
				<form method="post" action="/addfriends">
					<div class="container">
						<input type="text" name="addfriends" placeholder="Search For Full Names, Not Usernames" class="beg_text">
						<input type="submit" name="submit" id="button" value="Search">
					</div>
				</form>
				<div class="container">
					<ol class="other_ppl">
						<?php if ($text!="" and count($info_array)==0){echo "<span>No student was found. If you might have misspelled your school abbreviation, you can change it <a href='/changeschool'>here</a></span>";} else{foreach ($info_array as $key => $value) {if($key!=$sess_username){echo "<li>$value (<a href='/$key'>Add</a>)</li>";}}}?>
					</ol>
				</div>
			</div>
		</div>
	</main>
	<br><br><br><br><br><br><br>
	<footer>
		<?php require "footer.php"; ?>
	</footer>
</body>
</html>