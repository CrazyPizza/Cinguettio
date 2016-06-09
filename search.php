<?php
	session_start();
	
	$user = $_SESSION["user"];
	$q_url =  explode("=", $_SERVER['QUERY_STRING'])[1];

	$conn = pg_connect("host=localhost port=4321 dbname=cinguettio user=postgres password=unimi");
	
	$q_res = pg_query($conn, "SELECT seguito FROM segue WHERE segue='$user' AND seguito LIKE '%$q_url%'");
	print pg_last_error();
	$res = "";
	while($row = pg_fetch_array($q_res)){
		$res = $res."<a href=\"#\" style=\"font-size:0.8em;\">$row[0]</a><br>";
	}
	
	print $res;
?>