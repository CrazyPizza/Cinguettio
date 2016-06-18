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
		header("Location: error.html");
	}

	$q_res_f = pg_query($conn, "INSERT INTO segue VALUES ('$segue', '$seguito')");
	
	$count = pg_fetch_array(pg_query($conn, "SELECT count(*) FROM segue WHERE seguito = '$seguito'"))[0];
	
	if($count==3){
		$q_res_e = pg_query($conn, "INSERT INTO esperto VALUES ('$seguito', NOW())");
		if(!$q_res_e){
			$bol = false;	
		}
	}
	print pg_last_error();
	if($q_res_f && $bol){
		print "ok_follow";
	} else {
		print "nop";	
	}
?>