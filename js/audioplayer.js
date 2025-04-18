document.addEventListener('DOMContentLoaded', function () {
    const audio = document.querySelector('audio');
    const playButton = document.querySelector('.play-btn');
    const pauseButton = document.querySelector('.pause-btn');
    const seekSlider = document.querySelector('.seek-slider');
    const currentTimeElem = document.querySelector('.current-time');
    const durationElem = document.querySelector('.duration');
    const muteButton = document.querySelector('.mute-btn');
    const volumeSlider = document.querySelector('.volume-slider');
    const muteBtnImg = document.getElementById("mute-btn-img");

    // Initially, show only the play button
    pauseButton.style.display = 'none';

    // Toggle play/pause visibility
    const togglePlayPauseButtons = () => {
        if (audio.paused) {
            playButton.style.display = 'block';
            pauseButton.style.display = 'none';
        } else {
            playButton.style.display = 'none';
            pauseButton.style.display = 'block';
        }
    };

    // Update the time display
    const formatTime = (time) => {
        const minutes = Math.floor(time / 60);
        const seconds = Math.floor(time % 60);
        return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
    };

    // Play button event
    playButton.addEventListener('click', () => {
        audio.play();
        togglePlayPauseButtons();
    });

    // Pause button event
    pauseButton.addEventListener('click', () => {
        audio.pause();
        togglePlayPauseButtons();
    });

    // Update seek slider and time display while audio is playing
    audio.addEventListener('timeupdate', () => {
        const currentTime = audio.currentTime;
        const duration = audio.duration;
        seekSlider.value = (currentTime / duration) * 100;
        currentTimeElem.textContent = formatTime(currentTime);
        if (!isNaN(duration)) {
            durationElem.textContent = formatTime(duration);
        }
    });

    // Seek slider event
    seekSlider.addEventListener('input', () => {
        const seekTo = (seekSlider.value / 100) * audio.duration;
        audio.currentTime = seekTo;
    });

    muteButton.addEventListener('click', () => {
        const isMuted = audio.muted;
        audio.muted = !isMuted;

        // Toggle image source based on mute state
        muteBtnImg.src = isMuted
            ? '/img/nav/mute.svg'
            : '/img/nav/unmute.svg';
    });


    // Volume slider event
    volumeSlider.addEventListener('input', () => {
        audio.volume = volumeSlider.value;
    });

    // Update duration when the metadata is loaded
    audio.addEventListener('loadedmetadata', () => {
        durationElem.textContent = formatTime(audio.duration);
    });

    // Toggle buttons on audio play/pause event
    audio.addEventListener('play', togglePlayPauseButtons);
    audio.addEventListener('pause', togglePlayPauseButtons);
});
