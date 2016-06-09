<?php
	session_start();
	
	$conn = pg_connect("host=localhost port=4321 dbname=cinguettio user=postgres password=unimi");
	
	if(!$conn){
		print "Connection to DB failed, repeat later";
		exit;
	}

	$nome = $_POST["nome"];
	$cognome = $_POST["cognome"];
	$mail = $_POST["mail"];
	$pssw = $_POST["pssw"];
	$luogo_nascita = $_POST["nascita_luogo"];
	$citta = $_POST["residenza"];
	$sesso = $_POST["gender"];
	$nazione = $_POST["nazionalita"];
	if($_POST["nascita_anno"]==null || $_POST["nascita_mese"]==null || $_POST["nascita_giorno"]==null){
		$query = pg_query("INSERT INTO utente VALUES ('$mail', '$pssw', '$nome', '$cognome', NULL, '$luogo_nascita', '$citta', NULL, NULL, '$nazione', $sesso, 1);");
	} else {
		$data_nascita = $_POST["nascita_anno"]."-".$_POST["nascita_mese"]."-".$_POST["nascita_giorno"];
		$query = pg_query("INSERT INTO utente VALUES ('$mail', '$pssw', '$nome', '$cognome', '$data_nascita', '$luogo_nascita', '$citta', NULL, NULL, '$nazione', $sesso, 1);");
	}
	
	if(!$query){
		print pg_last_error();
		exit;
	}
	
	$_SESSION["user"] = $mail;
	header("Location: home.php");
?>