$(document).ready(function() {
    $("#location-select").change(nowPlaying);
});

var currentSong;

function nowPlaying() {
    let user_loc = $("#location-select").val();
	$.get({
		url: "php/display_song.php",
		data: {user_loc: user_loc},
		success: function(options) {
            var myObj = JSON.parse(options);
            if (!stringEquals(currentSong, myObj)) {
				let emphasis = "text-success";
				let heading = $("#now-playing-heading");
				let orig = heading.text();
				heading.text("Switching songs in " + user_loc + "!");
				heading.addClass(emphasis).fadeIn('slow').fadeOut(300).fadeIn('slow').fadeOut(300).fadeIn('slow', function() {
																						heading.removeClass(emphasis);
																						heading.text(orig);
																					});

                currentSong = myObj;
                var auto = "?autoplay=1";
                var str = ( (myObj[0].url).replace("watch?v=", "embed/").concat(auto) );
                
                document.getElementById("displaySongName").innerHTML = myObj[0].name;
                document.getElementById("displayArtistName").innerHTML = myObj[0].artist;
                document.getElementById("displayRating").innerHTML = myObj[0].rating;
                document.getElementById("displaySubmitter").innerHTML = myObj[0].submitter;
                document.getElementById("songplay").src = str;
            }
		}
	});

    
//});
}

function stringEquals(one, two) {
    var equals = JSON.stringify(one) === JSON.stringify(two)
    return equals
}

var prevRemaining = -1;
function countdownUpdate() {
	$.get("php/MINUTES.txt", function(data) {
			let remaining = 5 - parseInt(data);
			if (prevRemaining === remaining)
				return;

			prevRemaining = remaining;
			let emphasis = "text-danger";
			let suffix;
			if (remaining === 1) {
				$("#countdown-heading").addClass(emphasis);
				suffix = " minute remaining";
			} else {
				$("#countdown-heading").removeClass(emphasis);
				suffix = " minutes remaining";
			}
			$("#countdown-heading").text(remaining + suffix);
		});
}
