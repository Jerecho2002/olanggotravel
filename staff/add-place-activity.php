<?php
include("../database/database.php");
$places = $data->get_places();
$activities = $data->get_activities();
$data->add_place_activity();
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

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .trend.up {
            color: var(--success-color);
        }

        .trend.down {
            color: var(--accent-color);
        }

        /* Charts Section */
        .charts-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .activity-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--light-color);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: var(--primary-color);
        }

        .activity-details h4 {
            font-size: 0.95rem;
            margin-bottom: 5px;
        }

        .activity-details p {
            font-size: 0.8rem;
            color: #7f8c8d;
        }

        /* Form Styles */
        .form-container {
            background-color: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            max-width: 600px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark-color);
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .form-group input[type="number"] {
            -moz-appearance: textfield;
        }

        .form-group input[type="number"]::-webkit-outer-spin-button,
        .form-group input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .submit-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: var(--secondary-color);
        }

        /* Responsive Adjustments */
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

        .search-container {
            margin-bottom: 20px;
        }

        .search-container input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th,
        table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: var(--light-color);
            font-weight: 500;
        }

        table tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }

        table img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }

        .no-results {
            padding: 20px;
            text-align: center;
            color: #7f8c8d;
            font-style: italic;
        }

        .pagination {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            padding: 10px 0;
        }

        .pagination button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
        }

        .pagination button:disabled {
            background-color: #bdc3c7;
            cursor: not-allowed;
        }

        .form-layout-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            align-items: start;
        }

        .left-forms {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .right-form {
            position: sticky;
            top: 20px;
        }

        /* Adjust the form container styles */
        .form-container {
            max-width: 100%;
            /* Remove the fixed max-width */
            width: 100%;
            margin: 0;
            /* Remove the auto margin */
        }

        /* Responsive adjustments */
        @media (max-width: 1200px) {
            .form-layout-container {
                grid-template-columns: 1fr;
            }

            .right-form {
                position: static;
            }
        }

        .selected-place {
            background-color: #e6f7ff !important;
            border-left: 3px solid var(--primary-color);
        }

        .selected-activity {
            background-color: #e6f7ff !important;
            border-left: 3px solid var(--primary-color);
        }

        .selected-place-display {
            padding: 12px 15px;
            border: none;
            min-height: 46px;
            margin-bottom: 20px;
        }
        
        #placesTableBody tr{
            cursor: pointer;
        }

        .selected-place-display{
            font-weight: bold;
            color: var(--primary-color);
        }

        .selected-place-display strong {
            color: var(--dark-color);
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
                <div class="nav-item">
                    <i class="fas fa-plus-circle"></i>
                    <span>Add Place</span>
                </div>
                <a href="add-place-activity.php" style="color: inherit; text-decoration: none;">
                    <div class="nav-item active">
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
                <h1>Add Place Activity</h1>
                <div class="user-info">
                    <img src="../assets/images/1_upscaled.jpg" alt="User">
                    <span><span><a href="../otherPages/logout.php"
                                style="text-decoration: none; color: black; font-weight: bold;">Logout</a></span></span>
                </div>
            </div>

            <div class="form-layout-container">
                <div class="left-forms">
                    <div class="form-container">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="form-group">
                                <label>Selected Place</label>
                                <div id="selectedPlaceDisplay" class="selected-place-display">
                                    No place selected yet
                                </div>
                                <input type="hidden" id="place_id" name="place_id">
                            </div>

                            <div class="form-group">
                                <label for="activity_id">Select Activity</label>
                                <select id="activity_id" name="activity_id" required>
                                    <option value="">-- Select an Activity --</option>
                                    <?php foreach ($activities as $activity): ?>
                                        <option value="<?php echo $activity['activity_id']; ?>">
                                            <?php echo $activity['activity_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <button type="submit" class="submit-btn" name="add_place_activity">Add Place
                                Activity</button>
                        </form>
                    </div>

                </div>

                <div class="right-form form-container">
                    <h2>Search Places</h2>
                    <div class="search-container">
                        <input type="text" id="searchInput" placeholder="Search by place name">
                    </div>
                    <table id="placesTable">
                        <thead>
                            <tr>
                                <th>Picture</th>
                                <th>Place Name</th>
                            </tr>
                        </thead>
                        <tbody id="placesTableBody">
                            <!-- Results will be loaded here -->
                        </tbody>
                    </table>
                    <div id="noResults" class="no-results" style="display: none;">No places found matching your search.
                    </div>
                    <div class="pagination">
                        <button id="prevBtn" disabled>Previous</button>
                        <span id="pageInfo">Page 1 of 1</span>
                        <button id="nextBtn" disabled>Next</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
<script>
    window.placesData = <?php echo json_encode($places); ?>;
</script>
<script src="js/place-search.js"></script>