function segnala(tipo, id){
	
}

function cinguetta(){
	var form = document.createElement('FORM');
	form.method = 'POST';
	form.action = 'queryhandler.php';
	form.style.display = 'none';
	
	var tipo = document.createElement('INPUT');
	tipo.type = 'TEXT';
	tipo.name = 'tipo';

	var testo = document.createElement('INPUT');
	testo.type = 'TEXT';
	testo.name = 'testo';
	
	form.appendChild(tipo);
	form.appendChild(testo);
	document.body.appendChild(form);
	
	tipo.value = 'cinguettio';
	testo.value = document.getElementById('post_text').value;
	
	form.submit();
}

function immagina(){
	var form = document.createElement('FORM');
	form.method = 'POST';
	form.action = 'queryhandler.php';
	form.style.display = 'none';
	
	var tipo = document.createElement('INPUT');
	tipo.type = 'TEXT';
	tipo.name = 'tipo';
	
	var url = document.createElement('INPUT');
	url.type = 'TEXT';
	url.name = 'url';
	
	var desc = document.createElement('INPUT');
	desc.type = 'TEXT';
	desc.name = 'descrizione';
	
	form.appendChild(tipo);
	form.appendChild(url);
	form.appendChild(desc);
	document.body.appendChild(form);
	
	tipo.value = 'immagine';
	url.value = document.getElementById('immagine_url').value;
	desc.value = document.getElementById('immagine_desc').value;
	
	form.submit();
}

function luoga(){
	var form = document.createElement('FORM');
	form.method = 'POST';
	form.action = 'queryhandler.php';
	form.style.display = 'none';
	
	var tipo = document.createElement('INPUT');
	tipo.type = 'TEXT';
	tipo.name = 'tipo';
	
	var lat = document.createElement('INPUT');
	lat.type = 'TEXT';
	lat.name = 'lat';
	
	var lon = document.createElement('INPUT');
	lon.type = 'TEXT';
	lon.name = 'lon';
	
	form.appendChild(tipo);
	form.appendChild(lat);
	form.appendChild(lon);
	document.body.appendChild(form);
	
	
	tipo.value = 'luogo';
	lat.value = document.getElementById('luogo_lat').value;
	lon.value = document.getElementById('luogo_lon').value;
	
	form.submit();
}

/* Alternativa alle funzioni riportate sopra
Verrebbe tolto lo script per la gestione del modal "modal-post" nella home poiché sostituito da questo

function pubblica(tipo){
	var http = new XMLHttpRequest();
	var url = "queryhandler.php";
	
	switch(tipo){
		case 'cinguettio':
			url = url+'?tipo='+tipo+'&testo='+document.getElementById('post_text').value;
			break
		case 'immagine':
			url = url+'?tipo='+tipo+'&url='+document.getElementById('immagine_url').value+'&descrizione='+document.getElementById('immagine_desc').value;
			break;
		case 'luogo':
			url = url+'?tipo='+tipo+'&lat='+document.getElementById('luogo_lat').value+'&long='+document.getElementById('luogo_lon').value;
			break;
	}

	http.onreadystatechange = function() {
		if (http.readyState == 4 && http.status == 200) {
			risposta(http.responseText);
		}
	};
	
	http.open("GET", url, true);
	http.send();
}

function risposta(text){
	if(text=='ok'){
		document.getElementById('modal_button').click();
		document.getElementById('yea_or_not').innerHTML = "Hai cinguettato con successo!";
		document.getElementById('yea_or_not').style.color = 'green';
		setTimeout(function(){document.getElementById('modal_close').click();}, 3000);
	} else if(location.href.split('=')[1]=='nop'){
		document.getElementById('modal_button').click();
		document.getElementById('yea_or_not').innerHTML = "E' avvenuto un disguido, riprovare più tardi";
		document.getElementById('yea_or_not').style.color = 'red';
		setTimeout(function(){document.getElementById('modal_close').click();}, 3000);
	}
}
*/