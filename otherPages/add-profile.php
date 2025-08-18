<?php 
    include("../database/database.php");
    $data->session_user("login.php");
    $data->insert_img_user();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Profile Picture</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/loading.css">
    <link rel="stylesheet" href="../assets/css/alert.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        
        body {
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .profile-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            padding: 30px;
            text-align: center;
        }
        
        h1 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #050505;
        }
        
        p.subtitle {
            color: #65676b;
            margin-bottom: 25px;
            font-size: 15px;
        }
        
        .upload-area {
            border: 2px dashed #ccd0d5;
            border-radius: 8px;
            padding: 40px 20px;
            margin-bottom: 20px;
            cursor: pointer;
        }
        
        .upload-icon {
            font-size: 50px;
            color: #1877f2;
            margin-bottom: 15px;
        }
        
        .upload-text {
            font-size: 17px;
            color: #050505;
            margin-bottom: 5px;
        }
        
        .upload-subtext {
            font-size: 14px;
            color: #65676b;
        }
        
        #file-input {
            display: none;
        }
        
        .preview-container {
            margin: 20px 0;
        }
        
        .preview-image {
            max-width: 200px;
            max-height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #e4e6eb;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            border: none;
        }
        
        .btn-primary {
            background-color: #1877f2;
            color: white;
            margin-right: 10px;
        }
        
        .btn-secondary {
            background-color: #e4e6eb;
            color: #4b4f56;
        }
    </style>
</head>
<body>
    <?php if(isset($_SESSION['register-success'])) : ?>
    <div id="showMsg"> <?php echo "<script>const SuccessMessage = '" . $_SESSION['register-success'] . "';</script>"; ?></div>
    <script src="../assets/js/successAlert.js"></script>
    <?php unset($_SESSION['register-success']); ?>
    <?php endif; ?>

    <div id="loading-overlay">
        <div class="loader-content">
            <img src="../assets/images/logo2-removebg-preview.png" alt="Logo" class="loading-logo">
            <div class="dot-loader">
                <span></span><span></span><span></span><span></span>
            </div>
        </div>
    </div>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="profile-card">
            <h1>Add Profile Picture</h1>
            <p class="subtitle">Upload a photo so your friends can recognize you</p>
            
            <!-- Upload Area -->
            <div class="upload-area" onclick="document.getElementById('file-input').click()">
                <div class="upload-icon">
                    <i class="fas fa-camera"></i>
                </div>
                <div class="upload-text">Click to upload photo</div>
                <div class="upload-subtext">JPG, PNG (Max 2MB)</div>
                <input type="file" id="file-input" name="user_img" accept="image/*" onchange="previewImage(this)">
            </div>
            
            <!-- Preview Container -->
            <div class="preview-container">
                <img id="preview" class="preview-image" src="#" alt="Preview" style="display:none;">
            </div>
            
            <!-- Buttons -->
            <div>
                <button type="submit" class="btn btn-primary" name="upload_img">Upload</button>
                <a href="../index.php" class="btn btn-secondary">Skip for Now</a>
            </div>
        </div>
    </form>
    <script src="../assets/js/loading.js"></script>
    <script>
        // Simple image preview function
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const file = input.files[0];
            
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>