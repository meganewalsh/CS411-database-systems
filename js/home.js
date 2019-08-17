$(document).ready(function() {
    $("#refresh-loc-btn").click(geolocate);
    $("#refresh-queue-btn").click(queueUpdate);
    $("#location-select").change(queueUpdate);
	$("#addsong-form").submit({existing: true}, addSong);
	$("#newsong-form").submit({existing: false}, addSong);
	$("#modal-login-btn").click(function() {$("#user-modal").modal('show');});
	$("#weekly-popularity").click(weeklyPopularity);
	$("#user-pop").click(userPop);

	$("#addsong-button").click(function() {
			if (sessionStorage.getItem("user"))
				$("#addsong-modal").modal('show');
			else
				$("#require-login-modal").modal('show');
		});	

    $.get({
    	url: "php/setup.php",
    	success: function(options) {
    		$("#location-select").html(options);
    		geolocate();
    	}
	});
});

function queueUpdate() {
	let loc = $("#location-select").val();
	let username = sessionStorage.getItem('user');
	$("#now-playing-heading").text(loc + " is playing...");
	$("#song-queue-heading").text("Queued up for " + loc);
	
	$.get({
		url: "php/get_queue.php",
		data: {loc: loc, user: username},
		success: function(songQueue) {
			let tableContents = queueToTable(JSON.parse(songQueue));
			$("#songlist-table-body").html(tableContents);
			// Uncolor any disabled buttons
			$(".vote-btn:disabled").removeClass("btn-primary btn-danger");
		}
	});
}

function weeklyPopularity() {
	let loc = $("#location-select").val();
	let username = sessionStorage.getItem('user');
	$("popularity-heading").text(loc + "'s previous week popularity");
	
	$.get({
		url: "php/weekly_popularity.php",
		data: {loc: loc, user: username},
		success: function(songQueue) {
			let tableContents = queueToTable(JSON.parse(songQueue));
			$("#songlist-table-body").html(tableContents);
			$('.btn-dark').hide();
			$('.vote-btn').hide();
		}
	});

}

function userPop() {
	if (!sessionStorage.getItem('user')) {
        $("#require-login-modal").modal('show');
        return;
    }	

	let loc = $("#location-select").val();
	let username = sessionStorage.getItem('user');
	
	$.get({
		url: "php/user_pop.php",
		data: {loc: loc, user: username},
		success: function(songQueue) {
			let tableContents = queueToTable(JSON.parse(songQueue));
			$("#songlist-table-body").html(tableContents);
			$('.btn-dark').hide();
			$('.vote-btn').hide();
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
        let lon = geo.coords.longitude;
		console.log(lat, lon);
        
        $.get({
    		url: "php/geo_response.php",
    		data: {latitude: lat, longitude: lon},
    		success: function(bldg) {
    		    $("#location-select").val(bldg).trigger('change');
    		}
    	});
    }
}

function queueToTablePOP(queue) {
	let username = sessionStorage.getItem('user');
	let medals = ["#ffdf00", "#c4c4c4", "#cdcead"];

	result = "";
	for (let i = 0; i < queue.length; i++) {
		let song = queue[i];
		let userVote = parseInt(song.value);
		let medal = "white";
		if (i < 3)
			medal = medals[i];

		result += `<tr style="background-color:${medal}">
			<td>
				<button onclick="performVote(${song.queue_id}, 1);" class="btn btn-sm rounded-circle btn-primary m-0 vote-btn" ${userVote === 1 ? 'disabled' : ''}><span class="fa fa-thumbs-up" aria-hidden="true"></span></button>
				<span class="badge badge-pill badge-light mx-1">${song.rating}</span>
				<button onclick="performVote(${song.queue_id}, 0);" class="btn btn-sm rounded-circle btn-danger m-0 vote-btn" ${userVote === 0 ? 'disabled' : ''}><span class="fa fa-thumbs-down"></span></button>
			</td>
			<td>${song.name}</td>
			<td>${song.artist}</td>
			<td><a target="_blank" href=${song.url}>${song.url}</a></td>
			<td>${song.submitter}</td>
			<td>`;
		if (song.submitter === username) {
			result += `<button class="btn btn-sm btn-dark" onclick="removeSong(${song.queue_id});">Remove</button>`;
		}

	}

	return result;
}
