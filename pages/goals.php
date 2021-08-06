<?php 
session_start();
if(!isset($_SESSION["session_email"])){
	header("Location: /login");
}
$sess_email = $_SESSION["session_email"];
$request = substr($_SERVER['REQUEST_URI'], 1);
$request = "/".explode("/", $request)[0];
require_once("connection.php");
$s_statement = "SELECT * FROM goals WHERE Email='$sess_email'";
$s_query = mysqli_query($conn, $s_statement);
$goals = False;
$goal_people = array();
if(mysqli_num_rows($s_query)>0){
	$goals = True;
	while ($row = mysqli_fetch_assoc($s_query)){
		$goal_people[$row["FriendUsername"]] = $row["FriendName"];
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<title>HS Courser | Your Goals</title>
	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
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
		.negation{
			font-size: 30px;
			color: cornflowerblue;
		}
		.other_ppl div li{
			margin: 20px;
			font-size: 20px;
		}
		.other_ppl div li a{
			color: cornflowerblue;
			border-bottom: 2px solid black;
		}
	</style>
</head>
<body>
	<header>
		<?php require "header.php"; ?>
		<ul class="navigation">
			<a href="/dashboard"><li><div>Dashboard</div></li></a>
			<?php echo "<a href='$request'class='backer_link'><li><div>Back To Previous Page</div></li></a>"; ?>
		</ul>
	</header>
	<main>
		<div class="page_title">
			<span>Your Goals</span>
		</div>
		<br><br>
		<div class="container">
			<div class="wrapper">
				<div class="container">
					<ol class="other_ppl">
						<?php if($goals==False){echo "<span class='negation'>You have no goals</span>";} else{foreach($goal_people as $key => $value) echo "<div><li>Add and introduce yourself to $value (<a href='$request/resolve/$key'>Mark As Complete</a>)</li></div>";} ?>
					</ol>
				</div>
			</div>
		</div>
	</main>
	<?php if($goals==False){echo "<br><br><br><br><br><br><br><br>";} else{echo "<br><br><br><br><br><br><br>";}?>
	<footer>
		<?php require "footer.php"; ?>
	</footer>
</body>
</html>