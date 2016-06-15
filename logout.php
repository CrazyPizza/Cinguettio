<?php
	session_start();
	$user = $_SESSION["user"];
	//$conn = pg_connect("host=localhost port=4321 dbname=cinguettio user=postgres password=unimi");
	$conn = pg_connect("host=localhost port=5432 dbname=cinguettio user=postgres password=vittorio");
	
	if(!$conn){
		print "Connection to DB failed, repeat later";
		exit;
	}
	
	$query = pg_query($conn, "UPDATE utente SET logged = 0 WHERE mail = '$user'");

	if(!$query){
		print pg_last_error();
		exit;
	}
	
	unset($_SESSION["user"]);
	session_unset();
	
	header("Location: index.php");

?>