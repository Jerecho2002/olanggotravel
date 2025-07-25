// Track if we've reached minimum display time
let minTimeElapsed = false;
let resourcesLoaded = false;

// Start minimum time counter
setTimeout(() => {
    minTimeElapsed = true;
    tryHideLoader(); // Try to hide if resources are already loaded
}, 1500); // Minimum 1.5 seconds

// Track when all resources are loaded
window.addEventListener('load', () => {
    resourcesLoaded = true;
    tryHideLoader(); // Try to hide if minimum time elapsed
});

// Fallback in case load event doesn't fire
setTimeout(() => {
    resourcesLoaded = true;
    tryHideLoader();
}, 4000); // Absolute maximum 4 seconds

function tryHideLoader() {
    // Only hide when both conditions are met
    if (minTimeElapsed && resourcesLoaded) {
        hideLoader();
    }
}

function hideLoader() {
    const loader = document.getElementById('loading-overlay');
    if (loader) {
        loader.style.opacity = '0';
        loader.addEventListener('transitionend', () => {
            loader.remove();
            
            // Optional: Show content that was hidden
            document.getElementById('content').style.display = 'block';
        });
    }
}