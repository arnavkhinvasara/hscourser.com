<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$request = strtolower($_SERVER['REQUEST_URI']);
if (substr($request, -1)=="/") {
	$request = substr($request, 0, -1);
}

$pos_pages = array("/explanation", "/about", "/contact", "/privacy", "/terms", "/register", "/login", "/dashboard", "/forgotpassword", "/logout", "/schedule", "/deleteschedule", "/addfriends", "/changename", "/viewfriends", "/deleteaccount", "/changeschool", "/lottery");
$pos_periods = array("/period0", "/period1", "/period2", "/period3", "/period4", "/period5", "/period6", "/period7", "/period8", "/period9", "/period10");

$friend_username = substr($request, 1);
$username_exploded = explode("/", $friend_username);
$checked = "False";
if(count($username_exploded)==2){
	if ($username_exploded[0]=="remove") {
		$checked = "True";
		$friend_username = $username_exploded[1];
	}
	elseif (in_array("/".$username_exploded[0], $pos_periods)){
		if($username_exploded[1]=="goals"){
			$checked = "mid_4";
		}
		else{
			$checked = "mid_1";
			$friend_username = $username_exploded[1];
		}
	}
	elseif ($username_exploded[0]=="compare") {
		$checked = "mid_2";
		$friend_username = $username_exploded[1];
	}
}
elseif (count($username_exploded)==3) {
	if(in_array("/".$username_exploded[0], $pos_periods) and $username_exploded[1]=="resolve"){
		$checked = "mid_3";
		$friend_username = $username_exploded[2];
	}
}
require_once("pages/connection.php");
$statement = "SELECT * FROM userdata WHERE Username='$friend_username'";
$q_statement = mysqli_query($conn, $statement);

if (in_array($request, $pos_pages)){
	require "pages".$request.".php";
}
elseif ($request=="" or $request=="/"){
	require "pages/index.php";
}
elseif (mysqli_num_rows($q_statement)>0 and $checked=="False"){
	require "pages/friend.php";
}
elseif (mysqli_num_rows($q_statement)>0 and $checked=="True"){
	require "pages/removefriend.php";
}
elseif (mysqli_num_rows($q_statement)>0 and $checked=="mid_1"){
	require "pages/friend.php";
}
elseif (mysqli_num_rows($q_statement)>0 and $checked=="mid_2"){
	require "pages/compare.php";
}
elseif (mysqli_num_rows($q_statement)>0 and $checked=="mid_3"){
	require "pages/resolve.php";
}
elseif ($checked=="mid_4"){
	require "pages/goals.php";
}
elseif (in_array($request, $pos_periods)) {
	require "pages/periods.php";
}
elseif($request=="/favicon.ico"){
	require "logo.jpg";
}
else{
	require "pages/404.php";
}
?>
