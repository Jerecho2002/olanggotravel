<?php
    include("database/database.php");
    $data->register();
    $data->login();
    $places = $data->get_places();
    
    shuffle($places);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/loading.css">
    <link rel="stylesheet" href="assets/css/headerToHero.css">
    <link rel="stylesheet" href="assets/css/activities.css">
    <link rel="stylesheet" href="assets/css/mustSee.css">

    <title>Olanggo Travels</title>
    <style>
        html {
            scroll-behavior: smooth;
        }

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
        
        
        /* Gear Dropdown Styles */
.gear-dropdown {
    position: relative;
    display: inline-block;
    cursor: pointer;
    margin-right: 15px;
}

.gear-icon {
    font-size: 1.2rem;
    color: #333;
    transition: all 0.3s ease;
    padding: 5px;
}

.gear-icon:hover {
    color: #0066cc;
}

.dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    background-color: #fff;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    border-radius: 4px;
    overflow: hidden;
}

.dropdown-content a {
    color: #333;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    transition: background-color 0.3s;
}

.dropdown-content a:hover {
    background-color: #f5f5f5;
    color: #0066cc;
}

.gear-dropdown:hover .dropdown-content {
    display: block;
}
    </style>
</head>

<body>
    <!-- <div id="loading-overlay">
        <div class="loader-content">
            <img src="assets/images/logo2-removebg-preview.png" alt="Logo" class="loading-logo">
            <div class="dot-loader">
                <span></span><span></span><span></span><span></span>
            </div>
        </div>
    </div> -->

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

        <div class="container-navbar">
           <nav>
                <div class="logo">
                    <img src="assets/images/logo2-removebg-preview.png" alt="">
                    <a href="#header">OlanggoTravels</a>
                </div>
                <ul class="nav-links">
                    <li><a href="#islands">Islands</a></li>
                    <li class="activities-link"><a href="#"><i class="fa-solid fa-chevron-down"></i> Activities</a></li>
                    <li><a href="#">Gallery</a></li>
                    <li><a href="otherPages/faq.html">FAQ</a></li>
                </ul>
                <ul class="auth-links">
                    <?php if(isset($_SESSION['user_id'])) : ?>
                        <div class="gear-dropdown">
                            <i class="fa-solid fa-gear gear-icon"></i>
                            <div class="dropdown-content">
                                <a href="">Profile settings</a>
                                <a href="otherPages/users/user-itineraries.php">My itineraries</a>
                                <a href="otherPages/logout.php">Logout</a>
                            </div>
                        </div>
                    <?php else : ?>
                        <li><a href='otherPages/login.php'>Log in</a></li>
                        <li><a href='otherPages/signup.php' class='sign-up'>Sign up</a></li>
                    <?php endif; ?>
                </ul>
            </nav>


            <div class="activities-dropdown">
                <ul>
                    <li><a href="#">Island Hopping</a></li>
                    <li><a href="#">Snorkeling</a></li>
                    <li><a href="#">Scuba Diving</a></li>
                    <li><a href="#">Kayaking</a></li>
                    <li><a href="#">Fishing</a></li>
                    <li><a href="#">Camping</a></li>
                </ul>
            </div>
        </div>

        <!-- Slide Animation Carousel -->
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

        <div class="container-activities" id="activities">
            <div class="activities">
                <h1>Discover Fun-Filled Activities</h1>
                <div class="place-choices">
                    <?php foreach($places as $place) : ?>
                         <div class="card">
                        <a href="otherPages/place-choice.php?place_id=<?php echo $place['place_id']; ?>">
                        <img src="assets/images/<?php echo $place['place_img']; ?>" alt="Beach View">
                        <div class="card-content">
                            <h3><?php echo $place['place_name']; ?></h3>
                            <p><?php echo $place['description']; ?></p>
                        </div>
                        </a>
                    </div>
                    <?php endforeach; ?>

                </div>
                <a href="activities" class="see-more-btn">See more</a>
            </div>
        </div>

        <div class="container-must-see" id="islands">
            <div class="must-see">
                <p>Olango Island, located just off the coast of Cebu, is a hidden gem known for its stunning marine
                    sanctuary, crystal-clear waters, and vibrant bird sanctuary that attracts thousands of migratory
                    birds each year. Whether you're snorkeling among colorful reefs or watching the sunset from a quiet
                    beach,
                    Olango offers an unforgettable island experience.</p>
                <h1>Discover Olanggo's Must-See Spots & Experiences</h1>

                <div class="must-see-images">
                    <div class="must-see-info">
                        <div class="text-content">
                            <h3>Olango Wildlife Sanctuary</h3>
                            <p>Home to migratory birds from Siberia and other parts of Asia, this sanctuary is a
                                paradise for bird watchers and nature enthusiasts. Visit between September and November
                                for the best sightings.</p>
                            <a href="#">Read more</a>
                        </div>
                        <img src="assets/images/1_upscaled.jpg" alt="Olango Wildlife Sanctuary">
                    </div>
                    <div class="must-see-info">
                        <div class="text-content">
                            <h3>Santa Rosa Beach</h3>
                            <p>Pristine white sand beach with crystal clear waters perfect for swimming and sunbathing.
                                Enjoy the peaceful atmosphere away from crowded tourist spots.</p>
                            <a href="#">Read more</a>
                        </div>
                        <img src="assets/images/2_upscaled.jpg" alt="Santa Rosa Beach">
                    </div>
                    <div class="must-see-info">
                        <div class="text-content">
                            <h3>Coral Reef Snorkeling</h3>
                            <p>Explore vibrant coral gardens teeming with marine life. The shallow waters make it
                                perfect for beginners and experienced snorkelers alike.</p>
                            <a href="#">Read more</a>
                        </div>
                        <img src="assets/images/3_upscaled.jpg" alt="Coral Reef Snorkeling">
                    </div>
                    <div class="must-see-info">
                        <div class="text-content">
                            <h3>Sunset Boardwalk</h3>
                            <p>Witness breathtaking sunsets from this scenic boardwalk. The panoramic views of the
                                horizon are simply unforgettable.</p>
                            <a href="#">Read more</a>
                        </div>
                        <img src="assets/images/4_upscaled.jpg" alt="Sunset Boardwalk">
                    </div>
                    <div class="must-see-info">
                        <div class="text-content">
                            <h3>Local Village Tour</h3>
                            <p>Experience authentic island life by visiting local fishing villages. Learn about
                                traditional fishing methods and sample fresh seafood.</p>
                            <a href="#">Read more</a>
                        </div>
                        <img src="assets/images/upscalemedia-transformed(5).jpeg" alt="Local Village Tour">
                    </div>
                    <div class="must-see-info">
                        <div class="text-content">
                            <h3>Island Hopping</h3>
                            <p>Discover hidden coves and secret beaches around Olango and its neighboring islands.
                                Perfect for adventure seekers and photography enthusiasts.</p>
                            <a href="#">Read more</a>
                        </div>
                        <img src="assets/images/upscalemedia-transformed (6).jpeg" alt="Island Hopping">
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
<script src="assets/js/loading.js"></script>
<script src="assets/js/carousel.js"></script>
<script src="assets/js/dropdown.js"></script>
<script src="assets/js/scrollEffect.js"></script>