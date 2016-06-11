<?php
	session_start();

	if(!isset($_SESSION["user"])){
		header("Location: index.php");
	}
	
	$user = $_SESSION["user"];
	$conn = pg_connect("host=localhost port=4321 dbname=cinguettio user=postgres password=unimi");
	
	$control = pg_fetch_array(pg_query($conn, "SELECT password FROM utente WHERE mail = '$user'"))[0];
	
	$pssw = $_POST["pssw"];

	if($pssw==$control){
		$new_pssw = $_POST["new_pssw"];
		if($new_pssw!=""){		
			$mail = $_POST["mail"];
			$nome = $_POST["nome"];
			$cognome = $_POST["cognome"];
			$data = $_POST["data"];
			$luogo = $_POST["luogo"];
			$citta = $_POST["citta"];
			$naz = $_POST["naz"];	
		
			$_SESSION["user"] = $mail;
			
			$fine = pg_query($conn, "UPDATE utente SET mail = '$mail', password = '$new_pssw', nome = '$nome', cognome = '$cognome', data_nascita = '$data', luogo_nascita = '$luogo', citta_residenza = '$citta', nazionalita = '$naz' WHERE mail = '$user'");
				
			if($fine){
				header('Location: user_setting.php');
			} else {
				print "Avvenuto errore, riprovare più tardi";	
			}
		} else {
			$mail = $_POST["mail"];
			$nome = $_POST["nome"];
			$cognome = $_POST["cognome"];
			$data = $_POST["data"];
			$luogo = $_POST["luogo"];
			$citta = $_POST["citta"];
			$naz = $_POST["naz"];	
		
			$_SESSION["user"] = $mail;
			
			$fine = pg_query($conn, "UPDATE utente SET mail = '$mail', nome = '$nome', cognome = '$cognome', data_nascita = '$data', luogo_nascita = '$luogo', citta_residenza = '$citta', nazionalita = '$naz' WHERE mail = '$user'");
				
			if($fine){
				header('Location: user_setting.php');
			} else {
				print "Avvenuto errore, riprovare più tardi";	
			}
		}
	} else {
		pg_query($conn, "UPDATE utente SET logged = 0 WHERE mail = '$user'");
		unset($_SESSION["user"]);
		session_unset();
		print "<!DOCTYPE html><html><head></head><body><script>setTimeout(function(){location.href='index.php'}, 3000);</script><p style=\"text-align:center;\"><h6>PASSWORD NON CORRISPONDENTE, VERRETE REINDIRIZZATI AL LOGIN PER ACCERTAMENTI SULLA VOSTRA IDENTITA'</h6><p></body></html>";
	}
?>