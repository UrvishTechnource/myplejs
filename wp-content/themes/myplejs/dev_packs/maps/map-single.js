var infowindow = new google.maps.InfoWindow();
var pinkmarker = new google.maps.MarkerImage('/wp-content/themes/myplejs/library/js/maps/green_marker.png', new google.maps.Size(35, 35) );
var shadow = new google.maps.MarkerImage('/wp-content/themes/myplejs/library/js/maps/shadow.png', new google.maps.Size(45, 34) );
function initialize() {
	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 8,
		center: new google.maps.LatLng(59.496005, 18.294675),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});

	for (var i = 0; i < locations.length; i++) {
		var marker = new google.maps.Marker({
			position: locations[i].latlng,
			icon: pinkmarker,
			shadow: shadow,
			map: map
		});
	}

}