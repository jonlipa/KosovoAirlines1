// Function to share on Facebook
function shareOnFacebook(url) {
    const facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
    window.open(facebookUrl, '_blank', 'width=600,height=400');
}

// Function to share on Twitter
function shareOnTwitter(url, text = '') {
    const twitterUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(text)}`;
    window.open(twitterUrl, '_blank', 'width=600,height=400');
}

// Function to share on Instagram
function shareOnInstagram(imageUrl, caption = '') {
    const instagramUrl = `https://www.instagram.com/?url=${encodeURIComponent(imageUrl)}&caption=${encodeURIComponent(caption)}`;
    window.open(instagramUrl, '_blank', 'width=600,height=400');
}

// Event listeners for social media share buttons
document.querySelector('#facebook-share')?.addEventListener('click', function() {
    shareOnFacebook(window.location.href);
});

document.querySelector('#twitter-share')?.addEventListener('click', function() {
    shareOnTwitter(window.location.href, 'Check out this amazing website!');
});

document.querySelector('#instagram-share')?.addEventListener('click', function() {
    shareOnInstagram('path-to-image.jpg', 'This is a great website!');
});
