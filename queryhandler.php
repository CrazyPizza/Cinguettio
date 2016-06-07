<?php
	$conn = pg_connect("host=localhost port=5432 dbname=Cinguettio user=postgres password=vittorio");
	if(!$conn){
		//gestire la mancata connessione al db
		print "Connection to DB failed, repeat later";
		exit;
	}

	$tipo= $_POST["tipo"];
	$mail= $_POST["mail"];
	$cod;
	
	function getCode(){
		$q1= "SELECT id_cinguettio FROM cinguettio WHERE mail='$mail' ORDER BY id_cinguettio DESC";
		$q2= "SELECT id_immagine FROM immagine WHERE mail='$mail' ORDER BY id_immagine DESC";
		$q3= "SELECT id_cinguettio FROM luogo WHERE mail='$mail' ORDER BY id_luogo DESC";
		
		$q1_res= pg_query($conn, $q1);
		if(!$q1_res){
			//gestire il fallimento della query
			exit;
		}
		$q2_res= pg_query($conn, $q2);
		if(!$q2_res){
			//gestire il fallimento della query
			exit;
		}
		$q3_res= pg_query($conn, $q3);
		if(!$q3_res){
			//gestire il fallimento della query
			exit;
		}
		$q1_max= pg_fetch_assoc(q1_res);
		$q2_max= pg_fetch_assoc(q2_res);
		$q3_max= pg_fetch_assoc(q3_res);
		if($q1_max > $q2_max && $q1_max > $q3_max){
			$cod=$q1_max + 1;
		}elseif($q2_max > $q1_max && $q2_max > $q3_max){
			$cod=$q2_max + 1;
		}else{
			$cod=$q3_max + 1;
		}
		
		
	}
	
	
	

	
	switch ($tipo) {
    case "cinguettio":
		$testo= $_POST["testo"];
		$query= "INSERT INTO cinguettio VALUES ($cod,'$mail', now(), '$testo');"
        break;
    case "immagine":
		$url= $_POST["url"];
		$descrizione= $_POST["descrizione"];
        $query= "INSERT INTO immagine VALUES ($cod,'$mail', now(), '$url','$descrizione');"
        break;
    case "luogo":
        $lat= $_POST["lat"];
		$long= $_POST["long"];
        $query= "INSERT INTO luogo VALUES ($cod,'$mail', now(), '$lat','$long');"
        break;
	}
	
	$query_res= pg_query($conn, $query);
		if(!$query_res){
			//gestire il fallimento della query
			exit;
		}
	
?>