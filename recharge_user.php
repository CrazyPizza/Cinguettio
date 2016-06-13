<?php
	session_start();
	
	$user = $_SESSION["user"];
	$visit = $_GET["id"];
	$off =  $_GET["off"];

	$conn = pg_connect("host=localhost port=4321 dbname=cinguettio user=postgres password=unimi");
	
	$contatore = pg_fetch_array(pg_query($conn, "SELECT count(*) FROM (SELECT * FROM ((SELECT mail, id_cinguettio, NULL::NUMERIC AS id_immagine, NULL::NUMERIC AS id_luogo, data_e_ora FROM cinguettio WHERE mail = '$visit' ORDER BY data_e_ora DESC) UNION (SELECT mail, NULL::NUMERIC AS id_cinguettio, id_immagine, NULL::NUMERIC AS id_luogo, data_e_ora FROM immagine WHERE mail = '$visit' ORDER BY data_e_ora DESC) UNION (SELECT mail, NULL::NUMERIC AS id_cinguettio, NULL::NUMERIC AS id_immagine, id_luogo, data_e_ora FROM luogo WHERE mail = '$visit' ORDER BY data_e_ora DESC)) AS bacheca ORDER BY data_e_ora DESC LIMIT 5 OFFSET $off) AS contatore"))[0];
	
	if($contatore==0){
		print "finish";
	} else {
        $query_res = pg_query($conn, "SELECT * FROM ((SELECT mail, id_cinguettio, NULL::NUMERIC AS id_immagine, NULL::NUMERIC AS id_luogo, data_e_ora FROM cinguettio WHERE mail = '$visit' ORDER BY data_e_ora DESC) UNION (SELECT mail, NULL::NUMERIC AS id_cinguettio, id_immagine, NULL::NUMERIC AS id_luogo, data_e_ora FROM immagine WHERE mail = '$visit' ORDER BY data_e_ora DESC) UNION (SELECT mail, NULL::NUMERIC AS id_cinguettio, NULL::NUMERIC AS id_immagine, id_luogo, data_e_ora FROM luogo WHERE mail = '$visit' ORDER BY data_e_ora DESC)) AS bacheca ORDER BY data_e_ora DESC LIMIT 5 OFFSET $off");
	
		while ($row = pg_fetch_assoc($query_res)) {
			
			$row_mail = $row["mail"];
			
			if($row["id_cinguettio"]!=NULL){
				
				
				$cing_res = pg_query($conn, "SELECT mail, id_cinguettio, testo, now()-data_e_ora AS temp FROM cinguettio WHERE mail = '$row_mail' AND id_cinguettio = ".$row["id_cinguettio"]." ORDER BY data_e_ora DESC");
				$cing = pg_fetch_assoc($cing_res);
				
				$mail = $cing["mail"];
				$id = "".$cing["id_cinguettio"].",".$mail;
				$data = $cing["temp"];
				$testo = $cing["testo"];
				$name = ucfirst(explode("@", $mail)[0]);
				
				$avatar = pg_fetch_array(pg_query($conn, "SELECT sesso FROM utente WHERE mail='$row_mail'"))[0];
				if($avatar==1){
					$avatar = "img_avatar2.png";
				} else {
					$avatar = "img_avatar5.png";
				}
				
				print <<<EOL
<div class="w3-container w3-card-2 w3-white w3-round w3-margin" style="position: relative;"><br>
<img id="avatar_$id" src="$avatar" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
<span id="timestamp_$id" class="w3-right w3-opacity">$data</span>
<h4 id="nome_seguito_$id">$name</h4><br>
<hr class="w3-clear">
<p id="testo_cinguettio_$id">$testo</p>
<button id="segnala_$id" type="button" class="w3-btn w3-theme-d2 w3-margin-bottom" onclick="segnala('cinguettio', $id)><i class="fa fa-close"></i>  Segnala</button>
</div> 
EOL;
			} elseif($row["id_immagine"]!=NULL){
				
				
				$cing_res = pg_query($conn, "SELECT mail, id_immagine, url, descrizione, now()-data_e_ora AS time FROM immagine WHERE mail = '$row_mail' AND id_immagine = ".$row["id_immagine"]." ORDER BY data_e_ora DESC");
				$cing = pg_fetch_assoc($cing_res);
				
				$mail = $cing["mail"];
				$id = "".$cing["id_immagine"].",".$mail;
				$data = $cing["time"];
				$url = $cing["url"];
				$desc = $cing["descrizione"];
				$name = ucfirst(explode("@", $mail)[0]);
				
				$avatar = pg_fetch_array(pg_query($conn, "SELECT sesso FROM utente WHERE mail='$row_mail'"))[0];
				if($avatar==1){
					$avatar = "img_avatar2.png";
				} else {
					$avatar = "img_avatar5.png";
				}
				
				$is_exp = pg_fetch_array(pg_query($conn, "SELECT mail FROM esperto WHERE mail='$user'"))[0];
				
				if($is_exp==""){
				print <<<EOL
<div class="w3-container w3-card-2 w3-white w3-round w3-margin" style="position: relative;"><br>
<img id="avatar_$id" src="$avatar" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
<span id="timestamp_$id" class="w3-right w3-opacity">$data</span>
<h4 id="nome_seguito_$id">$name</h4><br>
<hr class="w3-clear">
<p id="immagine_descrizione_$id">$desc</p>
<img id="immagine_url_$id" src="$url" style="width:100%" class="w3-margin-bottom">
</div> 
EOL;
				} else {
					print <<<EOL
<div class="w3-container w3-card-2 w3-white w3-round w3-margin" style="position: relative;"><br>
<img id="avatar_$id" src="$avatar" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
<span id="timestamp_$id" class="w3-right w3-opacity">$data</span>
<h4 id="nome_seguito_$id">$name</h4><br>
<hr class="w3-clear">
<p id="immagine_descrizione_$id">$desc</p>
<img id="immagine_url_$id" src="$url" style="width:100%" class="w3-margin-bottom">
<button id="apprezzamento_$id" type="button" class="w3-btn w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Apprezzamento</button>
</div> 
EOL;
				}
			} else {
				
				$cing_res = pg_query($conn, "SELECT mail, id_luogo, latitudine, longitudine, now()-data_e_ora AS time FROM luogo WHERE mail = '$row_mail' AND id_luogo = ".$row["id_luogo"]." ORDER BY data_e_ora DESC");
				$cing = pg_fetch_assoc($cing_res);
				
				$mail = $cing["mail"];
				$id = "".$cing["id_luogo"].",".$mail;
				$data = $cing["time"];		
				$lat = $cing["latitudine"];
				$lon = $cing["longitudine"];
				$name = ucfirst(explode("@", $mail)[0]);
				
				$avatar = pg_fetch_array(pg_query($conn, "SELECT sesso FROM utente WHERE mail='$row_mail'"))[0];
				if($avatar==1){
					$avatar = "img_avatar2.png";
				} else {
					$avatar = "img_avatar5.png";
				}
				
				print <<<EOL
<div class="w3-container w3-card-2 w3-white w3-round w3-margin" style="position: relative;"><br>
<img id="avatar_$id" src="$avatar" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
<span id="timestamp_$id" class="w3-right w3-opacity">$data</span>
<h4 id="nome_seguito_$id">$name</h4><br>
<hr class="w3-clear">
<div id="$id" style="display:none">$lat,$lon</div>
<iframe width="100%" height="400" frameborder="0" style="border:0;" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD59XdvHyQE8yPhgo15Vk9IBqpyMbYPHmw&q=$lat,$lon" allowfullscreen></iframe>
<button id="preferimento_$id" type="button" class="w3-btn w3-theme-d2 w3-margin-bottom"><i class="fa fa-heart"></i>  Preferisci</button>
</div>
EOL;
			}
		}
		
		print <<<EOL
<div id="last_post" class="w3-container w3-card-2 w3-white w3-round w3-margin" style="position: relative;">
<div style="text-align:center;"><img src="loader.gif" alt="loader" style="width:5%;height:auto;"></div>
</div>
EOL;
	}
?>