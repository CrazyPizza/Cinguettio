<?php
	session_start();

	$segue = $_SESSION["user"];
	$seguito =  explode("=", $_SERVER['QUERY_STRING'])[1];
	$bol = true;
	
	$conn = pg_connect("host=localhost port=4321 dbname=cinguettio user=postgres password=unimi");
	
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