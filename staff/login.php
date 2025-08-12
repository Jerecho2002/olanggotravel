<?php
    include("../database/database.php");
    $data->loginStaff();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olanggo Travels | Staff Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/loading.css">
    <style>
        :root {
            --color-main: #FFFFFF;
            --color-primary: #2C3E50;
            --color-secondary: #34495E;
            --color-accent: #3498DB;
            --color-dark: #2C3E50;
            --color-light-gray: #ECF0F1;
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
            background-color: #f8f9fa;
        }

        .container {
            display: flex;
            width: 900px;
            max-width: 90%;
            background-color: var(--color-main);
            border-radius: 8px;
            box-shadow: 0 5px 20px var(--color-shadow);
            overflow: hidden;
        }

        .welcome-section {
            flex: 1;
            padding: 60px 40px;
            background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }

        .welcome-section img {
            width: 120px;
            margin: 0 auto 20px;
        }

        .welcome-section h1 {
            font-size: 28px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .welcome-section p {
            font-size: 15px;
            line-height: 1.6;
            opacity: 0.9;
        }

        .form-container {
            background-color: white;
            flex: 1;
            position: relative;
        }

        .form-decoration {
            height: 6px;
            background: linear-gradient(90deg, var(--color-primary), var(--color-accent));
        }

        #login-form {
            padding: 40px;
            display: flex;
            flex-direction: column;
        }

        #login-form h2 {
            color: var(--color-primary);
            margin-bottom: 30px;
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            position: relative;
        }

        #login-form h2::after {
            content: '';
            display: block;
            width: 50px;
            height: 3px;
            background: var(--color-accent);
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
            color: var(--color-accent);
        }

        #login-form input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 15px;
            transition: all 0.3s ease;
            background-color: var(--color-light-gray);
        }

        #login-form input:focus {
            border-color: var(--color-accent);
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        #login-form button {
            background: linear-gradient(to right, var(--color-primary), var(--color-accent));
            color: white;
            border: none;
            padding: 13px;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            letter-spacing: 0.5px;
        }

        #login-form button:hover {
            background: linear-gradient(to right, var(--color-secondary), var(--color-accent));
            box-shadow: 0 3px 10px rgba(52, 152, 219, 0.3);
        }

        .switch-auth {
            text-align: center;
            margin-top: 20px;
            color: var(--color-dark);
            font-size: 14px;
        }

        .switch-auth a {
            color: var(--color-accent);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .switch-auth a:hover {
            color: var(--color-primary);
            text-decoration: underline;
        }

        .security-info {
            font-size: 12px;
            color: #7F8C8D;
            text-align: center;
            margin-top: 20px;
            line-height: 1.5;
        }

        .security-info i {
            color: var(--color-accent);
            margin-right: 5px;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .welcome-section {
                padding: 30px 20px;
            }
        }

        .loader {
            display: none;
            width: 18px;
            height: 18px;
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
        <div class="welcome-section">
            <img src="../assets/images/logo2-removebg-preview.png" alt="Company Logo">
            <h1>Staff Portal</h1>
            <p>Access your staff dashboard to manage bookings, customers, and travel packages. Please enter your credentials to continue.</p>
            <div style="margin-top: 30px;">
                <i class="fas fa-shield-alt" style="font-size: 40px; opacity: 0.8;"></i>
            </div>
        </div>

        <div class="form-container">
            <div class="form-decoration"></div>
            <form id="login-form" class="auth-form active" method="POST">
                <h2>Staff Login</h2>

                <div class="input-group">
                    <i class="fas fa-user-tie"></i>
                    <input type="text" name="email" placeholder="Email" required>
                </div>

                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit" name="staffLogin">
                    <i class="fas fa-sign-in-alt"></i> Login to Dashboard
                </button>

                <p class="security-info">
                    <i class="fas fa-info-circle"></i> For security reasons, please keep your login credentials confidential and log out when you're done.
                </p>

                <p class="switch-auth">Forgot Password? <a href="#">Reset Password</a></p>
            </form>
        </div>
    </div>
</body>

</html>
<script src="../assets/js/loading.js"></script>