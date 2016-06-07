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
	
	http.open("POST", url, true);
	http.send();
}

function risposta(text){
	if(text=='OK'){
		document.getElementById('modal_button').click;
		setTimeout(1500, document.getElementById('modal_close').click);
	}
}