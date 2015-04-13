var latlng = null;  
var map;

// funzione che trasforma un indirizzo in coordinate, e le imposta sulla mappa e negli input
function codeAddress(address) {
	geocoder.geocode( { 'address': address}, function(results, status){
		if(status == google.maps.GeocoderStatus.OK){
			map.setCenter(results[0].geometry.location);
			marker.setPosition(results[0].geometry.location);
			$('#coord_lat').val(results[0].geometry.location.lat());
			$('#coord_lng').val(results[0].geometry.location.lng());
		}else{
			alert("Geocode ha rilevato questo errore: " + status);
		}
	});
}   	

function initialize() {
	
	geocoder = new google.maps.Geocoder();
	
	latlng=new google.maps.LatLng(lat, lng);
	
	var myOptions={
		zoom: 14,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	
	map=new google.maps.Map(document.getElementById('map'), myOptions);
	
		
	marker=new google.maps.Marker({
		map:map,
		draggable:true,
		animation: google.maps.Animation.DROP,
		position: latlng
	});
  
	$('#map_centra').click(function(e) {
		e.stop();
		map.setCenter(latlng);
	});
		
	var funPos = function(e) {
		latlng = e.latLng;
		map.setCenter(latlng);
		marker.setPosition(e.latLng);
		$('#coord_lat').attr('value', e.latLng.lat());
		$('#coord_lng').attr('value', e.latLng.lng());
	}	
	
	listener=google.maps.event.addListener(map, 'click', funPos);
	listener2=google.maps.event.addListener(marker, 'mouseup', funPos);
  	
	google.maps.event.addListener(marker, 'click', function() { 
		infowindow.open(map,marker);
	});

	google.maps.event.addListener(marker, 'click', toggleBounce);
	
}
  
function toggleBounce() {
	if(marker.POSTAnimation()!=null){
		marker.setAnimation(null);
	}else{
		marker.setAnimation(google.maps.Animation.BOUNCE);
	}
}    