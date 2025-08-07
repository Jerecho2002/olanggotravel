<?php
    include("../../database/database.php");
    $itineraries = $data->get_itineraries();
    $data->session_user("../../index.php");
    $results = $data->joining();
    
    usort($results, function($a, $b) {
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
    <title>Document</title>
</head>
<body>
    <title>Olanggo Island Itinerary</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.5;
            color: #333;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background: white;
        }
        
        header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #1a6b8c;
        }
        
        h1 {
            color: #1a6b8c;
            margin-bottom: 5px;
        }
        
        .day-section {
            page-break-after: always;
            margin-bottom: 40px;
        }
        
        .day-header {
            background-color: #1a6b8c;
            color: white;
            padding: 10px 20px;
            border-radius: 5px 5px 0 0;
            margin-bottom: 0;
        }
        
        .itinerary-item {
            page-break-inside: avoid;
            border: 1px solid #e0e0e0;
            border-top: none;
            padding: 20px;
            display: flex;
        }
        
        .itinerary-item:last-child {
            border-radius: 0 0 5px 5px;
        }
        
        .place-image {
            width: 200px;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 20px;
        }
        
        .place-details {
            flex-grow: 1;
        }
        
        .place-name {
            color: #1a6b8c;
            margin-top: 0;
        }
        
        .location {
            color: #2e8b57;
            font-weight: bold;
        }
        
        .duration {
            background: #e6d5b8;
            padding: 3px 8px;
            border-radius: 20px;
            display: inline-block;
            font-size: 0.9rem;
        }
        
        /* Print Styles */
        @media print {
            body {
                padding: 0;
                font-size: 12pt;
            }
            
            .day-section {
                page-break-after: always;
                margin-bottom: 20px;
            }
            
            .itinerary-item {
                border: none;
                border-bottom: 1px solid #ddd;
                padding: 15px 0;
            }
            
            .no-print {
                display: none;
            }
        }
        
        /* Action Buttons */
        .action-buttons {
            text-align: right;
            margin-bottom: 20px;
        }
        
        .print-button {
            background: #1a6b8c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
         .day-section { margin-bottom: 40px; border: 1px solid #eee; padding: 15px; }
        .day-header { background: #1a6b8c; color: white; padding: 10px; }
        .place-card { display: flex; margin: 10px 0; }
        .place-image { width: 150px; height: 100px; object-fit: cover; }
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
    
    <?php foreach ($days as $dayNumber => $dayPlaces): ?>
    <div class="day-section">
        <h2 class="day-header">Day <?= $dayNumber + 1 ?></h2>
        
        <?php foreach ($dayPlaces as $place): ?>
        <div class="place-card">
            <img src="../../assets/images/<?= htmlspecialchars($place['place_img']) ?>" 
                 class="place-image">
            <div>
                <h3><?= htmlspecialchars($place['place_name']) ?></h3>
                <p>📍 <?= htmlspecialchars($place['location']) ?></p>
                <p>⏱️ <?= htmlspecialchars($place['duration']) ?></p>
                <!-- nearest_index hidden from user view -->
            </div>
        </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>
</body>
</html>