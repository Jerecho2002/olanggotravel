<?php
include("../database/database.php");
$data->session_staff("login.php");
$places = $data->get_places();
$data->update_place();

// Handle form submission
if(isset($_POST['edit-place'])) {
    $data->update_place();
    // After updating, refresh the places data to get the latest values
    $places = $data->get_places();
}

// Get the current place data
$get_place = null;
if(isset($_GET['place_id'])) {
    foreach ($places as $place) {
        if ($_GET['place_id'] == $place['place_id']) {
            $get_place = $place;
            break;
        }
    }
}

// If place not found, redirect back
if(!$get_place) {
    header("Location: edit-place.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Place - OlanggoTravels</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: #333;
            padding: 20px;
        }

        .form-container {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: var(--dark-color);
            margin-bottom: 30px;
            text-align: center;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark-color);
        }

        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        input:focus,
        textarea:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .form-actions {
            text-align: center;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
        }

        .image-preview {
            margin-top: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .image-preview img {
            width: 400px;
            height: 200px;
            object-fit: cover;
            object-position: center;
            border-radius: 20px;
            margin-top: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: none;
        }

        .current-image {
            margin-top: 15px;
            font-size: 14px;
            color: #666;
        }
        .form-container i {
            position: absolute;
            left: 20px;
            top: 20px;
            background-color: var(--primary-color);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        .form-container i:hover {
            background-color: var(--secondary-color);
            transform: translateX(-3px);
        }

        .form-container i:active {
            transform: scale(0.95);
        }

        /* Add some padding to the form container to prevent content overlap */
        .form-container {
            position: relative;
            padding-top: 60px; /* Give space for the absolute positioned icon */
        }

        /* Optional: Add a tooltip on hover */
        .form-container i::after {
            content: "Back";
            position: absolute;
            left: 50px;
            top: 50%;
            transform: translateY(-50%);
            background-color: var(--dark-color);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
            white-space: nowrap;
        }

        .form-container i:hover::after {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <?php
    $get_place;
    foreach ($places as $place) {
        if ($_GET['place_id'] == $place['place_id']) {
            $get_place = $place;
            break;
        }
    } ?>

        <div class="form-container">
        <a href="edit-place.php"><i class="fa-solid fa-arrow-left"></i></a>
        <h1>Edit Place</h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?place_id=' . htmlspecialchars($_GET['place_id']); ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="current_img_name" value="<?php echo $get_place['place_img'] ?>">
            <div class="form-grid">
                <div class="form-group">
                    <label for="place_name">Place Name</label>
                    <input type="text" id="place_name" name="place_name" value="<?php echo htmlspecialchars($get_place['place_name']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="duration">Duration</label>
                    <input type="text" id="duration" name="duration" value="<?php echo htmlspecialchars($get_place['duration']); ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($get_place['description']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="place_img">Place Image</label>
                <input type="file" id="place_img" name="place_img" value="<?php echo htmlspecialchars($get_place['place_img']); ?>" accept="image/*">
                
                <div class="current-image">
                    Current Image: <?php echo htmlspecialchars($get_place['place_img']); ?>
                </div>
                
                <div class="image-preview">
                    <span>New Image Preview:</span>
                    <img id="imagePreview" src="../assets/images/<?php echo htmlspecialchars($get_place['place_img']); ?>" alt="Image Preview" style="display: block;">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary" name="edit-place">Update Place</button>
            </div>
        </form>
    </div>

    <script>
        // Image preview functionality
        document.getElementById('place_img').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                const preview = document.getElementById('imagePreview');
                
                reader.onload = function(event) {
                    preview.src = event.target.result;
                    preview.style.display = 'block';
                }
                
                reader.readAsDataURL(file);
            }
        });

        // Display current image if available
        document.addEventListener('DOMContentLoaded', function() {
            const currentImage = "<?php echo $get_place['place_img']; ?>";
            if (currentImage) {
                const preview = document.getElementById('imagePreview');
                preview.src = "../assets/images/" + currentImage;
                preview.style.display = 'block';
            }
        });
    </script>
</body>
</html>