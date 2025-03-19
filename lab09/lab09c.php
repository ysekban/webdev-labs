<?php
include 'dbconnect.php';

$query = "SELECT * FROM photographs WHERE location LIKE '%Ontario%'";
$result = mysqli_query($connect, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($connect));
}

$num_rows = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ontario Photographs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        .photo-container {
            margin: 20px;
            display: inline-block;
            border: 1px solid #ddd;
            padding: 15px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .photo-container img {
            width: 300px;
            height: 200px;
            border-radius: 4px;
        }
        .caption {
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Ontario Photographs</h1>
    <?php
    if ($num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='photo-container'>";
            echo "<img src='" . htmlspecialchars($row['picture_url']) . "' alt='Photo'>";
            echo "<div class='caption'>" . htmlspecialchars($row['subject']) . " - " . htmlspecialchars($row['location']) . "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No photographs taken in Ontario.</p>";
    }
    ?>
</body>
</html>
<?php
mysqli_close($connect);
?>
