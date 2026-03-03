// Lightbox Gallery Functionality
let currentImages = [];
let currentIndex = 0;

function openLightbox(images, index) {
    currentImages = images;
    currentIndex = index;
    const lightbox = document.getElementById('lightbox');
    const img = document.getElementById('lightbox-img');
    img.src = images[currentIndex];
    lightbox.classList.remove('hidden');
    lightbox.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeLightbox(event) {
    if (event.target.id === 'lightbox' || event.target.tagName === 'BUTTON') {
        const lightbox = document.getElementById('lightbox');
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
        document.body.style.overflow = '';
    }
}

function nextImage() {
    currentIndex = (currentIndex + 1) % currentImages.length;
    document.getElementById('lightbox-img').src = currentImages[currentIndex];
}

function prevImage() {
    currentIndex = (currentIndex - 1 + currentImages.length) % currentImages.length;
    document.getElementById('lightbox-img').src = currentImages[currentIndex];
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const lightbox = document.getElementById('lightbox');
    if (!lightbox.classList.contains('hidden')) {
        if (e.key === 'Escape') closeLightbox({target: lightbox});
        if (e.key === 'ArrowRight') nextImage();
        if (e.key === 'ArrowLeft') prevImage();
    }
});

// Auto-initialize gallery images on page load
document.addEventListener('DOMContentLoaded', function() {
    // Add click handlers to all gallery images
    const galleryItems = document.querySelectorAll('.gallery-item');
    galleryItems.forEach((item, index) => {
        item.addEventListener('click', function() {
            const images = JSON.parse(this.dataset.images || '[]');
            if (images.length > 0) {
                openLightbox(images, 0);
            }
        });
    });
});
