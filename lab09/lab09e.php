<?php
include 'dbconnect.php';

// Query to get a random image
$randomImageQuery = "SELECT * FROM photographs ORDER BY RAND() LIMIT 1";
$randomImageResult = mysqli_query($connect, $randomImageQuery);
$randomImage = mysqli_fetch_assoc($randomImageResult);

// Query to get the total number of images
$totalImagesQuery = "SELECT COUNT(*) as total FROM photographs";
$totalImagesResult = mysqli_query($connect, $totalImagesQuery);
$totalImagesRow = mysqli_fetch_assoc($totalImagesResult);
$totalImages = $totalImagesRow['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Random Photograph</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .photo-container {
            margin: 30px auto;
            padding: 20px;
            width: 50%;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .photo-container img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }
        .caption {
            margin-top: 10px;
            font-weight: bold;
        }
        .total-images {
            margin-top: 20px;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="photo-container">
        <?php if ($randomImage): ?>
            <img src="<?= htmlspecialchars($randomImage['picture_url']) ?>" alt="Random Photo">
            <div class="caption"><?= htmlspecialchars($randomImage['subject']) . " - " . htmlspecialchars($randomImage['location']) ?></div>
        <?php else: ?>
            <p>No images found.</p>
        <?php endif; ?>
    </div>
    <div class="total-images">
        Total Images in Database: <?= $totalImages ?>
    </div>
</body>
</html>
<?php
mysqli_close($connect);
?>
