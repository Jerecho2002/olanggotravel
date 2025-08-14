<?php
include("database/database.php");
$data->register();
$data->login();
$places = $data->get_places();
$activities = $data->get_activities();
$categories = $data->get_categories();
shuffle($places);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/loading.css">
    <link rel="stylesheet" href="assets/css/headerToHero.css">
    <link rel="stylesheet" href="assets/css/activities.css">
    <link rel="stylesheet" href="assets/css/mustSee.css">

    <title>Olanggo Travels</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --color-main: #FFFFFF;
            --color-teal: #00A896;
            --color-header: #0077B6;
            --carousel-transition-duration: 0.8s;
            --color-grey: #333;
        }

        .home-container {
            min-height: 100vh;
            height: 100%;
        }

        .profile-gear-container {
            position: relative;
            display: flex;
            align-items: center;
            cursor: pointer;
            margin-right: 15px;
            padding-bottom: 10px;
        }

        .profile-image-bg {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .profile-gear-container:hover .profile-image-bg {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .gear-icon-front {
            font-size: 1rem;
            color: #333;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            bottom: -5px;
            right: -5px;
            border: 2px solid white;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .profile-gear-container:hover .gear-icon-front {
            transform: scale(1.1);
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: calc(100% + 5px);
            background-color: #fff;
            min-width: 200px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            border-radius: 8px;
            overflow: hidden;
            padding-top: 10px;
            margin-top: -10px;
        }

        .dropdown-content::before {
            content: '';
            position: absolute;
            top: -10px;
            left: 0;
            right: 0;
            height: 10px;
            background: transparent;
        }

        .dropdown-content a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s;
            font-family: "Poppins", sans-serif;
            font-size: 0.9rem;
        }

        .dropdown-content a:hover {
            background-color: #f5f5f5;
            color: #0066cc;
        }

        .profile-gear-container:hover .dropdown-content {
            display: block;
            animation: fadeIn 0.2s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .gear-icon-front {
            /* Your existing styles */
            transition: all 0.3s ease;
        }

        .profile-gear-container:hover .gear-icon-front {
            animation: spin 0.5s linear;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* itinerary style */
      .plan-itinerary-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

h1 {
    color: #2c3e50;
    margin-bottom: 10px;
    text-align: center;
}

.subtitle {
    color: #7f8c8d;
    text-align: center;
    margin-bottom: 30px;
    font-weight: normal;
}

/* Filter Section */
.filter-section {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 30px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.filter-group {
    margin-bottom: 20px;
}

.filter-group h4 {
    color: #3498db;
    margin-bottom: 10px;
    font-size: 18px;
}

.filter-options {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.filter-label {
    position: relative;
    cursor: pointer;
}

.filter-checkbox {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

.filter-name {
    display: inline-block;
    padding: 8px 15px;
    background: #ecf0f1;
    border-radius: 20px;
    color: #34495e;
    transition: all 0.3s ease;
}

.filter-checkbox:checked + .filter-name {
    background: #3498db;
    color: white;
}

.filter-checkbox:focus + .filter-name {
    box-shadow: 0 0 0 2px #bdc3c7;
}

/* Clear Button */
.clear-btn {
    background: #e74c3c;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 4px;
    cursor: pointer;
    transition: background 0.3s;
    margin-top: 10px;
}

.clear-btn:hover {
    background: #c0392b;
}

/* Selection Message */
.selection-message {
    text-align: center;
    padding: 40px;
    color: #7f8c8d;
    font-size: 18px;
}

.selection-message i {
    font-size: 40px;
    margin-bottom: 15px;
    color: #bdc3c7;
    display: block;
}

/* Places Container */
.places-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
}

.place-card {
    background: white;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s;
}

.place-card:hover {
    transform: translateY(-5px);
}

.place-name {
    color: #2c3e50;
    margin-bottom: 10px;
}

.duration {
    color: #7f8c8d;
    margin-bottom: 15px;
    font-size: 14px;
}

.tags {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
}

.tag {
    font-size: 12px;
    padding: 4px 10px;
    border-radius: 12px;
    background: #ecf0f1;
    color: #34495e;
}

.category-tag {
    background: #e8f4fc;
    color: #2980b9;
}

.activity-tag {
    background: #f0f8e8;
    color: #27ae60;
}

    </style>
</head>

<body>
    <div id="loading-overlay">
        <div class="loader-content">
            <img src="assets/images/logo2-removebg-preview.png" alt="Logo" class="loading-logo">
            <div class="dot-loader">
                <span></span><span></span><span></span><span></span>
            </div>
        </div>
    </div>

    <div class="home-container">
        <div class="header" id="header">
            <div class="header-left">
                <p><i class="fa fa-phone"></i> 63+ 0993 493 6769 </p>
                <span>|</span>
                <p><i class="fa fa-envelope"></i> OlanggoTravels@gmail.com</p>
            </div>
            <div class="header-right">
                <a href="#"><i class="fa-brands fa-facebook"></i> OlanggoTravels</a>
                <span>|</span>
                <a href="#"><i class="fa-brands fa-instagram"></i> OlanggoTravels</a>
            </div>
        </div>

        <div class="container-navbar" id="container-navbar">
            <nav>
                <div class="logo">
                    <img src="assets/images/logo2-removebg-preview.png" alt="">
                    <a href="#header">OlanggoTravels</a>
                </div>
                <ul class="nav-links">
                    <li class="activities-link"><a href="#"><i class="fa-solid fa-chevron-down"></i> Contents</a></li>
                    <li><a href="#itinerary-planner">Plan your trip</a></li>
                    <li><a href="otherPages/faq.html">FAQ</a></li>
                </ul>
                <!-- Search Bar in your navbar -->
                <?php if (isset($_SESSION['user_id'])): ?>
                <div class="search-container">
                    <div class="search-bar" id="search-bar">
                        <input type="text" id="place-search" placeholder="Search destinations..." autocomplete="off">
                        <button type="submit" class="search-btn">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                        <div class="search-results" id="search-results"></div>
                    </div>
                </div>
                <?php endif; ?>
                <ul class="auth-links">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="profile-gear-container">
                            <div class="profile-image-bg" id="profile-image-bg"
                                style="background-image: url('assets/images/user-default-img.png');">
                                <!-- Profile image as background -->
                            </div>
                            <i class="fa-solid fa-gear gear-icon-front" id="gear-icon-front"></i>
                            <div class="dropdown-content">
                                <a href="">Profile settings</a>
                                <a href="otherPages/users/user-itineraries.php">My itineraries</a>
                                <a href="otherPages/logout.php">Logout</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <li><a href='otherPages/login.php'>Log in</a></li>
                        <li><a href='otherPages/signup.php' class='sign-up'>Sign up</a></li>
                    <?php endif; ?>
                </ul>
            </nav>


            <div class="activities-dropdown">
                <ul>
                    <li><a href="#islands">Islands</a></li>
                    <li><a href="#">Gallery</a></li>
                    <li><a href="#">Scuba Diving</a></li>
                    <li><a href="#">Kayaking</a></li>
                    <li><a href="#">Fishing</a></li>
                    <li><a href="#">Camping</a></li>
                </ul>
            </div>
        </div>

        <!-- Must See -->
        <div class="container-must-see" id="islands">
            <div class="must-see">
                <p>Olango Island, located just off the coast of Cebu, is a hidden gem known for its stunning marine
                    sanctuary, crystal-clear waters, and vibrant bird sanctuary that attracts thousands of migratory
                    birds each year. Whether you're snorkeling among colorful reefs or watching the sunset from a quiet
                    beach,
                    Olango offers an unforgettable island experience.</p>
                <h1>Discover Olanggo's Must-See Spots & Experiences</h1>

                <div class="must-see-images">
                    <?php
                    $maxItems = 6;
                    $loopCount = 0;

                    foreach ($places as $place):
                        if ($loopCount >= $maxItems)
                            break;

                        // First item gets 'featured-item' class, others get no special class
                        $itemClass = ($loopCount === 0) ? 'featured-item' : '';
                        ?>
                        <div class="must-see-info <?= $itemClass ?>">
                            <div class="text-content">
                                <h3><?= htmlspecialchars($place['place_name']) ?></h3>
                                <p><?= htmlspecialchars($place['description']) ?></p>
                                <a href="#">Read more</a>
                            </div>
                            <img src="assets/images/<?= htmlspecialchars($place['place_img']) ?>"
                                alt="<?= htmlspecialchars($place['place_name']) ?>">
                        </div>
                        <?php
                        $loopCount++;
                    endforeach;
                    ?>
                </div>
            </div>
        </div>

        <!-- Itinerary Planner -->
        <div class="plan-itinerary-container" id="itinerary-planner">
    <h1>Plan Your Perfect Itinerary</h1>
    <h3 class="subtitle">Select your preferred activities and categories to see matching places</h3>
    
    <div class="filter-section">
        <div class="filter-group">
            <h4>Activities</h4>
            <div class="filter-options activity-options">
                <?php foreach($activities as $activity) : ?>
                <label class="filter-label">
                    <input type="checkbox" class="filter-checkbox activity-filter" value="<?php echo $activity['activity_id']; ?>">
                    <span class="filter-name"><?php echo $activity['activity_name']; ?></span>
                </label>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="filter-group">
            <h4>Services</h4>
            <div class="filter-options category-options">
                <?php foreach($categories as $category) : ?>
                <label class="filter-label">
                    <input type="checkbox" class="filter-checkbox category-filter" value="<?php echo $category['category_id']; ?>">
                    <span class="filter-name"><?php echo $category['category_name']; ?></span>
                </label>
                <?php endforeach; ?>
            </div>
        </div>
        
        <button class="clear-btn">Clear all filters</button>
    </div>
    
    <div id="no-selection-message" class="selection-message">
        <i class="fas fa-map-marker-alt"></i>
        <p>Please select activities or categories to see recommended places</p>
    </div>
    
    <div class="places-container" style="display:none">
        <?php foreach ($places as $place): ?>
        <?php
            $placeCategories = $data->category_names($place['place_id']);
            $placeActivities = $data->activity_names($place['place_id']);
            $categoryIds = array_column($placeCategories, 'category_id');
            $activityIds = array_column($placeActivities, 'activity_id');
        ?>
        <div class="place-card" 
             data-place-id="<?php echo $place['place_id']; ?>"
             data-categories="<?php echo implode(',', $categoryIds); ?>"
             data-activities="<?php echo implode(',', $activityIds); ?>">
            <h2 class="place-name"><?php echo $place['place_name']; ?></h2>
            <p class="duration"><?php echo $place['duration']; ?></p>
            <div class="tags">
                <?php foreach($placeCategories as $category) : ?>
                <span class="tag category-tag"><?php echo $category['category_name']; ?></span>
                <?php endforeach; ?>
                <?php foreach($placeActivities as $activity) : ?>
                <span class="tag activity-tag"><?php echo $activity['activity_name']; ?></span>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

        <!-- Activities -->
        <div class="container-activities" id="activities">
            <div class="activities">
                <h1>Discover Fun-Filled Activities</h1>
                <div class="place-choices">
                    <?php foreach ($places as $place): ?>
                        <?php
                        $categories = $data->category_names($place['place_id']);
                        $activities = $data->activity_names($place['place_id']);
                        ?>
                        <div class="card">
                            <a href="otherPages/place-choice.php?place_id=<?php echo $place['place_id']; ?>">
                                <img src="assets/images/<?php echo $place['place_img']; ?>" alt="Beach View">
                                <div class="card-content">
                                    <h3><?php echo $place['place_name']; ?></h3>
                                    <p><?php echo $place['description']; ?></p>
                                    <label for="">Services: </label>
                                    <?php foreach ($categories as $category): ?>
                                        <p><?php echo $category['category_name']; ?></p>
                                    <?php endforeach; ?>
                                    <label for="">Activities: </label>
                                    <?php foreach ($activities as $activity): ?>
                                        <p><?php echo $activity['activity_name']; ?></p>
                                    <?php endforeach; ?>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="#" class="see-more-btn">See more</a>
            </div>
        </div>

        <!-- Carousel -->
        <div class="hero-section">
            <div class="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item">
                        <img src="assets/images/1_upscaled.jpg" alt="Beautiful Island View">
                        <div class="carousel-caption">
                            <h1>Discover Paradise</h1>
                            <p>Explore the breathtaking islands of Olanggo with our exclusive tours</p>
                            <a href="#" class="btn">Show Activities</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/images/2_upscaled.jpg" alt="Crystal Clear Waters">
                        <div class="carousel-caption">
                            <h1>Adventure Awaits</h1>
                            <p>Create memories that will last a lifetime with our guided tours</p>
                            <a href="#" class="btn">See Pictures</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/images/3_upscaled.jpg" alt="Sunset Beach">
                        <div class="carousel-caption">
                            <h1>Unforgettable Sunsets</h1>
                            <p>Witness the most spectacular sunsets from our luxury beachfront resorts</p>
                            <a href="#" class="btn">Explore Islands</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/images/4_upscaled.jpg" alt="Island Adventure">
                        <div class="carousel-caption">
                            <h1>Crystal Clear Waters</h1>
                            <p>Dive into the most pristine waters and discover vibrant marine life</p>
                            <a href="#" class="btn">Start Your Journey</a>
                        </div>
                    </div>
                </div>

                <div class="carousel-controls">
                    <button class="carousel-control prev" aria-label="Previous slide">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="carousel-control next" aria-label="Next slide">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <div class="carousel-indicators">
                    <div class="carousel-indicator active" data-slide-to="0"></div>
                    <div class="carousel-indicator" data-slide-to="1"></div>
                    <div class="carousel-indicator" data-slide-to="2"></div>
                    <div class="carousel-indicator" data-slide-to="3"></div>
                </div>
            </div>
        </div>

    </div>
    <script src="assets/js/lenisCode.js"></script>
    <script src="assets/js/loading.js"></script>
    <script src="assets/js/carousel.js"></script>
    <script src="assets/js/dropdown.js"></script>
    <script src="assets/js/scrollEffect.js"></script>
    <script>
        //global variable for search bar
        window.searchPlacesData = <?php echo json_encode($places); ?>;
    </script>
    <script src="assets/js/searchBar.js"></script>
    <script>
        //scroll
        const lenis = new Lenis({
            lerp: 0.1,
            smooth: true
        })

        function raf(time) {
            lenis.raf(time)
            requestAnimationFrame(raf)
        }

        requestAnimationFrame(raf)

        //anchor
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    lenis.scrollTo(targetElement, {
                        duration: 3,
                        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
                        offset: -20
                    });
                }
            });
        });
    </script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const activityFilters = document.querySelectorAll('.activity-filter');
    const categoryFilters = document.querySelectorAll('.category-filter');
    const clearBtn = document.querySelector('.clear-btn');
    const placeContainer = document.querySelector('.places-container');
    const noSelectionMsg = document.getElementById('no-selection-message');

    function filterPlaces() {
        const selectedActivities = Array.from(document.querySelectorAll('.activity-filter:checked'))
                                      .map(el => el.value);
        const selectedCategories = Array.from(document.querySelectorAll('.category-filter:checked'))
                                      .map(el => el.value);

        // Toggle containers
        if (selectedActivities.length === 0 && selectedCategories.length === 0) {
            placeContainer.style.display = 'none';
            noSelectionMsg.style.display = 'block';
            return;
        } else {
            placeContainer.style.display = 'grid';
            noSelectionMsg.style.display = 'none';
        }

        // Filter places
        const placeCards = document.querySelectorAll('.place-card');
        placeCards.forEach(card => {
            const cardActivities = card.dataset.activities.split(',');
            const cardCategories = card.dataset.categories.split(',');

            const showCard = 
                (selectedActivities.length === 0 || selectedActivities.some(a => cardActivities.includes(a))) &&
                (selectedCategories.length === 0 || selectedCategories.some(c => cardCategories.includes(c)));

            card.style.display = showCard ? 'block' : 'none';
        });
    }

    // Event listeners
    activityFilters.forEach(filter => filter.addEventListener('change', filterPlaces));
    categoryFilters.forEach(filter => filter.addEventListener('change', filterPlaces));
    
    clearBtn.addEventListener('click', function() {
        activityFilters.forEach(filter => filter.checked = false);
        categoryFilters.forEach(filter => filter.checked = false);
        filterPlaces();
    });
});
</script>
</body>

</html>