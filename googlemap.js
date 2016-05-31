document.getElementById('luogo_lat').addEventListener('input', mapLat);
document.getElementById('luogo_lon').addEventListener('input', mapLon);

var map;
var marker;

function initialize() {
	var mapProp = {
		center:new google.maps.LatLng(51.508742,-0.120850),
		zoom:5,
		mapTypeId:google.maps.MapTypeId.HYBRID
	};
	
	map=new google.maps.Map(document.getElementById("map"),mapProp);
	google.maps.event.addListener(map, 'click', function(event) {
		placeMarker(event.latLng);
	});
}

function centerMap(){
	google.maps.event.trigger(map, 'resize');
}

function placeMarker(location) {
	if(marker!=null)
		marker.setMap(null);
	marker = new google.maps.Marker({
    position: location,
    map: map,
	});
	var infowindow = new google.maps.InfoWindow({
		content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
	});
	
	document.getElementById("luogo_lat").value=location.lat();
	document.getElementById("luogo_lon").value=location.lng();
	infowindow.open(map,marker);
	marker.addListener('click', function() {
		infowindow.open(map, marker);
	});
}

function mapLat(){
	var change = this.value;
	if(!isNaN(change) && change>-90 && change<90){
		newLocation = new google.maps.LatLng(change,map.getCenter().lng());
		map.setCenter(newLocation);
		placeMarker(newLocation);
	}
}

function mapLon(){
	var change = this.value;
	if(!isNaN(change) && change>-180 && change<180){
		newLocation = new google.maps.LatLng(map.getCenter().lat(),change);
		map.setCenter(newLocation);
		placeMarker(newLocation);
	}
}
google.maps.event.addDomListener(window, 'load', initialize);





