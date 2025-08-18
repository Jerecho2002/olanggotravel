function alertFunction() {
            const showMsg = document.getElementById("showMsg");
            showMsg.innerHTML = ''; // Clear previous content
            
            const firstDiv = document.createElement('div');
            const title = document.createElement('span');
            const message = document.createElement('div');
            const exit = document.createElement('button');
            const icon = document.createElement('span');

            firstDiv.classList.add('firstDiv');
            message.classList.add('message');
            exit.classList.add('exit');
            message.innerHTML = ErrorMessage;

            // Improved animation handling
            exit.addEventListener('click', function() {
                showMsg.style.animation = "fadeOut 1s ease-out forwards";
                // Remove element after animation completes
                setTimeout(() => {
                    showMsg.style.visibility = "hidden";
                    showMsg.style.animation = "";
                }, 1000);
            });

            icon.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i>';
            exit.innerHTML = '&times;'; // Using HTML entity for better X symbol
            title.textContent = 'Error';

            showMsg.append(firstDiv);
            firstDiv.append(icon, title);
            showMsg.append(exit, message);
            
            // Trigger fade-in
            setTimeout(() => {
                showMsg.classList.add('display');
            }, 10);
        }

        // Auto-hide after 5 seconds
        function setupAutoHide() {
            const showMsg = document.getElementById("showMsg");
            setTimeout(() => {
                showMsg.style.animation = "fadeOut 0.3s ease-out forwards";
                setTimeout(() => {
                    showMsg.style.visibility = "hidden";
                    showMsg.style.animation = "";
                    showMsg.classList.remove('display');
                }, 300);
            }, 10000);
        }

        alertFunction();
        setupAutoHide();