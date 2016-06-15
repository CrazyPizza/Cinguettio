<?php
	session_start();
	
	$mail = $_POST["mail"];
	$pssw = $_POST["pssw"];
	
	//$conn = pg_connect("host=localhost port=4321 dbname=cinguettio user=postgres password=unimi");
	$conn = pg_connect("host=localhost port=5432 dbname=cinguettio user=postgres password=vittorio");
	
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
	
	//pg_query($conn, "UPDATE utente SET logged = true WHERE mail = '$user'");
	$_SESSION["user"] = $user;
	header("Location: home.php");
?>