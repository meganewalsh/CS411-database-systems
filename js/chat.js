$(document).ready(function () {
    setWindowSizes(); 
});

function setWindowSizes() {
    var chatDisplay = $('#chat-display');
    var height = $('#chat-container').height() - 170;
    chatDisplay.height(height);
}

function getDateString(date) {
    var year = ("0000" + date.getFullYear()).slice(-4)
    var month = ("00" + date.getMonth()).slice(-2)
    var day = ("00" + date.getDay()).slice(-2)
    var hours = ("00" + date.getHours()).slice(-2)
    var minutes = ("00" + date.getMinutes()).slice(-2)
    var seconds = ("00" + date.getSeconds()).slice(-2)
    var milliseconds = ("000" + date.getMilliseconds()).slice(-3)
    return year + "." + month + "." + day + "::"
        + hours + ":" + minutes + ":" + seconds + ":" + milliseconds
}

function inputChat() {
    var chatbox = $('#chatbox');
    var date = new Date();
    var dateString = getDateString(date)
    if(chatbox.val().trim().length > 0) {
        sendChat("User", dateString, chatbox.val());
        chatbox.val("");
    }
}

function sendChat(user, date, chat) {
    console.log(sessionStorage.getItem("user"));
    chat = escapeQuotes(chat);
    $.post({
        url: "php/send_chat.php",
        data: {username: sessionStorage.getItem("user"),
              timestamp: date,
              user_loc: $("#location-select").val(),
              message: chat
        },
        success: function() {
            console.log("Chat sent");
        }
    });
}

function escapeQuotes(message) {
    message = message.replace(/"/g, '\\"');
    message = message.replace(/'/g, "''");
    return message;
}

function addChat(user, date, chat) {
    var chatDisplay = $('#chat-display');
    console.log(chat);

    // If at the bottom, stay at the bottom
    console.log(chatDisplay.scrollTop());
    console.log(chatDisplay.innerHeight());
    console.log(chatDisplay[0].scrollHeight);

    var atBottom = chatDisplay.scrollTop() + chatDisplay.innerHeight() >= chatDisplay[0].scrollHeight;

    console.log(atBottom);

    chatDisplay.append("[" + date + "] " + user + ": " + chat + "<br />");

    if (atBottom) {
        chatDisplay.scrollTop(chatDisplay[0].scrollHeight);
    }
}

function updateChat() {
    var chatDisplay = $('#chat-display');
    var loc = $("#location-select").val();

	  $.get({
	  	  url: "php/get_chats.php",
	  	  data: {user_loc: loc},
	  	  success: function(data) {
            var chats = JSON.parse(data);
            var atBottom = chatDisplay.scrollTop() + chatDisplay.innerHeight() >= chatDisplay[0].scrollHeight;
            var contents = "";
            for (i = chats.length-1; i >= 0; i--) {
                let chat = chats[i];
                contents += ("[" + chat['timestamp'] + "] " + chat['username'] + ": " + chat['message'] + "<br />");
            }
            chatDisplay.html(contents);
            if (atBottom) {
                chatDisplay.scrollTop(chatDisplay[0].scrollHeight);
            }
	  	  },
        error: function(err) {
            console.log(err);
        }
	  });
}

$(document).keypress( function(e) {
    if (e.which == 13) {
        if($('#chatbox').is(':focus')) {
            inputChat();
            return false;
        }
    }
});
