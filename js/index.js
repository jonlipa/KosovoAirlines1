class VideoSwitcher {
    constructor(videoElementId, videoSources) {
        this.videoElement = document.getElementById(videoElementId);
        this.videoSources = videoSources;
        this.currentVideoIndex = 0;

        if (this.videoElement) {
            this.videoElement.addEventListener('ended', () => this.playNextVideo());
            this.videoElement.src = this.videoSources[this.currentVideoIndex];
            this.videoElement.play();
        }
    }

    playNextVideo() {
        this.currentVideoIndex = (this.currentVideoIndex + 1) % this.videoSources.length;
        this.videoElement.src = this.videoSources[this.currentVideoIndex];
        this.videoElement.play();
    }
}

// Inicializimi i klasës për videon e faqes kryesore
new VideoSwitcher('homeVideo', [
    'videos/VideoBackground1.mp4',
    'videos/VideoBackground2.mp4',
    'videos/VideoBackground3.mp4'
]);
