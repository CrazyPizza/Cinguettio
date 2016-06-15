<?php
	session_start();
	
	$user = $_SESSION["user"];
	$visit = $_GET["id"];
	$off =  $_GET["off"];

	//$conn = pg_connect("host=localhost port=4321 dbname=cinguettio user=postgres password=unimi");
	$conn = pg_connect("host=localhost port=5432 dbname=cinguettio user=postgres password=vittorio");
	
	$contatore = pg_fetch_array(pg_query($conn, "SELECT count(*) FROM (SELECT * FROM ((SELECT mail, id_cinguettio, NULL::NUMERIC AS id_immagine, NULL::NUMERIC AS id_luogo, data_e_ora FROM cinguettio WHERE mail = '$visit' ORDER BY data_e_ora DESC) UNION (SELECT mail, NULL::NUMERIC AS id_cinguettio, id_immagine, NULL::NUMERIC AS id_luogo, data_e_ora FROM immagine WHERE mail = '$visit' ORDER BY data_e_ora DESC) UNION (SELECT mail, NULL::NUMERIC AS id_cinguettio, NULL::NUMERIC AS id_immagine, id_luogo, data_e_ora FROM luogo WHERE mail = '$visit' ORDER BY data_e_ora DESC)) AS bacheca ORDER BY data_e_ora DESC LIMIT 5 OFFSET $off) AS contatore"))[0];
	
	if($contatore==0){
		print "finish";
	} else {
        $query_res = pg_query($conn, "SELECT * FROM ((SELECT mail, id_cinguettio, NULL::NUMERIC AS id_immagine, NULL::NUMERIC AS id_luogo, data_e_ora FROM cinguettio WHERE mail = '$visit' ORDER BY data_e_ora DESC) UNION (SELECT mail, NULL::NUMERIC AS id_cinguettio, id_immagine, NULL::NUMERIC AS id_luogo, data_e_ora FROM immagine WHERE mail = '$visit' ORDER BY data_e_ora DESC) UNION (SELECT mail, NULL::NUMERIC AS id_cinguettio, NULL::NUMERIC AS id_immagine, id_luogo, data_e_ora FROM luogo WHERE mail = '$visit' ORDER BY data_e_ora DESC)) AS bacheca ORDER BY data_e_ora DESC LIMIT 5 OFFSET $off");
	
		while ($row = pg_fetch_assoc($query_res)) {
			
			$row_mail = $row["mail"];
			
			if($row["id_cinguettio"]!=NULL){
				
				
				$cing_res = pg_query($conn, "SELECT mail, id_cinguettio, testo, now()-data_e_ora AS temp FROM cinguettio WHERE mail = '$row_mail' AND id_cinguettio = ".$row["id_cinguettio"]);
				$cing = pg_fetch_assoc($cing_res);
				
				$mail = $cing["mail"];
				$id = "".$cing["id_cinguettio"].",".$mail;
				$idcinguettio=$cing["id_cinguettio"];
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
<span id="idcinguettio_$id" class="w3-right w3-opacity" style="display:none">$idcinguettio</span>
<span id="idpersona_$id" class="w3-right w3-opacity" style="display:none">$mail</span>
<h4 id="nome_seguito_$id">$name</h4><br>
<hr class="w3-clear">
<p id="testo_cinguettio_$id">$testo</p>
<button id="segnala_$id" type="button" class="w3-btn w3-theme-d2 w3-margin-bottom" onclick="document.getElementById('modal_$id').style.display='block'"><i class="fa fa-close"></i>  Segnala</button>
</div>

<div id="modal_$id" class="w3-modal" style="display:none">
<div class="w3-modal-content">
<header class="w3-container w3-theme-d2"> 
<span onclick="document.getElementById('modal_$id').style.display='none'" class="w3-closebtn">&times;</span>
<h2>Segnala Post</h2>
</header>
<div class="w3-container">
<p>Vuoi segnalare questo post come inappropriato?</p>
<p>ATTENZIONE! Le false segnalazioni saranno punite.</p>
<br>
</div>
<div class="w3-container" style="overflow-y:scroll; max-height: 500px">
<p>Chi ha segnalato questo post:</p>
EOL;
				$segnalanti=pg_query($conn,"SELECT segnalante FROM segnalato WHERE id_cinguettio=$idcinguettio AND mail='$mail'");
				while($segnalante = pg_fetch_assoc($segnalanti)){
					$tmp = ucfirst(explode("@", $segnalante["segnalante"])[0]);
					print "<p>$tmp</p>";
				};
				print <<<EOL
</div>
<footer class="w3-container w3-theme-l2">
<button id="segnala_$id" type="button" class="w3-btn w3-theme-d2 w3-margin-top w3-margin-bottom" onclick="segnala('$id')"><i class="fa fa-close"></i>  Segnala</button>
</footer>
</div>
</div>
EOL;
			} elseif($row["id_immagine"]!=null){
				
				
				$cing_res = pg_query($conn, "SELECT mail, id_immagine, url, descrizione, now()-data_e_ora AS time FROM immagine WHERE mail = '$row_mail' AND id_immagine = ".$row["id_immagine"]);
				$cing = pg_fetch_assoc($cing_res);
				
				$mail = $cing["mail"];
				$id = "".$cing["id_immagine"].",".$mail;
				$idimmagine=$cing["id_immagine"];
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
<span id="idimmagine_$id" class="w3-right w3-opacity" style="display:none">$idimmagine</span>
<span id="idpersona_$id" class="w3-right w3-opacity" style="display:none">$mail</span>
<h4 id="nome_seguito_$id">$name</h4><br>
<hr class="w3-clear">
<p id="immagine_descrizione_$id">$desc</p>
<img id="immagine_url_$id" src="$url" style="width:100%" class="w3-margin-bottom">
<button id="apprezzamento_$id" type="button" class="w3-btn w3-theme-d1 w3-margin-bottom" onclick="document.getElementById('immModal_$id').style.display='block'"><i class="fa fa-thumbs-up"></i>  Apprezzamento</button>
</div> 

<div id="immModal_$id" class="w3-modal">
<div class="w3-modal-content">
<header class="w3-container w3-theme-d2"> 
<span onclick="document.getElementById('immModal_$id').style.display='none'" class="w3-closebtn">&times;</span>
<h2>Apprezza immagine</h2>
</header>
<div class="w3-responsive w3-margin-top w3-margin-bottom w3-padding">
<img src="$url" style="width:100%" class="w3-margin-bottom w3-padding">
<input id="appr_text_$id" class="w3-input w3-border w3-hover-blue" type="text" placeholder="Scrivi qui il tuo apprezzamento!">
</div>
<div class="w3-container" style="overflow-y:scroll; max-height: 300px">
<div class="w3-responsive w3-margin-top w3-margin-bottom">
<p>Gli apprezzamenti degli altri utenti: </p>
<table class="w3-table w3-hoverable w3-striped w3-bordered w3-border ">
<thead>
<tr class="w3-theme-d2">
<th>Utente</th>
<th>Apprezzamento</th>
</tr>
</thead>
EOL;
				$apprezzamenti=pg_query($conn,"SELECT apprezzante, descrizione FROM apprezzamento WHERE id_immagine=$idimmagine AND creatore_immagine='$mail'");
				while($apprezzamento = pg_fetch_assoc($apprezzamenti)){
					$apprezzante = ucfirst(explode("@", $apprezzamento["apprezzante"])[0]);
					$testoApprez = $apprezzamento["descrizione"];
					print <<<EOL
<tr>
<td>$apprezzante</td>
<td>$testoApprez</td>
</tr>
EOL;
				};
				print <<<EOL
</table>
</div>
</div>
<footer class="w3-container w3-theme-l2">
<button id="apprezza_$id" type="button" class="w3-btn w3-theme-d2 w3-margin-top w3-margin-bottom" onclick="apprezza('$id')"><i class="fa fa-thumbs-o-up"></i> Apprezza</button>
</footer>
</div>
</div>
EOL;
				}
			} else {
				
				$cing_res = pg_query($conn, "SELECT mail, id_luogo, latitudine, longitudine, now()-data_e_ora AS time FROM luogo WHERE mail = '$row_mail' AND id_luogo = ".$row["id_luogo"]);
				$cing = pg_fetch_assoc($cing_res);
				
				$mail = $cing["mail"];
				$id = "".$cing["id_luogo"].",".$mail;
				$idluogo=$cing["id_luogo"];
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
<span id="idluogo_$id" class="w3-right w3-opacity" style="display:none">$idluogo</span>
<span id="idpersona_$id" class="w3-right w3-opacity" style="display:none">$mail</span>
<h4 id="nome_seguito_$id">$name</h4><br>
<hr class="w3-clear">
<iframe width="100%" height="400" frameborder="0" style="border:0;" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD59XdvHyQE8yPhgo15Vk9IBqpyMbYPHmw&q=$lat,$lon" allowfullscreen></iframe>
<button id="preferimento_$id" type="button" class="w3-btn w3-theme-d2 w3-margin-bottom" onclick="document.getElementById('luogoModal_$id').style.display='block'"><i class="fa fa-heart"></i>  Preferisci</button>
</div>

<div id="luogoModal_$id" class="w3-modal">
  <div class="w3-modal-content">
    <header class="w3-container w3-theme-d2"> 
      <span onclick="document.getElementById('luogoModal_$id').style.display='none'" 
      class="w3-closebtn">&times;</span>
      <h2>Imposta luogo preferito</h2>
    </header>
    <div class="w3-container" style="max-height: 500px">
<p>Vuoi impostare questo luogo come preferito?</p>
<iframe width="100%" height="400" frameborder="0" style="border:0;" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD59XdvHyQE8yPhgo15Vk9IBqpyMbYPHmw&q=$lat,$lon" allowfullscreen></iframe>
    </div>
    <footer class="w3-container w3-theme-l2">
     <button id="preferisci_$id" type="button" class="w3-btn w3-theme-d2 w3-margin-top w3-margin-bottom" onclick="preferisci('$id')"><i class="fa fa-heart"></i>  Imposta luogo preferito</button>
    </footer>
  </div>
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