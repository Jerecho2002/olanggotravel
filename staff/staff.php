<?php
    include("../database/database.php");
    $places = $data->get_places();
    $activities = $data->get_activities();
    $monthlyUsers = $data->get_monthly_users();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Lato&display=swap" rel="stylesheet">
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
        
        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-card h3 {
            font-size: 0.9rem;
            color: #7f8c8d;
            margin-bottom: 10px;
        }
        
        .stat-card .value {
            font-size: 2rem;
            font-weight: bold;
            color: var(--dark-color);
        }
        
        .stat-card .trend {
            display: flex;
            align-items: center;
            margin-top: 10px;
            font-size: 0.9rem;
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
        
        .chart-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .chart-card h2 {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: var(--dark-color);
        }
        
        /* Recent Activities */
        .recent-activities {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .recent-activities h2 {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: var(--dark-color);
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
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <h2>TravelEase</h2>
                <p>Staff Dashboard</p>
            </div>
            <div class="nav-menu">
                <div class="nav-item active">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </div>
                <div class="nav-item">
                    <i class="fas fa-plus-circle"></i>
                    <span>Add Place</span>
                </div>
                <div class="nav-item">
                    <i class="fas fa-plus-circle"></i>
                    <span>Add Activity</span>
                </div>
                <div class="nav-item">
                    <i class="fas fa-plus-circle"></i>
                    <span>Add Category</span>
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
                <div class="nav-item">
                    <i class="fas fa-tags"></i>
                    <span>Categories</span>
                </div>
                <div class="nav-item">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h1>Dashboard Overview</h1>
                <div class="user-info">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User">
                    <span>Sarah Johnson</span>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="stats-container">
                <div class="stat-card">
                    <h3>Total Places</h3>
                    <div class="value" id="total-locations"><?php echo count($places); ?></div>
                    <div class="trend up">
                        <i class="fas fa-arrow-up"></i>
                        <span>12% from last month</span>
                    </div>
                </div>
                <div class="stat-card">
                    <h3>Total Activities</h3>
                    <div class="value" id="total-activities"><?php echo count($activities); ?></div>
                    <div class="trend up">
                        <i class="fas fa-arrow-up"></i>
                        <span>8% from last month</span>
                    </div>
                </div>
                <div class="stat-card">
                    <h3>Itineraries Created</h3>
                    <div class="value" id="total-itineraries">89</div>
                    <div class="trend down">
                        <i class="fas fa-arrow-down"></i>
                        <span>3% from last month</span>
                    </div>
                </div>
            </div>
            
            <?php
            $userData = array_fill(0, 12, 0); // Initialize array with 12 months
            foreach ($monthlyUsers as $dataPoint) {
                $monthIndex = $dataPoint['month'] - 1; // Convert to 0-based index
                $userData[$monthIndex] = $dataPoint['user_count'];
            }
            ?>
            <!-- Charts Section -->
            <div class="charts-container">
                <div class="chart-card">
                    <h2>Monthly Users</h2>
                    <canvas id="users-chart"></canvas>
                </div>
                <div class="chart-card">
                    <h2>Locations by Category</h2>
                    <canvas id="categories-chart"></canvas>
                </div>
            </div>
            
            <!-- Recent Activities -->
            <div class="recent-activities">
                <h2>Recent Activities</h2>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="activity-details">
                        <h4>New location added</h4>
                        <p>Bali, Indonesia added by Sarah Johnson - 2 hours ago</p>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-hiking"></i>
                    </div>
                    <div class="activity-details">
                        <h4>Activity updated</h4>
                        <p>Scuba Diving in Great Barrier Reef updated - 5 hours ago</p>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-route"></i>
                    </div>
                    <div class="activity-details">
                        <h4>New itinerary created</h4>
                        <p>"European Adventure" created by Michael Brown - 1 day ago</p>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="activity-details">
                        <h4>Users milestone</h4>
                        <p>Reached 10,000 total users this month - 2 days ago</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Charts
        document.addEventListener('DOMContentLoaded', () => {
            // Users Chart
            const usersCtx = document.getElementById('users-chart').getContext('2d');
            const usersChart = new Chart(usersCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Monthly Users',
                        data: <?php echo json_encode($userData); ?>,
                        backgroundColor: 'rgba(52, 152, 219, 0.2)',
                        borderColor: 'rgba(52, 152, 219, 1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y.toFixed(0);
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Users'
                            },
                            ticks: {
                                precision: 0,
                                callback: function(value) {
                                    if (value % 1 === 0) {
                                        return value;
                                    }
                                }
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        }
                    }
                }
            });
            
            // Categories Chart
            const categoriesCtx = document.getElementById('categories-chart').getContext('2d');
            const categoriesChart = new Chart(categoriesCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Beach', 'Mountain', 'City', 'Historical', 'Adventure', 'Nature'],
                    datasets: [{
                        data: [35, 25, 20, 15, 20, 30],
                        backgroundColor: [
                            'rgba(52, 152, 219, 0.7)',
                            'rgba(46, 204, 113, 0.7)',
                            'rgba(155, 89, 182, 0.7)',
                            'rgba(241, 196, 15, 0.7)',
                            'rgba(231, 76, 60, 0.7)',
                            'rgba(26, 188, 156, 0.7)'
                        ],
                        borderColor: [
                            'rgba(52, 152, 219, 1)',
                            'rgba(46, 204, 113, 1)',
                            'rgba(155, 89, 182, 1)',
                            'rgba(241, 196, 15, 1)',
                            'rgba(231, 76, 60, 1)',
                            'rgba(26, 188, 156, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>