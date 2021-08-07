<?php
	$ticketsArray = [];
	$usersArray = [];
	require_once("connection.php");
	$statement = "SELECT * FROM userdata";
	$q_statement = mysqli_query($conn, $statement);
	while ($row = mysqli_fetch_assoc($q_statement)){
		array_push($ticketsArray, $row["Fullname"], $row["Referred"]);
		array_push($usersArray, $row["Fullname"]);
	}
	foreach($ticketsArray as $key => $value){
		if ($value==""){
			unset($ticketsArray[$key]);
		}
	}
	$peopleArray = array_values($ticketsArray);
	echo ($peopleArray[rand(0, count($ticketsArray))]);
	echo "<br/><br/><br/>";
	echo count($usersArray);
?>
