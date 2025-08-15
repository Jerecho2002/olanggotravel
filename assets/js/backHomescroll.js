//back home
        function scroll() {
            const backHome = document.querySelector(".back-home i");
            const triggerPosition = 150;

            if (backHome) {
                backHome.style.visibility = window.scrollY > triggerPosition ? 'visible' : 'hidden';
            }
        }

        // Run when page loads
        scroll();

        // Run when scrolling
        window.addEventListener("scroll", scroll);

        document.querySelector(".back-home i").addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });