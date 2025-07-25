 document.querySelectorAll('.auth-links a').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('auth-modal-overlay').classList.add('active');
            if (this.classList.contains('sign-up')) {
                document.getElementById('login-form').classList.remove('active');
                document.getElementById('register-form').classList.add('active');
            } else {
                document.getElementById('register-form').classList.remove('active');
                document.getElementById('login-form').classList.add('active');
            }
        });
    });

    // Close modal
    document.querySelector('.close-auth-modal').onclick = function () {
        document.getElementById('auth-modal-overlay').classList.remove('active');
    };
    document.getElementById('auth-modal-overlay').onclick = function (e) {
        if (e.target === this) this.classList.remove('active');
    };

    // Switch between login/register
    document.getElementById('show-register').onclick = function (e) {
        e.preventDefault();
        document.getElementById('login-form').classList.remove('active');
        document.getElementById('register-form').classList.add('active');
    };
    document.getElementById('show-login').onclick = function (e) {
        e.preventDefault();
        document.getElementById('register-form').classList.remove('active');
        document.getElementById('login-form').classList.add('active');
    };