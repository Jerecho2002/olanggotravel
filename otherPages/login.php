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
    <style>
        :root {
            --color-main: #FFFFFF;
            --color-teal: #00A896;
            --color-header: #0077B6;
            --color-dark: #333333;
            --color-light-gray: #f5f5f5;
            --color-shadow: rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2;
        }

        .video-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }


        .container {
            display: flex;
            width: 900px;
            max-width: 90%;
            background-color: var(--color-main);
            border-radius: 16px;
            box-shadow: 0 10px 30px var(--color-shadow);
            overflow: hidden;
        }

        .welcome-section {
            flex: 1;
            padding: 60px 40px;
            background: linear-gradient(135deg, rgba(0, 168, 150, 0.9), rgba(0, 119, 182, 0.9));
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .welcome-section h1 {
            font-size: 32px;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .welcome-section p {
            font-size: 16px;
            line-height: 1.6;
            opacity: 0.9;
        }

        .form-container {
            background-color: white;
            flex: 1;
            position: relative;
        }

        .form-decoration {
            height: 8px;
            background: linear-gradient(90deg, var(--color-teal), var(--color-header));
        }

        #login-form {
            padding: 40px;
            display: flex;
            flex-direction: column;
        }

        #login-form h2 {
            color: var(--color-header);
            margin-bottom: 30px;
            text-align: center;
            font-size: 28px;
            font-weight: 600;
            position: relative;
        }

        #login-form h2::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: var(--color-teal);
            margin: 10px auto;
            border-radius: 2px;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--color-teal);
        }

        #login-form input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: var(--color-light-gray);
        }

        #login-form input:focus {
            border-color: var(--color-teal);
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 168, 150, 0.2);
        }

        #login-form button {
            background: linear-gradient(to right, var(--color-teal), var(--color-header));
            color: white;
            border: none;
            padding: 15px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        #login-form button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 168, 150, 0.4);
        }

        .switch-auth {
            text-align: center;
            margin-top: 20px;
            color: var(--color-dark);
        }

        .switch-auth a {
            color: var(--color-header);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .switch-auth a:hover {
            color: var(--color-teal);
            text-decoration: underline;
        }

        .travel-icons {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
        }

        .travel-icons i {
            color: var(--color-teal);
            font-size: 20px;
            opacity: 0.7;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .welcome-section {
                padding: 30px 20px;
                text-align: center;
            }
        }

        .loader {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin: 0 auto;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
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