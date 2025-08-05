<?php
    include("../../database/database.php");
    $itineraries = $data->get_itineraries();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php foreach($itineraries as $itinerary) : ?>
        <p>User ID: <?php echo $itinerary['user_id'] ?> Place ID: <?php echo $itinerary['place_id']; ?></p>
    <?php endforeach; ?>
</body>
</html>