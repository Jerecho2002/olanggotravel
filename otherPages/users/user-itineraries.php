<?php
include("../../database/database.php");
$itineraries = $data->get_itineraries();
$data->session_user("../../index.php");
$results = $data->joining();

usort($results, function ($a, $b) {
    return $a['nearest_index'] - $b['nearest_index']; // Ascending sort
});

// Group places into days (3 places per day)
$days = array_chunk($results, 3);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olanggo Island Itinerary</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary-color: #1a6b8c;
            --secondary-color: #2e8b57;
            --accent-color: #e6d5b8;
            --light-bg: #f8f9fa;
            --text-color: #333;
            --light-text: #6c757d;
            --border-color: #e0e0e0;
        }

        /* Base Styles */
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background: var(--light-bg);
        }

        header {
            text-align: center;
            margin-bottom: 40px;
            padding: 30px 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }

        header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        h1 {
            color: var(--primary-color);
            margin-bottom: 10px;
            font-weight: 700;
            font-size: 2.5rem;
        }

        .subtitle {
            color: var(--light-text);
            font-size: 1.1rem;
            margin-top: 0;
        }

        .itinerary-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-bottom: 40px;
        }

        .day-section {
            margin-bottom: 40px;
            border-radius: 8px;
            overflow: hidden;
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .day-header {
            background: linear-gradient(90deg, var(--primary-color), #2a7b9c);
            color: white;
            padding: 15px 25px;
            margin: 0;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
        }

        .day-header::before {
            content: "Day";
            font-weight: 300;
            margin-right: 10px;
            opacity: 0.8;
        }

        .itinerary-items {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .itinerary-item {
            padding: 25px;
            display: flex;
            gap: 25px;
            border-bottom: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .itinerary-item:hover {
            background-color: #f8fafb;
        }

        .itinerary-item:last-child {
            border-bottom: none;
        }

        .place-image-container {
            flex-shrink: 0;
            width: 250px;
            height: 180px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .place-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .itinerary-item:hover .place-image {
            transform: scale(1.03);
        }

        .place-details {
            flex-grow: 1;
        }

        .place-name {
            color: var(--primary-color);
            margin: 0 0 10px 0;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .location {
            color: var(--secondary-color);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 8px;
        }

        .duration {
            background: var(--accent-color);
            color: #5a4a32;
            padding: 5px 12px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .description {
            color: var(--text-color);
            margin-bottom: 15px;
            line-height: 1.7;
        }

        .categories {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 15px;
            align-items: center;
        }

        .categories-label {
            font-size: 0.9rem;
            color: var(--light-text);
            margin-right: 5px;
        }

        .category-tag {
            background: #f0f7ff;
            color: var(--primary-color);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            border: 1px solid #d0e3ff;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .category-tag::before {
            content: "•";
            color: var(--secondary-color);
            font-weight: bold;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 30px;
            gap: 15px;
        }

        .print-button,
        .download-button {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .print-button:hover,
        .download-button:hover {
            background: #145a7a;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .print-button svg,
        .download-button svg {
            width: 18px;
            height: 18px;
            fill: currentColor;
        }

        /* Activities Section */
        .activities-section {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .activities-title {
            color: var(--primary-color);
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .activities-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .activity-tag {
            background: #e8f4fc;
            color: var(--primary-color);
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Print Styles */
        @media print {
            body {
                padding: 0;
                font-size: 12pt;
                background: none;
            }

            .no-print {
                display: none;
            }

            .day-section {
                page-break-after: always;
                margin-bottom: 20px;
                box-shadow: none;
                border-radius: 0;
            }

            .itinerary-item {
                border: none;
                border-bottom: 1px solid #ddd;
                padding: 15px 0;
                page-break-inside: avoid;
            }

            .place-image-container {
                width: 180px;
                height: 120px;
            }

            header {
                box-shadow: none;
                border-bottom: 2px solid var(--primary-color);
                border-radius: 0;
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .itinerary-item {
                flex-direction: column;
                gap: 15px;
            }

            .place-image-container {
                width: 100%;
                height: 200px;
            }

            .action-buttons {
                justify-content: center;
            }
        }

        .activity-tag {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            border: 1px solid #c8e6c9;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-right: 5px;
        }

        .activity-tag::before {
            content: "⚈";
            font-size: 0.7rem;
        }
    </style>
</head>

<body>
    <header>
        <h1>Olanggo Island Travel Itinerary</h1>
        <p class="subtitle">Your personalized adventure plan</p>
    </header>

    <div class="action-buttons no-print">
        <button class="print-button" onclick="window.print()">Print Itinerary</button>
    </div>

    <?php foreach ($results as $place): ?>
    <div class="place-card">
        <h3><?= htmlspecialchars($place['place_name']) ?></h3>
        
        <!-- Categories -->
        <?php $categories = $data->category_names($place['itinerary_id'] ?? $place['place_id']); ?>
        <?php if (!empty($categories)): ?>
            <div class="categories">
                <span>Services: </span>
                <?php foreach ($categories as $category): ?>
                    <span class="category-tag"><?= htmlspecialchars($category['category_name']) ?></span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <!-- Activities -->
        <?php $activities = $data->get_place_activities($place['place_id']); ?>
        <?php if (!empty($activities)): ?>
            <div class="categories" style="margin-top: 10px;">
                <span>Activities: </span>
                <?php foreach ($activities as $activity): ?>
                    <span class="activity-tag"><?= htmlspecialchars($activity['activity_name']) ?></span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

    <div class="itinerary-container">
        <?php foreach ($days as $dayNumber => $dayPlaces): ?>
            <div class="day-section">
                <h2 class="day-header">Day <?= $dayNumber + 1 ?></h2>

                <ul class="itinerary-items">
                    <?php foreach ($dayPlaces as $place):
                        $categories = $data->category_names($place['itinerary_id'] ?? $place['place_id']);
                        $activities = $data->get_place_activities($place['place_id']);
                        ?>
                        <li class="itinerary-item">
                            <div class="place-image-container">
                                <img src="../../assets/images/<?= htmlspecialchars($place['place_img']) ?>"
                                    alt="<?= htmlspecialchars($place['place_name']) ?>" class="place-image">
                            </div>

                            <div class="place-details">
                                <h3 class="place-name"><?= htmlspecialchars($place['place_name']) ?></h3>

                                <p class="location">
                                    📍 <?= htmlspecialchars($place['location']) ?>
                                </p>

                                <p class="duration">
                                    ⏱️ <?= htmlspecialchars($place['duration']) ?>
                                </p>

                                <p class="description"><?= htmlspecialchars($place['description']) ?></p>

                                <?php if (!empty($categories)): ?>
                                    <div class="categories">
                                        <span class="categories-label">Services:</span>
                                        <?php foreach ($categories as $category): ?>
                                            <span class="category-tag"><?= htmlspecialchars($category['category_name']) ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($activities)): ?>
                                    <div class="categories" style="margin-top: 10px;">
                                        <span class="categories-label">Activities:</span>
                                        <?php foreach ($activities as $activity): ?>
                                            <span class="activity-tag"><?= htmlspecialchars($activity['activity_name']) ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>