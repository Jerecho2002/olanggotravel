<?php
    include("../database/database.php");
    $data->add_place();
    $places = $data->get_places();
    $staffs = $data->get_staffs();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Travel Management Dashboard</title>
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
            font-family: 'Poppins', Tahoma, Geneva, Verdana, sans-serif;
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
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 0 auto;
        }

        .form-container h2 {
            margin-bottom: 20px;
            color: var(--dark-color);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-actions {
            margin-top: 30px;
            text-align: right;
        }

        .btn {
            padding: 12px 25px;
            border-radius: 4px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
            border: none;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-secondary {
            background-color: var(--light-color);
            color: var(--dark-color);
            margin-left: 10px;
        }
        
        /* Responsive Adjustments */
        @media (min-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
        
        @media (max-width: 1200px) {
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .charts-container {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .dashboard {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                display: none;
            }
            
            .stats-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <a href="add-place.php" style="color: inherit; text-decoration: none;">
                <div class="nav-item active">
                    <i class="fas fa-plus-circle"></i>
                    <span>Add Place</span>
                </div>
                </a>
                <a href="add-place-activity.php" style="color: inherit; text-decoration: none;">
                <div class="nav-item">
                    <i class="fas fa-plus-circle"></i>
                    <span>Add Place Activity</span>
                </div>
                </a>
                <a href="add-place-category.php" style="color: inherit; text-decoration: none;">
                <div class="nav-item">
                    <i class="fas fa-tags"></i>
                    <span>Add Place Category</span>
                </div>
                </a>
                <div class="nav-item">
                    <i class="fas fa-hiking"></i>
                    <span>Activities</span>
                </div>
                <div class="nav-item">
                    <i class="fas fa-route"></i>
                    <span>Itineraries</span>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h1>Add Place</h1>
                <div class="user-info">
                    <?php if(isset($_SESSION['staff_img'])) : ?>
                    <img src="../assets/images/<?php echo $_SESSION['staff_img']; ?>" alt="User">
                    <?php endif; ?>
                    <span><a href="logout.php" style="text-decoration: none; color: black; font-weight: bold;">Logout</a></span>
                </div>
            </div>
            
            <?php
                $nearest_index;
                foreach($places as $place){
                    if($place['staff_id'] == $_SESSION['staff_id']){
                        $nearest_index = $place['nearest_index'];
                        break;
                    }
                }
            ?>
            <?php
                $location_id;
                foreach($staffs as $staff){
                    if($staff['staff_id'] == $_SESSION['staff_id']){
                        $location_id = $staff['location_id'];
                        break;
                    }
                }
            ?>
            <!-- Add Place Form -->
            <div class="form-container">
                <h2>New Place Information</h2>
                <form action="add-place.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="nearest_index" value="<?php echo $nearest_index; ?>">
                    <input type="hidden" name="location_id" value="<?php echo $location_id; ?>">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="place_name">Place Name</label>
                            <input type="text" id="place_name" name="place_name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <input type="text" id="duration" name="duration" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="4" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="place_img">Place Image</label>
                        <input type="file" id="place_img" name="place_img" accept="image/*" required>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary" name="add-place">Add Place</button>
                        <button type="reset" class="btn btn-secondary">Clear Form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>