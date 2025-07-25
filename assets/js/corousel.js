function corousel(){
        document.addEventListener('DOMContentLoaded', function() {
            // Carousel functionality
            const carouselInner = document.querySelector('.carousel-inner');
            const carouselItems = document.querySelectorAll('.carousel-item');
            const indicators = document.querySelectorAll('.carousel-indicator');
            const prevBtn = document.querySelector('.carousel-control.prev');
            const nextBtn = document.querySelector('.carousel-control.next');
            let currentIndex = 0;
            let intervalId;
            const transitionDuration = 800; // Should match CSS variable --carousel-transition-duration

            // Initialize carousel position
            carouselInner.style.transform = `translateX(-${currentIndex * 100}%)`;

            // Function to show slide
            function showSlide(index) {
                // Update position
                carouselInner.style.transform = `translateX(-${index * 100}%)`;
                
                // Update indicators
                indicators.forEach(indicator => indicator.classList.remove('active'));
                indicators[index].classList.add('active');
                currentIndex = index;
                
                // Reset auto-rotation timer
                resetInterval();
            }

            // Next slide function
            function nextSlide() {
                const nextIndex = (currentIndex + 1) % carouselItems.length;
                showSlide(nextIndex);
            }

            // Previous slide function
            function prevSlide() {
                const prevIndex = (currentIndex - 1 + carouselItems.length) % carouselItems.length;
                showSlide(prevIndex);
            }

            // Auto-rotation
            function startInterval() {
                intervalId = setInterval(nextSlide, 5000); // Change slide every 5 seconds
            }

            function resetInterval() {
                clearInterval(intervalId);
                startInterval();
            }

            // Event listeners
            nextBtn.addEventListener('click', nextSlide);
            prevBtn.addEventListener('click', prevSlide);

            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => showSlide(index));
            });

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowRight') {
                    nextSlide();
                } else if (e.key === 'ArrowLeft') {
                    prevSlide();
                }
            });

            // Touch events for mobile swipe
            let touchStartX = 0;
            let touchEndX = 0;

            document.querySelector('.carousel').addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            }, {passive: true});

            document.querySelector('.carousel').addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            }, {passive: true});

            function handleSwipe() {
                const threshold = 50; // Minimum swipe distance
                if (touchEndX < touchStartX - threshold) {
                    nextSlide();
                } else if (touchEndX > touchStartX + threshold) {
                    prevSlide();
                }
            }

            // Start auto-rotation
            startInterval();

            // Pause on hover
            document.querySelector('.carousel').addEventListener('mouseenter', () => {
                clearInterval(intervalId);
            });

            document.querySelector('.carousel').addEventListener('mouseleave', () => {
                startInterval();
            });

            // Dropdown functionality
            const activitiesLink = document.querySelector('.activities-link');
            const activitiesDropdown = document.querySelector('.activites-dropdown');

            activitiesLink.addEventListener('mouseenter', () => {
                activitiesLink.classList.add('hovered');
                activitiesDropdown.style.display = 'block';
            });

            activitiesLink.addEventListener('mouseleave', () => {
                activitiesLink.classList.remove('hovered');
                activitiesDropdown.style.display = 'none';
            });

            activitiesDropdown.addEventListener('mouseenter', () => {
                activitiesLink.classList.add('hovered');
                activitiesDropdown.style.display = 'block';
            });

            activitiesDropdown.addEventListener('mouseleave', () => {
                activitiesLink.classList.remove('hovered');
                activitiesDropdown.style.display = 'none';
            });
        });
    }
    corousel();