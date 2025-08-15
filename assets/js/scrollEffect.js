function scrollEffect() {
    window.addEventListener('scroll', function () {
        const containerNavbar = document.getElementById("container-navbar");
        const profilePic = document.getElementById("profile-image-bg");
        const gearIcon = document.getElementById("gear-icon-front");
        const searchBar = document.getElementById("search-bar");
        const element = document.querySelector('.home-container .container-navbar nav');
        const logoElements = document.querySelector(".container-navbar .logo img");
        const ulElements = document.querySelectorAll(".container-navbar .nav-links a, .container-navbar .auth-links a");
        const header = document.getElementById("header");
        const triggerPosition = 150;

        element.style.transition = 'all 0.3s ease';
        containerNavbar.style.transition = 'all 0.5s ease';
        const scrolled = window.scrollY > triggerPosition;

        if (searchBar) searchBar.style.scale = scrolled ? "0.9" : "1";
        if (header) header.style.visibility = scrolled ? 'hidden' : 'visible';
        if (profilePic) {
            profilePic.style.height = scrolled ? '40px' : '60px';
            profilePic.style.width = scrolled ? '40px' : '60px';
        }
        if (gearIcon) gearIcon.style.scale = scrolled ? '0.7' : '1';
        if (element) element.style.height = scrolled ? '4rem' : '6rem';
        if (logoElements) logoElements.style.opacity = scrolled ? '0' : '1';

        ulElements.forEach(el => {
            el.style.fontSize = scrolled ? '1rem' : '1.1rem';
        });
    });
}
scrollEffect();
