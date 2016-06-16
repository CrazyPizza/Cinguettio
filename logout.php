<?php
	session_start();
	
	if(!isset($_SESSION["user"])){
		header("Location: index.php");
	}

	require('connect.php');

	$user = $_SESSION["user"];
	$conn = connectDB();
	
	if(!$conn){
		print "Connection to DB failed, repeat later";
		exit;
	}
	
	pg_query($conn, "UPDATE utente SET logged = 0 WHERE mail = '$user'");

	unset($_SESSION["user"]);
	session_unset();
	
	header("Location: index.php");
?>