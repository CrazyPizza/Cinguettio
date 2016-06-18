<?php

session_start();

require('connect.php');

if(!isset($_SESSION["user"])){
	header("Location: index.php");
}

$user = $_SESSION["user"];
$visit = $_GET["id"];	

$conn = connectDB();

if(!$conn){
	print "Connection to DB failed, repeat later";
	exit;
}

$personal = pg_fetch_assoc(pg_query($conn, "SELECT * FROM utente WHERE mail = '$visit'"));
$luogo_pref = pg_fetch_assoc(pg_query($conn, "SELECT latitudine, longitudine FROM utente JOIN luogo ON utente.creatore_luogo=luogo.mail AND utente.id_luogo=luogo.id_luogo WHERE utente.mail = '$visit'"));
$avatar = pg_fetch_array(pg_query($conn, "SELECT sesso FROM utente WHERE mail='$visit'"))[0];

$follow = pg_fetch_array(pg_query($conn, "SELECT count(*) FROM segue WHERE segue='$visit'"))[0];
$follower = pg_fetch_array(pg_query($conn, "SELECT count(*) FROM segue WHERE seguito='$visit'"))[0];

if($avatar==1){
	$avatar = "img/img_avatar2.png";
} else {
	$avatar = "img/img_avatar5.png";
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			Cinguettio
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="w3.css">
		<link rel="stylesheet" href="w3-theme-blue-grey.css">
		<!--<link rel='stylesheet' href='https://fonAIzaSyD59XdvHyQE8yPhgo15Vk9IBqpyMbYPHmwts.googleapis.com/css?family=Open+Sans'>-->
		<!--<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">-->
		<link rel="stylesheet" href="fontawesome/css/font-awesome.css">
		<link rel="stylesheet" href="font-google.css">
		<style>
			html,body,h1,h2,h3,h4,h5 {
				font-family: "Open Sans", sans-serif}
		</style>
	</head>
	
	<body class="w3-theme-l5">
		<script src="buttonhandler.js"></script>
		
		<!-- Navbar -->
		<div class="w3-top">
			<ul class="w3-navbar w3-theme-d2 w3-left-align w3-large">
				<li class="w3-hide-medium w3-hide-large w3-opennav w3-right">
					<a class="w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars">
						</i></a>
				</li>
				<li>
					<a href="home.php" class="w3-padding-large w3-theme-d4"><i class="fa fa-twitter fa-flip-vertical fa-flip-horizontal w3-margin-right">
						</i>Cinguettio</a>
				</li>
				<li class="w3-hide-small">
					<a href="home.php" class="w3-padding-large w3-hover-white" title="Home"><i class="fa fa-globe">
						</i></a>
				</li>
				<li class="w3-hide-small">
					<a href="user_setting.php" class="w3-padding-large w3-hover-white" title="Account Settings"><i class="fa fa-user">
						</i></a>
				</li>
				<li class="w3-hide-small w3-right">
					<a href="logout.php" class="w3-padding-large w3-hover-white" title="Log Out"><i class="fa fa-close" style="color:red">
						</i> Log Out</a>
				</li>
			</ul>
		</div>
		
		<!-- Navbar on small screens -->
		<div id="navDemo" class="w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:51px">
			<ul class="w3-navbar w3-left-align w3-large w3-theme">
				<li>
					<a class="w3-padding-large" href="home.php"><i class="fa fa-globe">
						</i> Home</a>
				</li>
				<li>
					<a class="w3-padding-large" href="user_setting.php"><i class="fa fa-user">
						</i> Account</a>
				</li>
				<li>
					<a class="w3-padding-large" href="ricerca.php"><i class="fa fa-search">
						</i> Ricerca</a>
				</li>
				<li>
					<a class="w3-padding-large" href="logout.php"><i class="fa fa-close" style="color:red">
						</i> Logout</a>
				</li>
			</ul>
		</div>
		
		<!-- Page Container -->
		<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
		
			<!-- The Grid -->
			<div class="w3-row">
			
				<!-- Left Column -->
				<div class="w3-col m3">
				
					<!-- Profile -->
					<div class="w3-card-2 w3-round w3-white">
						<div class="w3-container">
							<h4 class="w3-center">
								<?php print ucfirst($personal["nome"])." ".ucfirst($personal["cognome"]); ?></h4>
							<h5 class="w3-center">
								<?php print $visit; ?></h5>
							<p class="w3-center">
								<img src="<?php print $avatar; ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar">
							</p>
							<hr>
							<p>
								<i name="citta_nascita" class="fa fa-home fa-fw w3-margin-right w3-text-theme">
								</i>
								<?php print $personal["citta_residenza"]; ?></p>
							<p>
								<i name="data_nascita" class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme">
								</i>
								<?php print $personal["data_nascita"]; ?></p>
							<p>
								<i name="luogo_pref" class="fa fa-gittip fa-fw w3-margin-right w3-text-theme">
								</i>
								<?php if($luogo_pref["latitudine"]!=null && $luogo_pref["longitudine"]!=null){print "<a href=\"https://www.google.com/maps/embed/v1/place?key=AIzaSyD59XdvHyQE8yPhgo15Vk9IBqpyMbYPHmw&q=".$luogo_pref["latitudine"].",".$luogo_pref["longitudine"]."\" target=\"_blank\" style=\"text-decoration:none;\">".$luogo_pref["latitudine"].", ".$luogo_pref["longitudine"]."</a>";} ?></p>
							<p>
								<i name="follow" class="fa fa-sign-out fa-fw w3-margin-right w3-text-theme">
								</i>
								<?php print "Follow <span class=\"w3-badge w3-green\">$follow</span>"; ?></p>
							<p>
								<i name="follower" class="fa fa-sign-in fa-fw w3-margin-right w3-text-theme">
								</i>
								<?php print "Follower <span class=\"w3-badge w3-blue\">$follower</span>"; ?></p>
							<?php
$sex = "Maschio";
if($personal["sesso"]==0){
	$sex = "Femmina";	
}
print "<p><table class=\"w3-table-all w3-hoverable w3-tiny\">";
print "<tr><td><strong>Mail</strong></td><td>$user</td></tr>";
print "<tr><td><strong>Nome</strong></td><td>".$personal["nome"]."</td></tr>";
print "<tr><td><strong>Cognome</strong></td><td>".$personal["cognome"]."</td></tr>";
print "<tr><td><strong>Compleanno</strong></td><td>".$personal["data_nascita"]."</td></tr>";
print "<tr><td><strong>Citta' di nascita</strong></td><td>".$personal["luogo_nascita"]."</td></tr>";
print "<tr><td><strong>Residenza</strong></td><td>".$personal["citta_residenza"]."</td></tr>";
print "<tr><td><strong>Nazionalita'</strong></td><td>".$personal["nazionalita"]."</td></tr>";
print "<tr><td><strong>Sesso</strong></td><td>$sex</td></tr></table></p>";
							?>
							
						</div>
					</div>
					<br>
					
					<!-- Accordion -->
					<div class="w3-card-2 w3-round">
						<div class="w3-accordion w3-white">
							<button onclick="myFunction('segnalazioni')" class="w3-btn-block w3-theme-l1 w3-left-align"><i class="fa fa-close fa-fw w3-margin-right">
								</i> Le mie segnalazioni</button>
							<div id="segnalazioni" class="w3-accordion-content w3-container">
								
								<?php
$segn = pg_query($conn, "SELECT mail, testo FROM cinguettio NATURAL JOIN segnalato WHERE segnalante = '$visit' ORDER BY data_e_ora DESC");

while($row = pg_fetch_assoc($segn)){
	print "<p>".$row["testo"]."<small> ".$row["mail"]."</small></p><hr>";
}
print "<p>...</p>";

$is_exp = pg_fetch_array(pg_query($conn, "SELECT count(*) FROM esperto WHERE mail = '$visit'"))[0];

if($is_exp!=0){
	$apprezzamento = pg_query($conn, "SELECT url, mail, apprezzamento.descrizione AS appr, immagine.descrizione AS descr FROM apprezzamento JOIN immagine ON apprezzamento.id_immagine=immagine.id_immagine AND creatore_immagine=mail WHERE apprezzante = '$visit' ORDER BY data DESC");	
	
	print <<<EOL
</div>
<button onclick="myFunction('apprezzamenti')" class="w3-btn-block w3-theme-l1 w3-left-align"><i class="fa fa-thumbs-up fa-fw w3-margin-right"></i> I miei apprezzamenti</button>
<div id="apprezzamenti" class="w3-accordion-content w3-container">
<div class="w3-row-padding">
<br>
EOL;
	
	while($row = pg_fetch_assoc($apprezzamento)){
		$url = $row["url"];
		$ap = $row["appr"];
		$des = $row["descr"];
		$mail = ucfirst(explode("@", $row["mail"])[0]);
		
		print <<<EOL
<div class="w3-half">
<small>$mail: $des</small>
<img src="$url" style="width:100%" class="w3-margin-bottom">
<small>$ap</small>
</div>
EOL;
	}
	print "<div class=\"w3-half\"><small>...</small></div></div></div></div></div><br>";
} else {
	print "</div></div></div><br>";
}
								?>
							
								<!-- Interests --> 
								<!--<div class="w3-card-2 w3-round w3-white w3-hide-small">
									<div class="w3-container">
										<p>
											Interests
										</p>
										<p>
											<span class="w3-tag w3-small w3-theme-d5">News</span>
											<span class="w3-tag w3-small w3-theme-d4">W3Schools</span>
											<span class="w3-tag w3-small w3-theme-d3">Labels</span>
											<span class="w3-tag w3-small w3-theme-d2">Games</span>
											<span class="w3-tag w3-small w3-theme-d1">Friends</span>
											<span class="w3-tag w3-small w3-theme">Games</span>
											<span class="w3-tag w3-small w3-theme-l1">Friends</span>
											<span class="w3-tag w3-small w3-theme-l2">Food</span>
											<span class="w3-tag w3-small w3-theme-l3">Design</span>
											<span class="w3-tag w3-small w3-theme-l4">Art</span>
											<span class="w3-tag w3-small w3-theme-l5">Photos</span>
										</p>
									</div>
								</div>-->
								<br>
							</div>
							<!-- End Left Column -->
							
							<!-- Middle Column -->
							<div id="middle_coloumn" class="w3-col m7">
							
								<?php
$query_res = pg_query($conn, "SELECT * FROM ((SELECT mail, id_cinguettio, NULL::NUMERIC AS id_immagine, NULL::NUMERIC AS id_luogo, data_e_ora FROM cinguettio WHERE mail = '$visit' ORDER BY data_e_ora DESC) UNION (SELECT mail, NULL::NUMERIC AS id_cinguettio, id_immagine, NULL::NUMERIC AS id_luogo, data_e_ora FROM immagine WHERE mail = '$visit' ORDER BY data_e_ora DESC) UNION (SELECT mail, NULL::NUMERIC AS id_cinguettio, NULL::NUMERIC AS id_immagine, id_luogo, data_e_ora FROM luogo WHERE mail = '$visit' ORDER BY data_e_ora DESC)) AS bacheca ORDER BY data_e_ora DESC LIMIT 5");

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
			$avatar = "img/img_avatar2.png";
		} else {
			$avatar = "img/img_avatar5.png";
		}
		
		print <<<EOL
<div class="w3-container w3-card-2 w3-white w3-round w3-margin" style="position: relative;"><br>
<img src="$avatar" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
<span class="w3-right w3-opacity">$data</span>
<h4>$name</h4><br>
<hr class="w3-clear">
<p>$testo</p>
<button type="button" class="w3-btn w3-theme-d2 w3-margin-bottom" onclick="document.getElementById('modal_$id').style.display='block'"><i class="fa fa-close"></i>  Segnala</button>
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
<table class="w3-table-all w3-hoverable">
EOL;
		$segnalanti = pg_query($conn,"SELECT segnalante FROM segnalato WHERE id_cinguettio=".$cing["id_cinguettio"]." AND mail='$mail'");
		
		while($segnalante = pg_fetch_assoc($segnalanti)){
			print "<tr><td>".ucfirst(explode("@", $segnalante["segnalante"])[0])."</td></tr>";
		};
		
		print <<<EOL
</table>
</div>
<footer class="w3-container w3-theme-l2">
<button type="button" class="w3-btn w3-theme-d2 w3-margin-top w3-margin-bottom" onclick="segnala('$id')"><i class="fa fa-close"></i>  Segnala</button>
</footer>
</div>
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
			$avatar = "img/img_avatar2.png";
		} else {
			$avatar = "img/img_avatar5.png";
		}
		
		$is_exp = pg_fetch_array(pg_query($conn, "SELECT count(*) FROM (SELECT mail FROM esperto WHERE mail='$user') AS exp"))[0];
		
		if($is_exp==0){
			print <<<EOL
<div class="w3-container w3-card-2 w3-white w3-round w3-margin" style="position: relative;"><br>
<img src="$avatar" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
<span class="w3-right w3-opacity">$data</span>
<h4>$name</h4><br>
<hr class="w3-clear">
<p>$desc</p>
<img src="$url" alt="$url" style="width:100%" class="w3-margin-bottom">
</div> 
EOL;
		} else {
			print <<<EOL
<div class="w3-container w3-card-2 w3-white w3-round w3-margin" style="position: relative;"><br>
<img src="$avatar" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
<span class="w3-right w3-opacity">$data</span>
<h4>$name</h4><br>
<hr class="w3-clear">
<p>$desc</p>
<img src="$url" alt="$url" style="width:100%" class="w3-margin-bottom">
<button type="button" class="w3-btn w3-theme-d1 w3-margin-bottom" onclick="document.getElementById('immModal_$id').style.display='block'"><i class="fa fa-thumbs-up"></i>  Apprezzamento</button>
</div>
<div id="immModal_$id" class="w3-modal">
<div class="w3-modal-content">
<header class="w3-container w3-theme-d2"> 
<span onclick="document.getElementById('immModal_$id').style.display='none'" class="w3-closebtn">&times;</span>
<h2>Apprezza immagine</h2>
</header>
<div class="w3-responsive w3-margin-top w3-margin-bottom w3-padding" style="text-align:center;">
<img src="$url" alt="$id" style="width:50%" class="w3-margin-bottom w3-padding">
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
			$apprezzamenti = pg_query($conn,"SELECT apprezzante, descrizione FROM apprezzamento WHERE id_immagine = ".$cing["id_immagine"]." AND creatore_immagine='$mail'");
			
			while($apprezzamento = pg_fetch_assoc($apprezzamenti)){
				$apprezzante = ucfirst(explode("@", $apprezzamento["apprezzante"])[0]);
				$testoApprez = $apprezzamento["descrizione"];
				
				print <<<EOL
<tr>
<td>$apprezzante</td>
<td>$testoApprez</td>
</tr>
EOL;
			}
			print <<<EOL
</table>
</div>
</div>
<footer class="w3-container w3-theme-l2">
<button type="button" class="w3-btn w3-theme-d2 w3-margin-top w3-margin-bottom" onclick="apprezza('$id')"><i class="fa fa-thumbs-o-up"></i> Apprezza</button>
</footer>
</div>
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
			$avatar = "img/img_avatar2.png";
		} else {
			$avatar = "img/img_avatar5.png";
		}
		
		print <<<EOL
<div class="w3-container w3-card-2 w3-white w3-round w3-margin" style="position: relative;"><br>
<img src="$avatar" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
<span class="w3-right w3-opacity">$data</span>
<h4>$name</h4><br>
<hr class="w3-clear">
<div style="display:none">$lat,$lon</div>
<iframe width="100%" height="400" frameborder="0" style="border:0;" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD59XdvHyQE8yPhgo15Vk9IBqpyMbYPHmw&q=$lat,$lon" allowfullscreen></iframe>
<button type="button" class="w3-btn w3-theme-d2 w3-margin-bottom" onclick="document.getElementById('luogoModal_$id').style.display='block'"><i class="fa fa-heart"></i>  Preferisci</button>
</div>
<div id="luogoModal_$id" class="w3-modal">
<div class="w3-modal-content">
<header class="w3-container w3-theme-d2"> 
<span onclick="document.getElementById('luogoModal_$id').style.display='none'" class="w3-closebtn">&times;</span>
<h2>Imposta luogo preferito</h2>
</header>
<div class="w3-container" style="max-height: 500px">
<p>Vuoi impostare questo luogo come preferito?</p>
<iframe width="100%" height="400" frameborder="0" style="border:0;" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD59XdvHyQE8yPhgo15Vk9IBqpyMbYPHmw&q=$lat,$lon" allowfullscreen></iframe>
</div>
<footer class="w3-container w3-theme-l2">
<button type="button" class="w3-btn w3-theme-d2 w3-margin-top w3-margin-bottom" onclick="preferisci('$id')"><i class="fa fa-heart"></i>  Imposta luogo preferito</button>
</footer>
</div>
</div>
EOL;
	}
}
print <<<EOL
<div id="last_post" class="w3-container w3-card-2 w3-white w3-round w3-margin" style="position: relative;">
<div style="text-align:center;"><i class="fa fa-spinner w3-spin w3-large"></i></div>
</div>
EOL;
								?>
								<!-- <div class="w3-container w3-card-2 w3-white w3-round w3-margin" style="position: relative;"><br>
<img id="avatar_seguito" src="img_avatar6.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
<span id="timestamp" class="w3-right w3-opacity">32 min</span>
<h4 id="nome_seguito">Angie Jane</h4><br>
<hr class="w3-clear">
<p id="immagine_descrizione">Have you seen this?</p>
<img id="immagine_url" src="img_nature.jpg" style="width:100%" class="w3-margin-bottom">
<p id="testo_cinguettio">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
<button id="apprezzamento" type="button" class="w3-btn w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Apprezzamento</button> 
<button id="preferimento" type="button" class="w3-btn w3-theme-d2 w3-margin-bottom"><i class="fa fa-heart"></i>  Preferisci</button>
<button type="button" class="w3-btn w3-theme-d2 w3-margin-bottom" style="position:absolute;right:12px;"><i class="fa fa-close"></i>  Segnala</button>
</div> -->
							</div>
							<!-- End Middle Column -->
							
							<!-- Right Column -->
							<div class="w3-col m2">
								<div class="w3-card-2 w3-round w3-white w3-padding-16 w3-center">
									<div class="w3-dropdown-hover" style="padding: 0px 5px;">
										<input id="search_friend" class="w3-input w3-border" type="text" style="margin-bottom: 5px;">
										<div id="search_result" class="w3-dropdown-content w3-border" style="right:0;width:100%;">
										</div>
									</div>
									<button type="button" class="w3-btn w3-theme" onclick="location.href = 'ricerca.php'"><i class="fa fa-search">
										Ricerca avanzata
										</i></button>
								</div>
								<br>
								<div class="w3-card-2 w3-round w3-white w3-padding-32 w3-center w3-hide-small">
									<p>
										<i class="fa fa-bug w3-xxlarge">
										</i>
									</p>
								
									<?php
$q_res = pg_query($conn, "SELECT seguito FROM segue WHERE segue = '$user' AND seguito = '$visit'");

if(pg_fetch_array($q_res)[0]==""){
	print "<p id=\"follow_p\"><button class=\"w3-btn w3-blue\" onclick=\"segui('$visit')\"><i class=\"fa fa-sign-in\"></i> Segui</button></p>";
} else {
	print "<p id=\"follow_p\"><button class=\"w3-btn w3-green\"><i class=\"fa fa-check\"></i> Già Seguito</button><br><button id=\"finish_follow\" class=\"w3-btn w3-tiny w3-red\" onclick=\"not_segui('$visit')\"> Non seguire più</button></p>";
}
									?>
									
								</div>
								<script>
									function segui(mail){
										var http = new XMLHttpRequest();
										var url = "follow.php";
										http.onreadystatechange = function() {
											if (http.readyState == 4 && http.status == 200) {
												response(mail, http.responseText);
											}
										};
										http.open("GET", url+"?mail="+mail, true);
										http.send();
									}
									function not_segui(mail){
										var http = new XMLHttpRequest();
										var url = "not_follow.php";
										http.onreadystatechange = function() {
											if (http.readyState == 4 && http.status == 200) {
												response(mail, http.responseText);
											}
										};
										http.open("GET", url+"?mail="+mail, true);
										http.send();
									}
									function response(mail, text){
										if(text=='ok_follow')
											document.getElementById('follow_p').innerHTML = '<p id="follow_btn"><button class="w3-btn w3-green"><i class="fa fa-check"></i> Già Seguito</button><br><button id="finish_follow" class="w3-btn w3-tiny w3-red" onclick=\"not_segui(\''+mail+'\')"> Non seguire più</button></p>';
										else if(text=='ok_not_follow')
											document.getElementById('follow_p').innerHTML = '<p id="follow_btn"><button class="w3-btn w3-blue" onclick="segui(\''+mail+'\')"><i class="fa fa-sign-in"></i> Segui</button></p>';
										else if(text=='nop')
											document.getElementById('follow_p').innerHTML = 'Si è verificato un errore, riprovare più tardi';
									}
								</script>
							</div>
							<!-- End Right Column -->
							
						</div>
						<!-- End Grid -->
						
					</div>
					<!-- End Page Container -->
					
					<br>
					
					<!-- Footer -->
					<footer class="w3-container w3-theme-d3 w3-padding-16 w3-center">
						<small style="color:light-grey;">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque rutrum orci lorem. Maecenas at augue tellus. Praesent id consequat elit, in egestas nulla. Vivamus vestibulum eros eget lacus hendrerit hendrerit. Mauris pulvinar eros eros. Nunc est elit, varius non blandit vel, malesuada non velit.
						</small>
					</footer>
					<footer class="w3-container w3-theme-d5">
						<p>
							Ideato e creato da Richard David Greco e Vittorio Toma <small><i class="fa fa-registered"></i></small>
						</p>
					</footer>
					<script>
						function myFunction(id) {
							var x = document.getElementById(id);
							if (x.className.indexOf("w3-show") == -1) {
								x.className += " w3-show";
								x.previousElementSibling.className += " w3-theme-d1";
							}
							else {
								x.className = x.className.replace("w3-show", "");
								x.previousElementSibling.className = 
									x.previousElementSibling.className.replace(" w3-theme-d1", "");
							}
						}
						function openNav() {
							var x = document.getElementById("navDemo");
							if (x.className.indexOf("w3-show") == -1) {
								x.className += " w3-show";
							}
							else {
								x.className = x.className.replace(" w3-show", "");
							}
						}
					</script>
					<script src="http://maps.googleapis.com/maps/api/js"></script>
					<script src="googlemap.js"></script>
					<script src="search.js"></script>
					<script src="recharge_user.js"></script>
					<script>
						if(window.innerHeight==document.body.offsetHeight){
							reach("finish");	
						}
					</script>
				</body>
			</html>