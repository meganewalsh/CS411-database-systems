$(document).ready(function () {
    updater();
});

async function updater() {
    while (true) {
        await sleep(2000);
        update();
    }
}
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

var skip = -1;
function update() {
    // Check for chat update
    updateChat();
	
	skip = (skip + 1) % 3;
	if (skip % 3 === 0) {
    	// Check for song update
		countdownUpdate();
    	nowPlaying();
	}
}
