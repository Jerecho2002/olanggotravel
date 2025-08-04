<?php
require_once("../database/database.php");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_place'])) {
    try {
        $result = $data->insert_place();
        if ($result) {
            $success_message = "Place added successfully!";
        } else {
            $error_message = "Failed to add place. Please try again.";
        }
    } catch (Exception $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Place - Staff Portal</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        textarea {
            min-height: 120px;
            resize: vertical;
        }
        button[type="submit"] {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }
        button[type="submit"]:hover {
            background-color: #2980b9;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .preview-image {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add New Tourist Place</h1>
        
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>
        
        <?php if (isset($error_message)): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="place_image">Place Image</label>
                <input type="file" name="place_image" id="place_image" accept="image/*" required>
                <img id="imagePreview" src="#" alt="Preview" class="preview-image">
            </div>

            <div class="form-group">
                <label for="place_name">Place Name</label>
                <input type="text" name="place_name" id="place_name" placeholder="Enter place name" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" placeholder="Enter detailed description" required></textarea>
            </div>

            <div class="form-group">
                <label for="duration">Recommended Duration</label>
                <input type="text" name="duration" id="duration" placeholder="e.g., 2-3 hours, full day" required>
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <select name="location" id="location" required>
                    <option value="">-- Select Location --</option>
                    <option value="Wildlife Sanctuary">Wildlife Sanctuary</option>
                    <option value="Shalala Beach">Shalala Beach</option>
                    <option value="Kabatoy">Kabatoy</option>
                </select>
            </div>

            <div class="form-group">
                <label for="nearest_index">Nearest Index (Priority)</label>
                <input type="number" name="nearest_index" id="nearest_index" placeholder="Enter priority number" min="1" required>
                <small>Lower numbers will appear first in listings</small>
            </div>

            <button type="submit" name="add_place">Add Place</button>
        </form>
    </div>

    <script>
        // Image preview functionality
        document.getElementById('place_image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('imagePreview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>