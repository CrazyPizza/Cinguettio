<?php
	session_start();
	
	require('connect.php');
	
	$mail = $_POST["mail"];
	$pssw = $_POST["pssw"];
	
	$conn = connectDB();
	
	if(!$conn){
		header("Location: error.html");
	}
	
	$query_res = pg_query($conn, "SELECT mail FROM utente WHERE mail='$mail' AND password='$pssw'");
	$user = pg_fetch_array($query_res)[0];
	
	if(!$user){
		session_unset();
		print "<!DOCTYPE html><html><head></head><body style=\"text-align:center;\"><script>setTimeout(function(){location.href='index.php'}, 3000);</script><h6>PASSWORD NON CORRISPONDENTE, VERRETE REINDIRIZZATI AL LOGIN PER ACCERTAMENTI SULLA VOSTRA IDENTITA'</h6></body></html>";
	}
	
	pg_query($conn, "UPDATE utente SET logged = 1 WHERE mail = '$user'");
	
	$_SESSION["user"] = $user;
	header("Location: home.php");
?>