 function scrollEffect() {
        window.addEventListener('scroll', function () {
            const element = document.querySelector('.home-container nav');
            const logoElements = document.querySelectorAll(".container-navbar .logo img");
            const ulElements = document.querySelectorAll(".container-navbar .nav-links a, .container-navbar .auth-links a");
            const header = document.getElementById("header");
            const triggerPosition = 30;

            element.style.transition = 'all 0.3s ease';

            if (window.scrollY > triggerPosition) {
                element.style.height = '4rem';
                header.style.visibility = 'hidden';
                logoElements.forEach(element => {
                    element.style.opacity = "0";
                    element.style.transition = "all 0.3s ease";
                });
                ulElements.forEach(element => {
                    element.style.fontSize = "1rem";
                    element.style.transition = "all 0.3s ease";
                });
            } else if(window.scrollY < triggerPosition) {
                element.style.height = '8rem';
                header.style.visibility = 'visible';
                logoElements.forEach(element => {
                    element.style.opacity = "1";
                });
                ulElements.forEach(element => {
                    element.style.fontSize = "1.1rem";
                });
            }


        });
    }
    scrollEffect();