$(document).ready(function() {
    $("#logout-button").click(handleLogout);
    $("#login-form").submit(handleLogin);
	$("#login-fail-alert").hide();

    checkLoggedIn();
});


function handleLogin() {
    let user_input = $("#username-input").val();
    let pw_input = $("#password-input").val();
    
    // Check against user table, warn if incorrect password and register if non-existent
    // Only close the pop-up on a successful login
    $.post({
		url: "php/user_login.php",
		data: {username: user_input, password: pw_input},
		success: function(response) {
			console.log(response);
			if (response === "Failed") {
				$("#login-fail-alert").show();
			} else {
				sessionStorage.setItem('user', user_input);
				location.reload();
			}
		}
	});

	return false;	// Prevents automatic reload in case login fails
}

function handleLogout() {
    sessionStorage.removeItem('user');
    location.reload();
}

function checkLoggedIn() {
    let login_btn = $("#login-button");
    let logout_btn = $("#logout-button");
	let username = sessionStorage.getItem("user");
    
    if (username) {
        login_btn.hide();
        logout_btn.show();
        logout_btn.text("Sign out " + username);
    } else {
        login_btn.show();
        logout_btn.hide();
    }
}
