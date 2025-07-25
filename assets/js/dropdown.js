function hoveredDropdown() {
        const navItem = document.querySelector('.activities-link');
        const dropdown = document.querySelector('.activities-dropdown');
        // Show dropdown and rotate chevron
        navItem.addEventListener('mouseenter', function () {
            dropdown.style.display = 'block';
            navItem.classList.add('hovered');
        });

        // Hide dropdown with animation and rotate chevron back
        navItem.addEventListener('mouseleave', function () {
            setTimeout(() => {
                if (!dropdown.matches(':hover')) {
                    dropdown.style.display = 'none';
                    navItem.classList.remove('hovered');
                }
            }, 200); // Adjust delay for smoother feel
        });

        dropdown.addEventListener('mouseleave', function () {
            dropdown.style.display = 'none';
            navItem.classList.remove('hovered');
        });
    }
    hoveredDropdown();