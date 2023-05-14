var currentIndex = 0;
var images = document.querySelectorAll('.slideshow img');

function changeImage() {
    images[currentIndex].classList.remove('active');
    currentIndex = (currentIndex + 1) % images.length;
    images[currentIndex].classList.add('active');
}

setInterval(changeImage, 5000);
