<?php
include("../database/database.php");
$data->addStaff();
$locations = $data->get_locations();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Lato&display=swap" rel="stylesheet">
    <title>Add Staff | Travel Management Dashboard</title>
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2980b9;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --success-color: #2ecc71;
            --warning-color: #f39c12;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: #333;
        }

        .dashboard {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            background-color: var(--dark-color);
            color: white;
            padding: 20px 0;
        }

        .logo {
            text-align: center;
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo h2 {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .logo p {
            font-size: 0.8rem;
            opacity: 0.7;
        }

        .nav-menu {
            margin-top: 30px;
        }

        .nav-item {
            padding: 12px 20px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }

        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-item.active {
            background-color: var(--primary-color);
        }

        .nav-item i {
            margin-right: 10px;
            font-size: 1.1rem;
        }

        /* Main Content Styles */
        .main-content {
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 1.8rem;
            color: var(--dark-color);
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        /* Form Styles */
        .form-container {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark-color);
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: var(--secondary-color);
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-weight: 600;
        }

        /* Image Upload Styles */
        .image-upload {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .image-upload-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #f5f5f5;
            margin-right: 20px;
            overflow: hidden;
            border: 2px solid #ddd;
            position: relative;
        }

        .image-upload-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }

        .image-upload-preview .placeholder {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #999;
            text-align: center;
            font-size: 0.8rem;
        }

        .image-upload label {
            background-color: var(--light-color);
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .image-upload label:hover {
            background-color: #e0e0e0;
        }

        .image-upload input[type="file"] {
            display: none;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .dashboard {
                grid-template-columns: 1fr;
            }

            .sidebar {
                display: none;
            }

            .image-upload {
                flex-direction: column;
                align-items: flex-start;
            }

            .image-upload-preview {
                margin-right: 0;
                margin-bottom: 15px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <h2>OlanggoTravels</h2>
                <p>Staff Dashboard</p>
            </div>
            <div class="nav-menu">
                <a href="dashboard.php" style="color: inherit; text-decoration: none;">
                    <div class="nav-item">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </div>
                </a>
                <div class="nav-item active">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>Create Staff</span>
                </div>
                <div class="nav-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Locations</span>
                </div>
                <div class="nav-item">
                    <i class="fas fa-hiking"></i>
                    <span>Activities</span>
                </div>
                <div class="nav-item">
                    <i class="fas fa-route"></i>
                    <span>Itineraries</span>
                </div>
                <div class="nav-item">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h1>Create New Staff</h1>
                <div class="user-info">
                    <img src="../assets/images/1_upscaled.jpg" alt="User">
                    <span><a href="../otherPages/logout.php"
                            style="text-decoration: none; color: black; font-weight: bold;">Logout</a></span>
                </div>
            </div>

            <!-- Form Container -->
            <div class="form-container">
                <form action="add-staff.php" method="POST" enctype="multipart/form-data">
                    <!-- Profile Picture Upload -->
                    <div class="image-upload">
                        <div class="image-upload-preview">
                            <img id="profile-preview" src="#" alt="Profile Preview">
                            <div class="placeholder">
                                <i class="fas fa-user" style="font-size: 2rem; margin-bottom: 5px; display: block;"></i>
                                Profile Picture
                            </div>
                        </div>
                        <div>
                            <label for="profile_picture">Choose Image</label>
                            <input type="file" id="profile_picture" name="staff_img" accept="image/*">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div class="form-group">
                        <label for="location">Location</label>
                        <select id="location" name="location_id" required>
                            <option value="">Select Location</option>
                            <?php
                            foreach ($locations as $location) {
                                echo "<option value='{$location['location_id']}'>{$location['location_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" class="btn" name="registerStaff">Create Staff</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Image preview functionality
        document.getElementById('profile_picture').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const preview = document.getElementById('profile-preview');
            const placeholder = document.querySelector('.image-upload-preview .placeholder');

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    placeholder.style.display = 'none';
                }

                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
                placeholder.style.display = 'block';
            }
        });
    </script>
</body>

</html>