<?php
include("../database/database.php");
$data->add_itinerary();
$data->remove_itinerary();
$places = $data->get_places();

$place_categories = $data->get_place_categories();
$itineraries = $data->get_itineraries();
// Get current place details
$current_place = null;
foreach ($places as $place) {
    if ($place['place_id'] == $_GET['place_id']) {
        $current_place = $place;
        break;
    }
}


// Get related places (excluding current one)
$related_places = array_filter($places, function ($p) use ($current_place) {
    return $p['place_id'] != $current_place['place_id'] && $p['location'] == $current_place['location'];
});

// Limit related places to 3
$related_places = array_slice($related_places, 0, 3);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($current_place['place_name']); ?> | Travel Guide</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/loading.css">
    <style>
        /* Reset and base styling */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f7f9fb;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            margin-bottom: 30px;
            border-bottom: 1px solid #e1e5eb;
        }

        .logo {
            font-size: 1.8em;
            font-weight: bold;
            color: #2c3e50;
            text-decoration: none;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            color: #3498db;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .back-link i {
            margin-right: 5px;
        }

        /* Place Details */
        .place-hero {
            position: relative;
            margin-bottom: 30px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .place-hero img {
            width: 100%;
            height: 70vh;
            object-fit: cover;
        }

        .place-title {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
            color: white;
            padding: 30px;
        }

        .place-title h1 {
            font-size: 2.5em;
            margin-bottom: 5px;
        }

        .place-meta {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-top: 10px;
        }

        .place-meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.9em;
        }

        .place-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 50px;
        }

        .place-description {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .place-description h2 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 1.5em;
        }

        .place-description p {
            margin-bottom: 15px;
        }

        .place-details {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .detail-item {
            margin-bottom: 20px;
        }

        .detail-item h3 {
            color: #2c3e50;
            margin-bottom: 8px;
            font-size: 1.1em;
        }

        .tag-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }

        .tag {
            background: #E3F2FD;  /* Very light blue */
            color: #1976D2;       /* Medium blue */
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8em;
            font-weight: 500;
            border: 1px solid #BBDEFB; /* Light blue border */
        }

        .tag1 {
            background: #E8F5E9;  /* Very light green */
            color: #388E3C;      /* Medium green */
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8em;
            font-weight: 500;
            border: 1px solid #C8E6C9; /* Light green border */
        }

        /* Gallery */
        .gallery-section {
            margin-bottom: 50px;
        }

        .gallery-section h2 {
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
        }

        .gallery-item {
            height: 200px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        /* Related Places */
        .related-section {
            margin-bottom: 50px;
        }

        .related-section h2 {
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .related-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .related-card:hover {
            transform: translateY(-5px);
        }

        .related-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .related-card-content {
            padding: 20px;
        }

        .related-card h3 {
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .related-card p {
            font-size: 0.9em;
            color: #666;
            margin-bottom: 15px;
        }

        .related-link {
            display: inline-block;
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
        }

        /* Footer */
        .footer {
            background: #2c3e50;
            color: white;
            padding: 30px 0;
            text-align: center;
            margin-top: 50px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .place-content {
                grid-template-columns: 1fr;
            }

            .place-hero img {
                height: 50vh;
            }

            .place-title h1 {
                font-size: 2em;
            }

            .related-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .place-hero img {
                height: 40vh;
            }

            .place-title h1 {
                font-size: 1.5em;
            }

            .place-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
        }

        .itinerary-btn button{
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            background-color: rgba(250, 183, 0, 1);
            border-radius: 10px;
            padding: 0.7rem 1.5rem;
            border: none;
            cursor: pointer;
            transition: 0.5s ease;
        }
        .itinerary-btn button:hover{
            background-color: rgba(255, 194, 25, 1);
            color: rgba(49, 49, 49, 1);
        }
        .itinerary-btn button i{
            transition: transform 0.5s ease;
        }
        .itinerary-btn button:hover i{
            transform: rotate(360deg);
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
        <header class="header">
            <a href="../index.php" class="logo">TravelGuide</a>
            <nav>
                <!-- Navigation items would go here -->
            </nav>
        </header>

        <a href="../index.php#activities" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to all places
        </a>

        <?php if ($current_place): ?>
            <div class="place-hero">
                <img src="../assets/images/<?php echo htmlspecialchars($current_place['place_img']); ?>"
                    alt="<?php echo htmlspecialchars($current_place['place_name']); ?>">
                <div class="place-title">
                    <h1><?php echo htmlspecialchars($current_place['place_name']); ?></h1>
                    <div class="place-meta">
                        <span class="place-meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <?php echo htmlspecialchars($current_place['location']); ?>
                        </span>
                        <span class="place-meta-item">
                            <i class="fas fa-star"></i>
                            <?php echo htmlspecialchars($current_place['rating'] ?? '4.5'); ?>/5
                        </span>
                        <span class="place-meta-item">
                            <i class="fas fa-clock"></i>
                            <?php echo htmlspecialchars($current_place['best_time_to_visit'] ?? 'Year-round'); ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="place-content">
                <div class="place-description">
                    <h2>About <?php echo htmlspecialchars($current_place['place_name']); ?></h2>
                    <p><?php echo nl2br(htmlspecialchars($current_place['description'])); ?></p>

                    <h2>Highlights</h2>
                    <ul>
                        <li>Stunning natural beauty with panoramic views</li>
                        <li>Rich cultural heritage and history</li>
                        <li>Excellent hiking trails for all skill levels</li>
                        <li>Local cuisine and dining experiences</li>
                    </ul>
                    <?php $activities = $data->activity_names($_GET['place_id']); ?>
                    <h2 style="margin-top: 1rem;">Activities</h2>
                    <div class="tag-list">
                            <?php foreach($activities as $activity) : ?>
                            <span class="tag"><?php echo $activity['activity_name']; ?></span>
                            <?php endforeach; ?>
                    </div>
                    <?php $activities = $data->category_names($_GET['place_id']); ?>
                    <h2 style="margin-top: 1rem;">Services</h2>
                    <div class="tag-list">
                            <?php foreach($activities as $activity) : ?>
                            <span class="tag1"><?php echo $activity['category_name']; ?></span>
                            <?php endforeach; ?>
                    </div>
                </div>

                <div class="place-details">
                    <div class="detail-item">
                        <h3><i class="fas fa-info-circle"></i> Quick Facts</h3>
                        <p><strong>Location:</strong> <?php echo htmlspecialchars($current_place['location']); ?></p>
                        <p><strong>Best Time to Visit:</strong>
                            <?php echo htmlspecialchars($current_place['best_time_to_visit'] ?? 'Year-round'); ?></p>
                        <p><strong>Entry Fee:</strong>
                            <?php echo htmlspecialchars($current_place['entry_fee'] ?? 'Free'); ?></p>
                    </div>

                    <div class="detail-item">
                        <h3><i class="fas fa-map-marked-alt"></i> How to Get There</h3>
                        <p>By car: Take Highway 101 and exit at Mountain View Road</p>
                        <p>By public transport: Bus #42 from downtown stops nearby</p>
                    </div>

                    <div class="detail-item">
                        <h3><i class="fas fa-utensils"></i> Nearby Amenities</h3>
                        <p>Restaurants within 1km: 5</p>
                        <p>Parking available: Yes</p>
                        <p>Public restrooms: Yes</p>
                    </div>

                    <div class="detail-item">
                        <h3><i class="fas fa-exclamation-triangle"></i> Travel Tips</h3>
                        <p>Wear comfortable walking shoes</p>
                        <p>Bring water and sunscreen in summer</p>
                        <p>Check weather conditions before visiting</p>
                    </div>

                                <div class="itinerary-btn">
                    <form action="" method="POST">
                        <?php 
                        $place_has_itinerary = false;
        
                            // Check if user is logged in before checking itineraries
                            if(isset($_SESSION['user_id'])) {
                                foreach($itineraries as $itinerary) {
                                    if($itinerary['place_id'] == $_GET['place_id'] && $itinerary['user_id'] == $_SESSION['user_id']) {
                                        $place_has_itinerary = true;
                                        break;
                                    }
                                }
                            }
                            ?>
                            
                            <?php if(isset($_SESSION['user_id'])): ?>
                                <?php if($place_has_itinerary): ?>
                                    <button type="submit" class="btn-remove" name="remove_itinerary">
                                        <i class="fas fa-minus-circle"></i> Remove Itinerary
                                    </button>
                                <?php else: ?>
                                    <button type="submit" name="add_itinerary" class="btn-add">
                                        <i class="fas fa-plus-circle"></i> Add Itinerary
                                    </button>
                                <?php endif; ?>
                            <?php else: ?>
                                <a href="login.php" class="btn-login">
                                    <button type="button">
                                    <i class="fas fa-sign-in-alt"></i> Login to Add to Itinerary
                                    </button>
                                </a>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>

            <div class="gallery-section">
                <h2>Nearest Places</h2>
                <div class="gallery-grid">
                    <!-- Magkuha sa current place id for reference sa nearest index -->
                    <?php $current_nearest_index = null; ?>
                    <?php foreach ($places as $place): ?>
                        <?php
                        if ($place['place_id'] == $_GET['place_id']) {
                            $current_nearest_index = $place['nearest_index'];
                            break;
                        }
                        ?>
                    <?php endforeach; ?>
                    <!-- Gikuha tanan places then ga base if same nearest index and not same id -->
                    <?php if ($current_nearest_index !== null): ?>
                        <?php $skip_first = true ?>
                        <!-- skip ang first place since same pud siya ug index -->
                        <?php foreach ($places as $place): ?>
                            <?php if ($place['nearest_index'] == $current_nearest_index && $place['place_id'] !== $_GET['place_id']): ?>
                                <?php
                                if ($skip_first) {
                                    $skip_first = false;
                                    continue;
                                }
                                ?>
                                <div class="gallery-item">
                                    <img src="../assets/images/<?php echo $place['place_img']; ?>" alt="Gallery image 1">
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <?php
            // Step 1: Get category_ids for current place
            $place_categories_matched = [];
            foreach ($place_categories as $place_category) {
                if ($place_category['place_id'] == $_GET['place_id']) {
                    $place_categories_matched[] = $place_category['category_id'];
                }
            }
            ?>

            <div class="gallery-section">
                <?php 
                $show_heading = false;
                
                // First pass to determine if we should show the heading
                foreach ($places as $place) {
                    if ($place['place_id'] == $_GET['place_id']) continue;
                    
                    $other_place_categories = [];
                    foreach ($place_categories as $pc) {
                        if ($pc['place_id'] == $place['place_id']) {
                            $other_place_categories[] = $pc['category_id'];
                        }
                    }
                    
                    $shared_categories = array_intersect($place_categories_matched, $other_place_categories);
                    if (!empty($shared_categories)) {
                        $show_heading = true;
                        break; // We only need one match to show the heading
                    }
                }
                
                // Now display the heading if needed
                if ($show_heading) {
                    echo '<h2>You may also like</h2>';
                }
                ?>
                
                <div class="gallery-grid">
                    <?php foreach ($places as $place): ?>
                        <?php
                        if ($place['place_id'] == $_GET['place_id']) continue;
                        
                        $other_place_categories = [];
                        foreach ($place_categories as $pc) {
                            if ($pc['place_id'] == $place['place_id']) {
                                $other_place_categories[] = $pc['category_id'];
                            }
                        }
                        
                        $shared_categories = array_intersect($place_categories_matched, $other_place_categories);
                        ?>
                        
                        <?php if (!empty($shared_categories)): ?>
                            <div class="gallery-item">
                                <img src="../assets/images/<?php echo $place['place_img']; ?>"
                                    alt="Gallery image of <?php echo $place['place_name']; ?>">
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>


        <?php else: ?>
            <div class="error-message">
                <h2>Place not found</h2>
                <p>The place you're looking for doesn't exist or has been removed.</p>
                <a href="../index.php">Return to homepage</a>
            </div>
        <?php endif; ?>
    </div>

    <footer class="footer">
        <p>&copy; <?php echo date('Y'); ?> Olanggo Travel. All rights reserved.</p>
        <p>Contact us: olanggotravel@gmail.com</p>
    </footer>
</body>

</html>
<script src="../assets/js/loading.js"></script>