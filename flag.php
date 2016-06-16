<?php
	session_start();
	
	if(!isset($_SESSION["user"])){
		header("Location: index.php");
	}
	
	require('connect.php');
	
	$conn = connectDB();
	
	if(!$conn){
		header("Location: home.php?res=nop");
	}
	
	$user = $_SESSION["user"];
	$tipo = $_POST["tipo"];
	
	switch ($tipo) {
    case "segnalazione":
		$mail_segnalato = $_POST["propietario"];
		$id_post = $_POST["id_post"];
		$query="INSERT INTO segnalato VALUES($id_post, '$mail_segnalato', '$user')";
        break;
    case "apprezzamento":
		$mail_propietario = $_POST["propietario"];
		$descrizione = $_POST["descrizione"];
		$id_post= $_POST["id_post"];
		$query = "INSERT INTO apprezzamento VALUES ('$descrizione', now(), now(), '$id_post','$mail_propietario', '$user')";		
        break;
    case "preferenzaLuogo":
		$mail_propietario = $_POST["propietario"];
		$id_post= $_POST["id_post"];
		$query = "UPDATE utente SET id_luogo='$id_post', creatore_luogo='$mail_propietario' WHERE mail='$user'";
        break;
	}
	
	$q_res = pg_query($conn, $query);		
		if(!$q_res){
			header("Location: home.php?res=nop");
		}	
	header("Location: home.php?res=ok");
		
?>
