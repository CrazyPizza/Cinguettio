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