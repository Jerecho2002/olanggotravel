<?php
include("../../database/database.php");
$itineraries = $data->get_itineraries();
$data->session_user("../../index.php");
$results = $data->itineraries();

usort($results, function ($a, $b) {
    return $a['nearest_index'] - $b['nearest_index'];
});

$days = array_chunk($results, 3); // 3 places per day

// Define time slots for each place in a day
$timeSlots = [
    ['9:30AM - 12:00PM', 'Morning'],
    ['1:30PM - 4:30PM', 'Afternoon'],
    ['6:00PM - 8:00PM', 'Evening']
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olanggo Island Itinerary</title>
    <link rel="stylesheet" href="../../assets/css/loading.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            color: #333;
        }

        header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #1a6b8c;
        }

        h1 {
            color: #1a6b8c;
            margin-bottom: 5px;
        }

        .day-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            overflow: hidden;
        }

        .day-header {
            background: #1a6b8c;
            color: white;
            padding: 12px 20px;
            font-size: 1.2rem;
        }

        .place-item {
            padding: 20px;
            border-bottom: 1px solid #eee;
            position: relative;
        }

        .place-item:last-child {
            border-bottom: none;
        }

        .time-slot {
            position: absolute;
            right: 20px;
            top: 20px;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
            color: #1a6b8c;
        }

        .time-period {
            color: #666;
            font-size: 0.9rem;
            margin-top: 3px;
        }

        .place-name {
            color: #1a6b8c;
            margin: 0 0 8px 0;
            font-size: 1.3rem;
            width: 70%;
        }

        .place-meta {
            color: #666;
            margin: 8px 0;
            font-size: 0.95rem;
        }

        .place-meta span {
            margin-right: 15px;
        }

        .place-desc {
            margin: 12px 0;
            color: #444;
        }

        .tags {
            margin-top: 15px;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .tag {
            background: #f0f7ff;
            color: #1a6b8c;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
        }

        .activity-tag {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .print-btn {
            background: #1a6b8c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
            float: right;
        }

        .home-link {
            color: #1a6b8c;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .home-link:hover {
            text-decoration: underline;
        }

        .home-link svg {
            width: 16px;
            height: 16px;
            fill: currentColor;
        }


        header {
            padding: 15px 20px;
            margin-bottom: 30px;
            border-bottom: 2px solid #1a6b8c;
        }

        @media print {
            .print-btn {
                display: none;
            }

            .home-link {
                display: none;
            }

            body {
                padding: 0;
                font-size: 12pt;
            }

        }
    </style>
</head>

<body>
    <div id="loading-overlay">
        <div class="loader-content">
            <img src="../../assets/images/logo2-removebg-preview.png" alt="Logo" class="loading-logo">
            <div class="dot-loader">
                <span></span><span></span><span></span><span></span>
            </div>
        </div>
    </div>

    <header>
        <div style="position: relative;">
            <a class="home-link" href="../../index.php"
                style="position: absolute; left: 0;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                </svg>
                Back to Home
            </a>
            <div style="text-align: center;">
                <h1>Olanggo Island Itinerary</h1>
            </div>
        </div>
    </header>

    <button class="print-btn" onclick="window.print()">Print Itinerary</button>
    <div style="clear:both"></div>

    <?php foreach ($days as $dayNumber => $dayPlaces): ?>
        <div class="day-card">
            <div class="day-header">Day <?= $dayNumber + 1 ?></div>

            <?php foreach ($dayPlaces as $index => $place):
                $categories = $data->category_names($place['place_id']);
                $activities = $data->activity_names($place['place_id']);
                $timeSlot = $timeSlots[$index];
                ?>
                <div class="place-item">
                    <div class="time-slot">
                        <?= $timeSlot[0] ?>
                        <div class="time-period"><?= $timeSlot[1] ?></div>
                    </div>

                    <h3 class="place-name"><?= htmlspecialchars($place['place_name']) ?></h3>

                    <div class="place-meta">
                        <span>📍 <?= htmlspecialchars($place['location']) ?></span>
                    </div>

                    <p class="place-desc"><?= htmlspecialchars($place['description']) ?></p>

                    <?php if (!empty($categories)): ?>
                        <div class="tags">
                            <span style="color:#666;">Services: </span>
                            <?php foreach ($categories as $category): ?>
                                <span class="tag"><?= htmlspecialchars($category['category_name']) ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($activities)): ?>
                        <div class="tags" style="margin-top:8px;">
                            <span style="color:#666;">Activities: </span>
                            <?php foreach ($activities as $activity): ?>
                                <span class="tag activity-tag"><?= htmlspecialchars($activity['activity_name']) ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</body>

</html>
<script src="../../assets/js/loading.js"></script>