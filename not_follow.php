<?php
	session_start();

	if(!isset($_SESSION["user"])){
		header("Location: index.php");
	}

	require('connect.php');

	$segue = $_SESSION["user"];
	$seguito =  explode("=", $_SERVER['QUERY_STRING'])[1];
	$bol = true;
	
	$conn = connectDB();
	
	if(!$conn){
		print "Connection to DB failed, repeat later";
		exit;
	}

	$q_res_f = pg_query($conn, "DELETE FROM segue WHERE segue = '$segue' AND seguito = '$seguito'");
	
	$count = pg_fetch_array(pg_query($conn, "SELECT count(*) FROM segue WHERE seguito = '$seguito'"))[0];
	
	if($count<3){
		$q_res_e = pg_query($conn, "DELETE FROM esperto WHERE mail = '$seguito'");
		if(!$q_res_e){
			$bol = false;	
		}
	}
	print pg_last_error();
	if($q_res_f && $bol){
		print "ok_not_follow";
	} else {
		print "nop";	
	}
?>