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
    <link href="assets/fonts/poppins.css"
        rel="stylesheet">
    <link href="assets/fonts/playfair.css" rel="stylesheet">
    <link href="assets/fonts/kaushan.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/loading.css">
    <link rel="stylesheet" href="assets/css/headerToHero.css">
    <link rel="stylesheet" href="assets/css/activities.css">
    <link rel="stylesheet" href="assets/css/mustSee.css">
    <link rel="stylesheet" href="assets/css/itineraryPlanner.css">
    <link rel="stylesheet" href="assets/css/profileGear.css">
    <link rel="stylesheet" href="assets/css/alert.css">
    <script src="assets/js/jquery.js"></script>

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

        .footer {
            font-family: 'Poppins', sans-serif;
            background: #2c3e50;
            color: white;
            padding: 30px 0;
            text-align: center;
            margin-top: 50px;
        }
        .back-home i {
            background-color: rgba(192, 192, 192, 0.8);
            padding: 1.5rem;
            border-radius: 50%;
            position: fixed;
            bottom: 20px; /* small gap from bottom */
            right: 20px;  /* small gap from right */
            z-index: 9999;
            cursor: pointer;
        }
        .back-home i:hover {
            background-color: rgb(192, 192, 192);
            transition: background-color 0.3s ease;
        }

        
        
    </style>
</head>

<body>
    <?php if(isset($_SESSION['login_success'])) : ?>
    <div id="showMsg"> <?php echo "<script>const SuccessMessage = '" . $_SESSION['login_success'] . "';</script>"; ?></div>
    <script src="assets/js/successAlert.js"></script>
    <?php unset($_SESSION['login_success']); ?>
    <?php endif; ?>

    <div id="loading-overlay">
        <div class="loader-content">
            <img src="assets/images/logo2-removebg-preview.png" alt="Logo" class="loading-logo">
            <div class="dot-loader">
                <span></span><span></span><span></span><span></span>
            </div>
        </div>
    </div>

    <div class="back-home">
        <i class="fa-solid fa-chevron-up"></i>
    </div>

    <div class="home-container">
        <div class="header" id="header">
            <div class="header-right">
                <div class="logo">
                    <img src="assets/images/logo2-removebg-preview.png" alt="">
                    <a href="#header" style="font-family: 'Kaushan Script', cursive;">OlanggoTravels</a>
                </div>
            </div>
            <div class="header-right">
                <a href="#"><i class="fa-brands fa-facebook"></i> OlanggoTravels</a>
                <span>|</span>
                <a href="#"><i class="fa-brands fa-instagram"></i> OlanggoTravels</a>
            </div>
        </div>

        <div class="container-navbar" id="container-navbar">
            <nav>
                <ul class="nav-links">
                    <li class="activities-link"><a href="#"><i class="fa-solid fa-chevron-down"></i> Contents</a></li>
                    <li><a href="#itinerary-planner">Plan your trip</a></li>
                    <li><a href="otherPages/faq.html">FAQ</a></li>
                </ul>
                <!-- Search Bar in your navbar -->
                    <div class="search-container">
                        <div class="search-bar" id="search-bar">
                            <input type="text" id="place-search" placeholder="Search destinations..." autocomplete="off">
                            <button type="submit" class="search-btn">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                            <div class="search-results" id="search-results"></div>
                        </div>
                    </div>
                <ul class="auth-links">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="profile-gear-container">
                            <div class="profile-image-bg" id="profile-image-bg"
                                style="background-image: url('assets/images/<?php echo $_SESSION['user_img']; ?>');">
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
                    <li><a href="#activities">Activities</a></li>
                    <li><a href="#">Gallery</a></li>
                </ul>
            </div>
        </div>

        <!-- Carousel -->
        <div class="hero-section">
            <div class="carousel">
                <div class="carousel-inner">
                    <?php foreach($places as $place) : ?>
                    <div class="carousel-item">
                        <img src="assets/images/<?php echo $place['place_img'] ?>" alt="Beautiful Island View">
                        <div class="carousel-caption">
                            <h1><?php echo $place['place_name']; ?></h1>
                            <p><?php echo $place['description'] ?></p>
                            <a href="otherPages/place-choice.php?place_id=<?php echo $place['place_id']; ?>" class="btn"> See place </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
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
                    <?php $dataSlide = 0?>
                    <?php foreach($places as $place) : ?>
                    <?php if($dataSlide >= 5) break; ?>
                    <div class="carousel-indicator active" data-slide-to="<?php echo $dataSlide ?>"></div>
                    <?php $dataSlide++; ?>
                    <?php endforeach; ?>
                </div>
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
                                <a href="otherPages/place-choice.php?place_id=<?php echo $place['place_id']; ?>"> Read more </a>
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
                        <?php foreach ($activities as $activity): ?>
                            <label class="filter-label">
                                <input type="checkbox" class="filter-checkbox activity-filter"
                                    value="<?php echo $activity['activity_id']; ?>">
                                <span class="filter-name"><?php echo $activity['activity_name']; ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="filter-group">
                    <h4>Services</h4>
                    <div class="filter-options category-options">
                        <?php foreach ($categories as $category): ?>
                            <label class="filter-label">
                                <input type="checkbox" class="filter-checkbox category-filter"
                                    value="<?php echo $category['category_id']; ?>">
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
                    <div class="place-card" data-place-id="<?php echo $place['place_id']; ?>"
                        data-categories="<?php echo implode(',', $categoryIds); ?>"
                        data-activities="<?php echo implode(',', $activityIds); ?>">
                        <h2 class="place-name"><?php echo $place['place_name']; ?></h2>
                        <p class="duration"><?php echo $place['duration']; ?></p>
                        <div class="tags">
                            <?php foreach ($placeCategories as $category): ?>
                                <span class="tag category-tag"><?php echo $category['category_name']; ?></span>
                            <?php endforeach; ?>
                            <?php foreach ($placeActivities as $activity): ?>
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

        <footer class="footer">
            <p>&copy; <?php echo date('Y'); ?> Olanggo Travel. All rights reserved.</p>
            <span><i class="fa fa-envelope"></i> olanggotravel@gmail.com || <i class="fa fa-phone"></i> 63+ 0993 493
                6769</span>
        </footer>

    </div>
    <script src="assets/js/lenisCode.js"></script>
    <script src="assets/js/loading.js"></script>
    <script src="assets/js/carousel.js"></script>
    <script src="assets/js/dropdown.js"></script>
    <script src="assets/js/scrollEffect.js"></script>
    <script src="assets/js/itineraryPlanner.js"></script>
    <script src="assets/js/backHomescroll.js"></script>
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
</body>

</html>