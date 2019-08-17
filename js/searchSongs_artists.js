$(document).ready(function() {
    
    $.get({
    	url: "php/searchSongs_artists.php",
    	success: function(options) {
    		$("#artist-select").html(options);
    		$("#updateartist-select").html(options);
    	}
	});
    
});