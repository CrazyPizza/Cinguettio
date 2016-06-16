<?php
	session_start();

	if(isset($_SESSION["user"])){
		header("Location: home.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cinguettio</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="w3.css">
	<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
	<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<style>
		#sfondo {
 			width: 100%; 
			height: 100%; 
			top: 0; 
			left: 0;
			background: url("img/background.jpg") no-repeat center top;
			position: fixed;
			z-index: -1;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			overflow: scroll;
		}
		
		input {
			color: black;	
		}
	</style>
</head>

<body class="w3-container" onload="reset()">
<div id="sfondo">
<br><br>

<div class="row">
	<div class="col-md-4" style="text-align:center;"><i class="fa fa-twitter fa-flip-vertical fa-flip-horizontal w3-margin-right"></i></div>

	<div id="login" class="w3-card-4 col-md-4 w3-animate-opacity w3-indigo" style="padding-top: 2%;">
		<form name="login" class="w3-container" action="control.php" method="post">
			<p>
				<input name="mail" class="w3-input" type="text" required>
				<label>Mail</label>
			</p>
			<p>      
				<input name="pssw" class="w3-input" type="password" required>
				<label>Password</label>
			</p>
			<p>
				<button class="w3-btn w3-blue">Login</button><span><a href="#" style="color:white;" onclick="change();" style="color:#660000;"> Non sei registrato? registrati</a></span>
			</p>
		</form>
	</div>
	
	<div id="register" class="w3-card-4 col-md-4 w3-animate-opacity w3-indigo" style="padding-top: 2%;display:none;">
		<form name="register" class="w3-container" action="register.php" method="post">
			<p>
				<input name="nome" class="w3-input" type="text" placeholder="Inserire nome" required>
				<label>Nome</label>
			</p>
			<p>
				<input name="cognome" class="w3-input" type="text" placeholder="Inserire cognome" required>
				<label>Cognome</label>
			</p>
			<p>
				<input name="mail" class="w3-input" type="email" placeholder="Inserire mail valida" required>
				<label>Mail</label>
			</p>
			<p>      
				<input name="pssw" class="w3-input" type="password" placeholder="Inserire password" required>
				<label>Password</label>
			</p>
			<p>      
				<input name="nascita_giorno" class="w3-input" type="number" placeholder="Inserire giorno" min="1" max="31"><input name="nascita_mese" class="w3-input" type="number" placeholder="inserire mese"  min="1" max="12"><input name="nascita_anno" class="w3-input" type="number" placeholder="inserire anno"  min="1916" max="1998">
				<label>Data di nascita</label>
			</p>
			<p>      
				<input name="nascita_luogo" class="w3-input" type="text" placeholder="Inserire luogo di nascita">
				<label>Luogo di nascita</label>
			</p>
			<p>      
				<input name="residenza" class="w3-input" type="text" placeholder="Inserire citta' di residenza">
				<label>Citta' di residenza</label>
			</p>
			<p>      
				<div style="border-bottom:solid 0.5px gray;">
					<input class="w3-radio" type="radio" name="gender" value=1 checked><label class="w3-validate">Maschio</label>
					<input class="w3-radio" type="radio" name="gender" value=0 ><label class="w3-validate">Femmina</label>
				</div>
				<label>Sesso</label>
			</p>
			<p>      
				<input name="nazionalita" class="w3-input" type="text" placeholder="inserire nazionalita'">
				<label>Nazionalita'</label>
			</p>
			<p>
				<button class="w3-btn w3-blue" onclick="controlla()">Registrati</button>
			</p>
		</form>
	</div>
	<div class="col-md-4"><p id="errors" style="color:red;"></p></div>
</div>
	<br><br><br>
<script>
function change(){
	document.getElementById('login').style.display = 'none';
	document.getElementById('register').style.display = 'block';
}

function reset(){
	document.forms["login"].reset();
	document.forms["register"].reset();
}
</script>
</div>
</body>
</html> 