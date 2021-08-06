<?php 
session_start();
if(!isset($_SESSION["session_email"])){
	header("Location: /login");
}
$sess_username = $_SESSION["session_username"];
$sess_email = $_SESSION["session_email"];
$sess_school = $_SESSION["session_school"];
$request = substr($_SERVER['REQUEST_URI'], 1);
$username_exploded = explode("/", $request);
$pos_periods = array("period0", "period1", "period2", "period3", "period4", "period5", "period6");
$checked = False;
if(count($username_exploded)==2){
	if (in_array($username_exploded[0], $pos_periods)) {
		$checked = True;
		$request = $username_exploded[1];
		$redirect = $username_exploded[0];
	}
}

if($sess_username!=$request){
	require_once("connection.php");
	//getting friend email given username
	$statement = "SELECT * FROM userdata WHERE Username='$request'";
	$q_statement = mysqli_query($conn, $statement);
	if(mysqli_num_rows($q_statement)>0){
		while ($row = mysqli_fetch_assoc($q_statement)){
			$friend_email = $row["Email"];
		}
	}
	//adding friend to friends database if not already there
	$c_statement = "SELECT * FROM friends WHERE Email='$sess_email'";
	$cq_statement = mysqli_query($conn, $c_statement);
	$do = True;
	if(mysqli_num_rows($cq_statement)>0){
		while ($row = mysqli_fetch_assoc($cq_statement)){
			$email_of_friend = $row["FriendEmail"];
			if ($email_of_friend==$friend_email) {
				$do = False;
				break;
			}
		}
	}
	require_once("sameschool.php");
	if ($do==True){
		if(checker($conn, $friend_email, $sess_school)==True){
			$a_statement = "INSERT INTO friends (Email, FriendEmail, FriendUsername) VALUES ('$sess_email', '$friend_email', '$request')";
			$aq_statement = mysqli_query($conn, $a_statement);
			$a2_statement = "INSERT INTO friends (Email, FriendEmail, FriendUsername) VALUES ('$friend_email', '$sess_email', '$sess_username')";
			$a2q_statement = mysqli_query($conn, $a2_statement);
			$aa_statement = "INSERT INTO newfriends (Email, FriendEmail, FriendUsername) VALUES ('$sess_email', '$friend_email', '$request')";
			$aaq_statement = mysqli_query($conn, $aa_statement);
			$aa2_statement = "INSERT INTO newfriends (Email, FriendEmail, FriendUsername) VALUES ('$friend_email', '$sess_email', '$sess_username')";
			$aa2q_statement = mysqli_query($conn, $aa2_statement);
		}
	}

	if($checked==True){
		header("Location: /$redirect");
	}
	else{
		header("Location: /viewfriends");
	}
}
else{
	header("Location: /dashboard");
}
?>