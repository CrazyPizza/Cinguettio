<?php
	session_start();
	
	if(!isset($_SESSION["user"])){
		header("Location: index.php");
	}

	require('connect.php');

	$user = $_SESSION["user"];
	$q_url =  explode("=", $_SERVER['QUERY_STRING'])[1];

	$conn = connectDB();
	
	if(!$conn){
		print "Connection to DB failed, repeat later";
		exit;
	}

	$q_res = pg_query($conn, "(SELECT seguito FROM segue WHERE segue='$user' AND seguito LIKE '%$q_url%') EXCEPT (SELECT mail AS seguito FROM utente WHERE mail = '$user')");
	print pg_last_error();
	$res = "<table class=\"w3-table-all\">";
	while($row = pg_fetch_array($q_res)){
		$res = $res."<tr><td><a href=\"user.php?id=$row[0]\" style=\"font-size:0.8em;\">$row[0]</a></td></tr>";
	}
	$res = $res."</table>";
	print $res;
?>