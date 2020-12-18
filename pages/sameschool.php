<?php 
function checker ($x, $y, $z){
	$c_statement = "SELECT * FROM userdata WHERE Email='$y'";
	$c_query = mysqli_query($x, $c_statement);
	while ($row = mysqli_fetch_assoc($c_query)){
		if($row["School"]==$z){
			return True;
		}
		else{
			return False;
		}
	}
}
?>