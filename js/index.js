// JavaScript to switch between multiple videos
document.addEventListener('DOMContentLoaded', () => {
    const homeVideo = document.getElementById('homeVideo');

    // Array of video sources
    const videoSources = [
        'videos/VideoBackground1.mp4',
        'videos/VideoBackground2.mp4',
        'videos/VideoBackground3.mp4'
    ];

    let currentVideoIndex = 0;

    // Function to switch to the next video
    function playNextVideo() {
        currentVideoIndex = (currentVideoIndex + 1) % videoSources.length;
        homeVideo.src = videoSources[currentVideoIndex];
        homeVideo.play();
    }

    // Event listener to detect when the video ends
    homeVideo.addEventListener('ended', playNextVideo);
});