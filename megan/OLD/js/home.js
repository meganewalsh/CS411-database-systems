$(document).ready(function() {
    $("#refresh-loc-btn").click(geolocate);
    $("#location-select").change(locationUpdate);

alert("Hello! I am an alert box!!");


    $.get({
    	type: "GET",
    	url: "php/setup.php",
    	success: function(options) {
    		$("#location-select").html(options);
    		geolocate();
    	}
	});

});

function locationUpdate() {
	let newLoc = $("#location-select").val();
	$("#now-playing-heading").text(newLoc + " is playing...");
	$("#song-queue-heading").text("Queued up for " + newLoc);
	
	$.get({
		type: "GET",
		url: "php/get_queue.php",
		data: {loc: newLoc},
		success: function(data) {
			$("#songlist-table-body").html(data);
		}
	});
}

function geolocate() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(geoResponse);
    } else {
        console.log("Location not enabled/supported");
    }
    
    function geoResponse(geo) {
        let lat = geo.coords.latitude;
        let long = geo.coords.longitude;
        
        $.get({
    		type: "GET",
    		url: "php/geo_response.php",
    		data: {latitude: lat, longitude: long},
    		success: function(bldg) {
    		    $("#location-select").val(bldg);
    		    
    		    locationUpdate();
    		}
    	});
    }
}