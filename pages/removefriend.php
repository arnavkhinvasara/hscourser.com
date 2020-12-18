<?php 
session_start();
if(!isset($_SESSION["session_email"])){
	header("Location: /login");
}
$sess_email = $_SESSION["session_email"];
$sess_username = $_SESSION["session_username"];
$request = $_SERVER['REQUEST_URI'];
$friend_username = explode("/", substr($request, 1))[1];
require_once("connection.php");
$r_statement = "SELECT * FROM userdata WHERE Username='$friend_username'";
$r_query = mysqli_query($conn, $r_statement);
while ($row = mysqli_fetch_assoc($r_query)) {
	$friend_email = $row["Email"];
}
$d_statement = "DELETE FROM friends WHERE Email='$sess_email' AND FriendUsername='$friend_username'";
$d_query = mysqli_query($conn, $d_statement);
$d2_statement = "DELETE FROM friends WHERE Email='$friend_email' AND FriendUsername='$sess_username'";
$d2_query = mysqli_query($conn, $d2_statement);
$dd_statement = "DELETE FROM newfriends WHERE Email='$sess_email' AND FriendUsername='$friend_username'";
$dd_query = mysqli_query($conn, $dd_statement);
$dd2_statement = "DELETE FROM newfriends WHERE Email='$friend_email' AND FriendUsername='$sess_username'";
$dd2_query = mysqli_query($conn, $dd2_statement);
header("Location: /viewfriends");
?>