function buildPlayer(name) {

	// initialize variables for playback
	var player = $("#" + name + " .audio")[0];
	var playBtn = $("#" + name + " .play-btn")[0];
	var muteBtn = $("#" + name + " .mute-btn")[0]
	var volume = $("#" + name + " .volume")[0];
	var currentVolume;

	// get total length after metadata loads
	player.addEventListener("loadeddata", function() {
		var duration = player.duration;
		var durationTime = calculateTime(duration);
		$("#" + name + " .duration").html(durationTime);
	});

	// Listens for play/pause to be clicked
	playBtn.addEventListener('click', function() {
		togglePlay()
	});

	// listen for clicks of the volume bar to call the adjust volume function
	volume.addEventListener("click", adjustVolume);
	
	// listen for clicks of the volume bar to call the adjust volume function
	muteBtn.addEventListener("click", toggleMute);
	
	// Toggles play/pause
	function togglePlay() {
		if (player.paused === false) {
			player.pause();
			$("#" + name + " .controls .play-btn .icon-play").removeClass("hide");
			$("#" + name + " .controls .play-btn .icon-pause").addClass("hide");
		} else {
			player.play();
			$("#" + name + " .controls .play-btn .icon-play").addClass("hide");
			$("#" + name + " .controls .play-btn .icon-pause").removeClass("hide");
		}
	}
	
	// uses x offset of click to calculate seek position for the progress bar
	function adjustVolume(evt) {
		var percent = evt.offsetX / this.offsetWidth;
		var volumeBarSize = percent * 100;
		$("#" + name + " .volume .volume-bar").width(volumeBarSize + '%');
		player.volume = percent;
	}

	// captures current volume and toggles between current and 0 volume
	function toggleMute() {
		if (player.volume !== 0) {
			currentVolume = player.volume;
			player.volume = 0;
			$("#" + name + " .volume .volume-bar").width('0%');
			$("#" + name + " .mute-btn .icon-volume").addClass("hide");
			$("#" + name + " .mute-btn .icon-mute").removeClass("hide");
		} else {
			player.volume = currentVolume;
			$("#" + name + " .volume .volume-bar").width( currentVolume * 100 + '%');
			$("#" + name + " .mute-btn .icon-volume").removeClass("hide");
			$("#" + name + " .mute-btn .icon-mute").addClass("hide");
		}
	}

}

function audioUpdate(name) {

	// initialize variables for time
	var player = $("#" + name + " .audio")[0];
	var progress = $("#" + name + " .progress")[0];
	var current_time = player.currentTime;

	// calculate current value time
	var currentTime = calculateTime(current_time);
	$("#" + name + " .current-time").html(currentTime);
	
	// updates progressbar size according to location
	var progressBarSize = ((player.currentTime / player.duration)*100);
	$("#" + name + " .progress .progress-bar").width(progressBarSize + '%');
	
	// listen for clicks of the progress bar to call the seek function
	progress.addEventListener("click", seek);
	
	// pause track if track reaches the end
	if (player.currentTime == player.duration) {
		$("#" + name + " .controls .play-btn").removeClass("pause");
	}
	
	// uses x offset of click to calculate seek position for the progress bar
	function seek(evt) {
		var percent = evt.offsetX / this.offsetWidth;
		player.currentTime = percent * player.duration;
		progress.value = percent / 100;
	}

}

function calculateTime(length) {
	
	var Hours = Math.floor(length / 3600);
	var Minutes = Math.floor(length % 3600 / 60);
	var Seconds = Math.floor(length % 3600 % 60);
	var MM = ('0' + Minutes).slice(-2);
	var SS = ('0' + Seconds).slice(-2);

	if (Hours == 0){time = MM + ":" + SS;}
	else {time = Hours + ":" + MM + ":" + SS;}

	return time;
}