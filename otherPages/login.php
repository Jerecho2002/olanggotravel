<?php
    include("../database/database.php");
    $data->login();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Explorer | Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/loading.css">
    <link rel="stylesheet" href="../assets/css/user-login.css">
</head>

<body>
    <div id="loading-overlay">
        <div class="loader-content">
            <img src="../assets/images/logo2-removebg-preview.png" alt="Logo" class="loading-logo">
            <div class="dot-loader">
                <span></span><span></span><span></span><span></span>
            </div>
        </div>
    </div>

    <div class="container">

        <video autoplay muted loop class="video-background">
            <source src="../assets/videos/background-video.mp4" type="video/mp4">
        </video>

        <div class="video-overlay"></div>

        <div class="welcome-section">
            <h1>Welcome to Olanggo Travels</h1>
            <p>your gateway to unforgettable adventures. Explore breathtaking destinations with expert guides and
                seamless travel experiences. Discover the world with us!</p>
        </div>

        <div class="form-container">
            <div class="form-decoration"></div>
            <form id="login-form" class="auth-form active" method="POST">
                <h2>Welcome Back</h2>

                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="loginEmail" placeholder="Email" required>
                </div>

                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="loginPass" placeholder="Password" required>
                </div>

                <button type="submit" name="login">
                    <i class="fas fa-sign-in-alt"></i> Continue Your Journey
                </button>

                <div class="travel-icons">
                    <i class="fas fa-plane"></i>
                    <i class="fas fa-map-marked-alt"></i>
                    <i class="fas fa-suitcase"></i>
                    <i class="fas fa-passport"></i>
                </div>

                <p class="switch-auth">Don't have an account? <a href="signup.php" id="show-register">Explore with us</a></p>
            </form>
        </div>
    </div>
</body>

</html>
<script src="../assets/js/loading.js"></script>