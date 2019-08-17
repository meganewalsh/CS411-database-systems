function addSong(ev) {
	let currLocation = $("#location-select").val();
	let submitter = sessionStorage.getItem("user");

	let artist;
	let title;
	let url;
	if (ev.data.existing) {
		artist = $("#artist-select").val();
		title = $("#name-select").val();
	} else {
		artist = $("#add_artistname").val();
		title = $("#add_songname").val();
		url = $("#url").val();
	}

	$.post({
			url: "php/song_request.php",
			data: {
				art: artist,
				tit: title,
				username: submitter,
				user_loc: currLocation,
				url: url,
				existing: ev.data.existing
			},
			success: queueUpdate 
		  });

	$("#addsong-modal").modal('hide');
	return false;
}

function removeSong(queueId) {
	console.log("Removing " + queueId + " from queue");
	$.post({
			url: "php/remove_song.php",
			data: {
				queue_id: queueId
			},
			success: function(resp) {
				console.log(resp);
				queueUpdate();
			}
		  });
}

function performVote(queueId, value) {
	let username = sessionStorage.getItem('user');
	if (!username) {
		$("#require-login-modal").modal('show');
		return;
	}

	console.log(username + " votes " + value + " on " + queueId);
	// TODO
	// Check if user has already voted for this queue_id
	// If yes, change values to reflect this
	// Else, add it to Votes table
	$.post({
			url: "php/perform_vote.php",
			data: {
				queue_id: queueId,
				value: value,
				username: username,
			},
			success: function(resp) {
				console.log(resp);
				queueUpdate();
			}
		});
}




// Formats the php returned JSON array into table contents
function queueToTable(queue) {
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

		result += "</td></tr>";
	}

	return result;
}
