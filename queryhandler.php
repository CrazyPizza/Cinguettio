<?php
	session_start();

	$conn = pg_connect("host=localhost port=4321 dbname=cinguettio user=postgres password=unimi");
	if(!$conn){
		header("Location: home.php?res=no");
	}

	$tipo = $_POST["tipo"];
	$mail = $_SESSION["user"];
	$cod;
		
	$q1 = pg_fetch_array(pg_query($conn, "SELECT max(id_cinguettio) FROM cinguettio WHERE mail='$mail'"));
	$q2 = pg_fetch_array(pg_query($conn, "SELECT max(id_immagine) FROM immagine WHERE mail='$mail'"));
	$q3 = pg_fetch_array(pg_query($conn, "SELECT max(id_cinguettio) FROM luogo WHERE mail='$mail'"));
	
	$cod = max($q1[0],$q2[0],$q3[0])+1;

	switch ($tipo) {
    case "cinguettio":
		$testo = $_POST["testo"];
		$query = "INSERT INTO cinguettio VALUES ($cod,'$mail', now(), '$testo')";
        break;
    case "immagine":
		$url = $_POST["url"];
		$descrizione = $_POST["descrizione"];
        $query = "INSERT INTO immagine VALUES ($cod,'$mail', now(), '$url','$descrizione')";
        break;
    case "luogo":
        $lat = $_POST["lat"];
		$lon = $_POST["lon"];
        $query = "INSERT INTO luogo VALUES ($cod,'$mail', now(), '$lat','$lon')";
        break;
	}
	
	$query_res = pg_query($conn, $query);
	
	if(!$query_res){
		header("Location: home.php?res=nop");
	}

	header("Location: home.php?res=ok");
	
	//alternativamente
	//
	// if(!$query_res){
	// 	 print "nop";
	// }

	// print "ok";
	//
	// in parallelo all'alternativa in buttonhandler.js
?>