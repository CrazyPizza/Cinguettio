<?php
	
	$conn = pg_connect("host=localhost port=4321 dbname=cinguettio user=postgres password=unimi");
	
	$query_res = pg_query($conn, "SELECT * FROM ((SELECT mail, id_cinguettio, NULL::NUMERIC AS id_immagine, NULL::NUMERIC AS id_luogo, data_e_ora FROM cinguettio WHERE mail in (SELECT seguito FROM segue WHERE segue = 'captainrussia@hotmail.com')) UNION (SELECT mail, NULL::NUMERIC AS id_cinguettio, id_immagine, NULL::NUMERIC AS id_luogo, data_e_ora FROM immagine WHERE mail in (SELECT seguito FROM segue WHERE segue = 'captainrussia@hotmail.com')) UNION (SELECT mail, NULL::NUMERIC AS id_cinguettio, NULL::NUMERIC AS id_immagine, id_luogo, data_e_ora FROM luogo WHERE mail in (SELECT seguito FROM segue WHERE segue = 'captainrussia@hotmail.com'))) AS bacheca ORDER BY data_e_ora DESC LIMIT 5 OFFSET 15");
	
	$row = pg_fetch_assoc($query_res);
	if($row==""){
		print "vuota";
	} else {
		print "sucai";	
	}
?>