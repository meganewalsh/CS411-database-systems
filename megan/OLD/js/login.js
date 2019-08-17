let username;

$(document).ready(function() {
    $("#logout-button").click(handleLogout);
    $("#login-submit").click(handleLogin);
    username = sessionStorage.getItem('user');
    checkLoggedIn();
});


function handleLogin() {
    let user_input = $("#username-input").val();
    let pw_input = $("#password-input").val();
    
    // Check against user table, warn if incorrect password and register if non-existent
    // Only close the pop-up on a successful login

    sessionStorage.setItem('user', user_input);
}

function handleLogout() {
    sessionStorage.removeItem('user');
    location.reload();
}

function checkLoggedIn() {
    let login_btn = $("#login-button");
    let logout_btn = $("#logout-button");
    
    if (username) {
        login_btn.hide();
        logout_btn.show();
        logout_btn.text("Sign out " + username);
    } else {
        login_btn.show();
        logout_btn.hide();
    }
}