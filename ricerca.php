<?php
session_start();

require('connect.php');

if(!isset($_SESSION["user"])){
	header("Location: index.php");
}

$user = $_SESSION["user"];

$conn = connectDB();

if(!$conn){
	print "Connection to DB failed, repeat later";
	exit;
}

$personal = pg_fetch_assoc(pg_query($conn, "SELECT * FROM utente JOIN luogo ON utente.creatore_luogo=luogo.mail AND utente.id_luogo=luogo.id_luogo WHERE utente.mail = '$user'"));

$avatar = pg_fetch_array(pg_query($conn, "SELECT sesso FROM utente WHERE mail='$user'"))[0];

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
					<a class="w3-padding-large" href="#"><i class="fa fa-search">
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
								<?php print ucfirst(explode("@", $user)[0]); ?></h4>
							<p class="w3-center">
								<img src="<?php print $avatar; ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar">
							</p>
							<hr>
							<p>
								<i name="citta_nascita" class="fa fa-home fa-fw w3-margin-right w3-text-theme">
								</i>
								<?php print $personal["luogo_nascita"]; ?></p>
							<p>
								<i name="data_nascita" class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme">
								</i>
								<?php print $personal["data_nascita"]; ?></p>
							<p>
								<i name="luogo_pref" class="fa fa-gittip fa-fw w3-margin-right w3-text-theme">
								</i>
								<?php if($personal["latitudine"]!=null && $personal["longitudine"]!=null){print "<a href=\"https://www.google.com/maps/embed/v1/place?key=AIzaSyD59XdvHyQE8yPhgo15Vk9IBqpyMbYPHmw&q=".$personal["latitudine"].",".$personal["longitudine"]."\" target=\"_blank\" style=\"text-decoration:none;\">".$personal["latitudine"].", ".$personal["longitudine"]."</a>";} ?></p>
						</div>
					</div>
					<br>
					
					<!-- Accordion -->
					<div class="w3-card-2 w3-round">
						<div class="w3-accordion w3-white">
							<button onclick="myFunction('Demo1')" class="w3-btn-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right">
								</i> I miei post</button>
							<div id="Demo1" class="w3-accordion-content w3-container">
								
								<?php
$pers = pg_query($conn, "SELECT testo, now()-data_e_ora AS time FROM cinguettio WHERE mail = '$user' ORDER BY data_e_ora DESC LIMIT 5");

while($row = pg_fetch_assoc($pers)){
	print "<p>".$row["testo"]."<small> ".$row["time"]."</small></p><hr>";
}
print "<p>...</p>"
								?>
								
							</div>
							<button onclick="myFunction('Demo2')" class="w3-btn-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right">
								</i> I miei luoghi</button>
							<div id="Demo2" class="w3-accordion-content w3-container">
								
								<?php
$pers = pg_query($conn, "SELECT latitudine, longitudine, now()-data_e_ora AS time FROM luogo WHERE mail = '$user' ORDER BY data_e_ora DESC LIMIT 5");

while($row = pg_fetch_assoc($pers)){
	print "<p><a href=\"https://www.google.com/maps/embed/v1/place?key=AIzaSyD59XdvHyQE8yPhgo15Vk9IBqpyMbYPHmw&q=".$row["latitudine"].",".$row["longitudine"]."\" target=\"_blank\">".$row["latitudine"].", ".$row["longitudine"]."</a><small> ".$row["time"]."</small></p><hr>";
}
print "<p>...</p>";
								?>
								
							</div>
							<button onclick="myFunction('Demo3')" class="w3-btn-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right">
								</i> Le mie foto</button>
							<div id="Demo3" class="w3-accordion-content w3-container">
								<div class="w3-row-padding">
									<br>
									
									<?php
$pers = pg_query($conn, "SELECT url, now()-data_e_ora AS time FROM immagine WHERE mail = '$user' ORDER BY data_e_ora DESC LIMIT 5");

while($row = pg_fetch_assoc($pers)){
	$url = $row["url"];
	$time = $row["time"];
	print <<<EOL
<div class="w3-half">
<small> $time</small>
<img src="$url" style="width:100%" class="w3-margin-bottom">
</div>
EOL;
}
print "<div class=\"w3-half\"><small>...</small></div>";
									?>
									
								</div>
							</div>
						</div>
					</div>
					<br>
					
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
				<div class="w3-col m7">
					<div id="luogo" class="cinguettio">
						<div class="w3-row-padding">
							<div class="w3-col m12">
								<div class="w3-card-2 w3-round w3-white">
									<form class="w3-container w3-padding" name="research" action="ris_ricerca.php" method="GET">
										<h6 class="w3-opacity">
											Ricerca avanzata
										</h6>
										<div class="w3-container w3-padding" >
											<label>Mail</label>
											<input class="w3-check" type="checkbox">
											<input class="w3-input w3-border w3-animate-input" name="mail" type="text" style="width:0%" disabled>
											<br>
											<label>Nome</label>
											<input class="w3-check" type="checkbox">
											<input class="w3-input w3-border w3-animate-input" name="nome" type="text" style="width:0%" disabled>
											<br>
											<label>Cognome</label>
											<input class="w3-check" type="checkbox">
											<input class="w3-input w3-border w3-animate-input" name="cognome" type="text" style="width:0%" disabled>
											<br>
											<label>Città Residenza</label>
											<input class="w3-check" type="checkbox">
											<input class="w3-input w3-border w3-animate-input" name="citta" type="text" style="width:0%" disabled>
											<br>
											<label>Nazionalità</label>
											<input class="w3-check" type="checkbox">
											<input class="w3-input w3-border w3-animate-input" name="nazione" type="text" style="width:0%" disabled>
											<br>
											<label>Città Nascita</label>
											<input class="w3-check" type="checkbox">
											<input class="w3-input w3-border w3-animate-input" name="nascita" type="text" style="width:0%" min="18" disabled>
											<br>
										</div>
										<button type="submit" class="w3-btn w3-theme"><i class="fa fa-globe">
											</i>  Cerca</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					<script>
						var ck = document.getElementsByClassName('w3-check');
						for(i=0; i<ck.length; i++)
							ck[i].addEventListener('click', validate);
						function validate(){
							var inp = this.nextSibling;
							if(this.checked){
								inp.disabled = false;
								inp.style.width = '30%';
							}
							else {
								inp.disabled = true;
								inp.style.width = '0%';
							}
						}
					</script>
				</div>
				<!-- End Middle Column -->
				
				<!-- Right Column -->
				<div class="w3-col m2">
					<div class="w3-card-2 w3-round w3-white w3-padding-32 w3-center w3-hide-small">
						<p>
							<i class="fa fa-bug w3-xxlarge">
							</i>
						</p>
					</div>
				</div>
				<!-- End Right Column -->
				
			</div>
			<!-- End Grid -->
			
		</div>
		<!-- End Page Container -->
		
		<br>
		
		<!-- Footer -->
		<footer class="w3-container w3-theme-d3 w3-padding-16">
			<h5>
				Footer
			</h5>
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
	</body>
</html>