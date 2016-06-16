<?php
	session_start();
	
	require('connect.php');
	
	$mail = $_POST["mail"];
	$pssw = $_POST["pssw"];
	
	$conn = connectDB();
	
	if(!$conn){
		print "Connection to DB failed, repeat later";
		exit;
	}
	
	$query_res = pg_query($conn, "SELECT mail FROM utente WHERE mail='$mail' AND password='$pssw'");
	$user = pg_fetch_array($query_res)[0];
	
	if(!$user || $mail!=$user){
		echo "Non corretto";
		exit;
	}
	
	pg_query($conn, "UPDATE utente SET logged = 1 WHERE mail = '$user'");
	
	$_SESSION["user"] = $user;
	header("Location: home.php");
?>