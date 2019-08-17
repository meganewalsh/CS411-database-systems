$(document).ready(function() {

	$("#artist-select").change(getSong);
	
});


function getSong() {

   	let selected_artist = $("#artist-select").val();
    
    $.get({
    	url: "php/searchSongs_names.php",
    	data: {art: selected_artist},
    	success: function(options) {
    		$("#name-select").html(options);
    		$("#updatename-select").html(options);
    	}
	});
}