document.getElementById('luogo_lat').addEventListener('input', mapLat);
document.getElementById('luogo_lon').addEventListener('input', mapLon);

function mapLat(){
	var change = this.value;
	if(!isNaN(change) && change>-90 && change<90){
		var mappa = document.getElementById('map');
		mappa.src = 'https://www.google.com/maps/embed/v1/place?q=('+change+',150.644)&key=AIzaSyD59XdvHyQE8yPhgo15Vk9IBqpyMbYPHmw';
	}
}

function mapLon(){
	var change = this.value;
	if(!isNaN(change) && change>-180 && change<180){
		var mappa = document.getElementById('map');
		mappa.src = 'https://www.google.com/maps/embed/v1/place?q=(-34.397,'+change+')&key=AIzaSyD59XdvHyQE8yPhgo15Vk9IBqpyMbYPHmw';
	}
}
