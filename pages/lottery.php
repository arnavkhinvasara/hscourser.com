<?php
	$ticketsArray = [];
	require_once("connection.php");
	$statement = "SELECT * FROM userdata";
	$q_statement = mysqli_query($conn, $statement);
	while ($row = mysqli_fetch_assoc($q_statement)){
		array_push($ticketsArray, $row["Fullname"], $row["Referred"]);
	}
	foreach($ticketsArray as $key => $value){
		if ($value=="" || str_contains($value, "arnav")==false || str_contains($value, "Arnav")==false){
			unset($ticketsArray[$key]);
		}
	}
	$peopleArray = array_values($ticketsArray);
	print_r($peopleArray);
	echo "<br/>";
	echo (count($ticketsArray));
	echo "<br/>";
	echo ($peopleArray[rand(0, count($ticketsArray))]);
?>
