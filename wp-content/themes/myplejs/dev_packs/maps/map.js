var infowindow = new google.maps.InfoWindow();
var pinkmarker = new google.maps.MarkerImage('/wp-content/themes/myplejs/library/js/maps/green_marker.png', new google.maps.Size(35, 35) );
var shadow = new google.maps.MarkerImage('/wp-content/themes/myplejs/library/js/maps/shadow.png', new google.maps.Size(45, 34) );
function initialize() {
	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 12,
		center: new google.maps.LatLng(59.334153, 18.069592),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});

	for (var i = 0; i < locations.length; i++) {
		var marker = new google.maps.Marker({
			position: locations[i].latlng,
			icon: pinkmarker,
			shadow: shadow,
			map: map
		});
		google.maps.event.addListener(marker, 'click', (function(marker, i) {
		  return function() {
			  infowindow.setContent(locations[i].info);
			  infowindow.open(map, marker);
		    };
		    })(marker, i));
	}

}