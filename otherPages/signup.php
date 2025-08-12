<?php
    include("../database/database.php");
    $data->register();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olanggo Travels - Sign Up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/loading.css">
    <link rel="stylesheet" href="../assets/css/user-sigup.css">
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
        <!-- Video Background -->
        <video autoplay muted loop class="video-background">
            <source src="../assets/videos/background-video.mp4" type="video/mp4">
        </video>
        
        <!-- Dark Overlay -->
        <div class="video-overlay"></div>
        
        <!-- Welcome Section -->
        <div class="welcome-section">
            <h1>Join Olanggo Travels</h1>
            <p>Begin your journey to extraordinary destinations. Create your account to access exclusive deals, save your favorite trips, and start planning your next adventure with us!</p>
        </div>
        
        <!-- Form Container -->
        <div class="form-container">
            <div class="form-decoration"></div>
            <form id="register-form" class="auth-form" method="POST">
                <h2>Create Account</h2>
                
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="registerName" placeholder="Username" required>
                </div>
                
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="registerEmail" placeholder="Email" required>
                </div>
                
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="registerPass" placeholder="Password" required>
                </div>
                
                <input type="hidden" name="roles" value="user">
                
                <button type="submit" name="register" id="register-btn">
                    <span id="register-btn-text">Sign Up</span>
                    <div class="loader" id="register-loader"></div>
                </button>
                
                <div class="travel-icons">
                    <i class="fas fa-plane"></i>
                    <i class="fas fa-map-marked-alt"></i>
                    <i class="fas fa-suitcase"></i>
                    <i class="fas fa-passport"></i>
                </div>
                
                <p class="switch-auth">Already have an account? <a href="login.php" id="show-login">Log in</a></p>
            </form>
        </div>
    </div>
</body>
</html>
<script src="../assets/js/loading.js"></script>