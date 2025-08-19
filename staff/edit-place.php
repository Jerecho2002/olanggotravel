<?php
include("../database/database.php");
$data->session_staff("login.php");
$places = $data->get_places();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }

        .form-container h2 {
            margin-bottom: 20px;
            color: var(--dark-color);
        }

        /* Search Styles */
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

        .selected-place {
            background-color: #e6f7ff !important;
            border-left: 3px solid var(--primary-color);
        }

        #placesTableBody tr {
            cursor: pointer;
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
                    <div class="nav-item">
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
                <a href="edit-place.php" style="color: inherit; text-decoration: none;">
                    <div class="nav-item active">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span>Edit Place</span>
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
                <h1>Edit Place</h1>
                <div class="user-info">
                    <?php if (isset($_SESSION['staff_img'])): ?>
                        <img src="../assets/images/<?php echo $_SESSION['staff_img']; ?>" alt="User">
                    <?php endif; ?>
                    <span><a href="logout.php"
                            style="text-decoration: none; color: black; font-weight: bold;">Logout</a></span>
                </div>
            </div>

            <div class="form-container">
                <h2>Search places</h2>
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
                    <tbody id="placesTableBody"></tbody>
                    <script>
                        // Pass PHP data to JavaScript
                        window.placesData = <?php echo json_encode($places); ?>;
                        window.currentLocationId = <?php echo isset($_SESSION['location_id']) ? $_SESSION['location_id'] : 'null'; ?>;
                    </script>
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

    <script src="js/edit-place-search.js"></script>
</body>

</html>