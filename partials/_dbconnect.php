<?php
	$servername= "localhost";
	$username = "root";
	$password = "";
	$dbname = "idiscuss";

	// connect to db
	$conn = mysqli_connect($servername,$username,$password,$dbname);
	if(!$conn){
		die("Error : ".mysqli_connect_error());
	}
?>