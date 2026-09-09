function initScrollAnimations() {
    AOS.init({
        duration: 800,           // Smooth animation duration
        easing: 'ease-out-quad',  // Pacing easing curve
        once: true,              // Animate elements only once
        offset: 30,              // Lower offset so animations trigger immediately upon viewport entry
        delay: 0,                // Reset default delays to avoid late load feelings
        disableMutationObserver: false // Listen to DOM updates (e.g. Slick Slider inits) to refresh coordinates
    });

    // Refresh layout coordinate cache when all external resources/images finish loading
    window.addEventListener('load', function() {
        setTimeout(function() {
            if (typeof AOS !== 'undefined') {
                AOS.refresh();
            }
        }, 150); // Small timeout to ensure browser layout rendering is fully settled
    });
}

// Secure early initialization
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initScrollAnimations);
} else {
    initScrollAnimations();
}
