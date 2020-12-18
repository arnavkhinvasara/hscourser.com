<?php 
session_start();
if(!isset($_SESSION["session_email"])){
	header("Location: /login");
}
$sess_email = $_SESSION["session_email"];
$request = substr($_SERVER['REQUEST_URI'], 1);
$friend_username = explode("/", $request)[2];
$redirect = "/".explode("/", $request)[0]."/goals";
require_once("connection.php");
$d_statement = "DELETE FROM goals WHERE Email='$sess_email' AND FriendUsername='$friend_username'";
$d_query = mysqli_query($conn, $d_statement);
header("Location: $redirect");
?>