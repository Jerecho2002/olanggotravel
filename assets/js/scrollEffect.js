function scrollEffect() {
        window.addEventListener('scroll', function () {
            const containerNavbar = document.getElementById("container-navbar");
            const profilePic = document.getElementById("profile-image-bg");
            const gearIcon = document.getElementById("gear-icon-front");
            const searchBar = document.getElementById("search-bar");
            const element = document.querySelector('.home-container nav');
            const logoElements = document.querySelectorAll(".container-navbar .logo img");
            const ulElements = document.querySelectorAll(".container-navbar .nav-links a, .container-navbar .auth-links a");
            const header = document.getElementById("header");
            const triggerPosition = 30;

            element.style.transition = 'all 0.3s ease';
            containerNavbar.style.transition = 'all 0.5s ease';
            const scrolled = window.scrollY > triggerPosition;

            containerNavbar.style.height = scrolled ? '80px' : '';
            searchBar.style.scale = scrolled ? "0.8" : "1";
            header.style.visibility = scrolled ? 'hidden' : 'visible';
            profilePic.style.height = scrolled ? '40px' : '60px';
            profilePic.style.width = scrolled ? '40px' : '60px';
            gearIcon.style.scale = scrolled ? '0.7' : '1';
            element.style.height = scrolled ? '4rem' : '8rem';

            logoElements.forEach(element => {
                    element.style.opacity = scrolled ? '0' : '1';
                });
            ulElements.forEach(element => {
                    element.style.fontSize = scrolled ? '1rem' : '1.1rem';
                });
        });
    }
    scrollEffect();